<?php
/*
    Copyright (C) 2004-2010 Kestas J. Kuliukas

	This file is part of webDiplomacy.

    webDiplomacy is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    webDiplomacy is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with webDiplomacy.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('IN_CODE') or die('This script can not be run by itself.');
/**
 * @package GameMaster
 * @subpackage Adjudicator
 */
class adjudicatorPreGame {

	protected function isEnoughPlayers() {
		global $Game;

		return ( count($Game->Members->ByID) == count($Game->Variant->countries) );
	}

	protected function userCountries() {
		global $Game;

		$userIDs=array();
		foreach($Game->Members->ByUserID as $userID=>$Member)
			$userIDs[] = $userID;

		shuffle($userIDs);

		$userCountries=array();
		$countryID=1;
		foreach($userIDs as $userID)
		{
			$userCountries[$userID] = $countryID;
			$countryID++;
		}

		return $userCountries;
	}

	protected function assignCountries(array $userCountries) {
		global $DB, $Game;

		// Finally the user->countryID array is written to the database and Game->Members objects,
		// and the new countryID chances for each user based on their selection this time are written
		// to the database
		foreach( $userCountries as $userID=>$countryID )
		{
			$DB->sql_put(
				"UPDATE wD_Members
				SET countryID='".$countryID."'
				WHERE userID=".$userID." AND gameID = ".$Game->id
			);
		}

		$Game->Members->ByCountryID=array();
		foreach($Game->Members->ByID as $Member)
		{
			$Member->countryID = $userCountries[$Member->userID];
			$Game->Members->ByCountryID[$Member->countryID] = $Member;
		}

		for($countryID=1; $countryID<=count($Game->Variant->countries); $countryID++)
			assert('$Game->Members->ByCountryID[$countryID]->countryID==$countryID');
	}

	protected function assignTerritories() {
		global $DB, $Game;

		$DB->sql_put(
			"INSERT INTO wD_TerrStatus ( gameID, countryID, terrID )
			SELECT ".$Game->id." as gameID, countryID, id
			FROM wD_Territories
			WHERE countryID > 0 AND mapID=".$Game->Variant->mapID." AND (coast='No' OR coast='Parent')"
		);
	}

	protected function assignUnits() {
		global $DB, $Game;

		$terrIDByName = array();
		$tabl = $DB->sql_tabl("SELECT id, name FROM wD_Territories WHERE mapID=".$Game->Variant->mapID);
		while(list($id, $name) = $DB->tabl_row($tabl))
			$terrIDByName[$name]=$id;

		$UnitINSERTs = array();
		foreach($this->countryUnits as $countryName => $params)
		{
			$countryID = $Game->Variant->countryID($countryName);

			foreach($params as $terrName=>$unitType)
			{
				$terrID = $terrIDByName[$terrName];

				$UnitINSERTs[] = "(".$Game->id.", ".$countryID.", '".$terrID."', '".$unitType."')"; // ( gameID, countryID, terrID, type )
			}
		}

		$DB->sql_put(
			"INSERT INTO wD_Units ( gameID, countryID, terrID, type )
			VALUES ".implode(', ', $UnitINSERTs)
		);
	}

	protected function assignUnitOccupations() {
		global $DB, $Game;

		// Now link the TerrStatus and Units records via the occupyingUnitID TerrStatus column
		$DB->sql_put(
			"UPDATE wD_TerrStatus t
			INNER JOIN wD_Units u
				ON (
					t.gameID = u.gameID
					/* TerrStatus does not deal with coasts */
					AND ".$Game->Variant->deCoastCompare('t.terrID','u.terrID')."
				)
			SET t.occupyingUnitID = u.id
			WHERE u.gameID = ".$Game->id
		);
	}
	
	/**
	 * Give each member the same time-limit on his chessTimer
	 */
	protected function assignTime()
	{
		global $DB, $Game;

		$DB->sql_put(
			"UPDATE wD_Members
			SET chessTime='".$Game->chessTime."'
			WHERE gameID = ".$Game->id
		);
	}
	
	function checkForRelations()
	{
		require_once "lib/relations.php";
		global $DB, $Game;

		$sql = "SELECT u.rlGroup FROM wD_Users u
					LEFT JOIN wD_Members m ON ( u.id = m.userID )
					WHERE m.gameID=".$Game->id." AND rlGroup != 0
					GROUP BY rlGroup
					HAVING count(u.rlGroup) > 1";
		$tabl= $DB->sql_tabl($sql);
		while (list ($groupID) = $DB->tabl_row($tabl))
			libRelations::sendGameMessage($groupID);
	}

	/**
	 * Initialize the game (more of a phase change than adjudication). Will throw an exception
	 * if the game doesn't have enough players, which will be caught in gamemaster.php and result
	 * in the game's deletion
	 *
	 * Deletes game and throws exception if game cannot start
	 */
	function adjudicate()
	{
		global $Game;

		// Will give back bets, send messages, delete the game, and throw an exception to get back to gamemaster.php
		if( !$this->isEnoughPlayers() ) $Game->setNotEnoughPlayers();

		// Determine which countryID is given to which userID if not already set during gamecreate.
		if (count($Game->Members->ByCountryID)==0)
		{
			$userCountries = $this->userCountries();// $userCountries[$userID]=$countryID
			assert('count($userCountries) == count($Game->Variant->countries) && count($userCountries) == count($Game->Members->ByID)');
			$this->assignCountries($userCountries);
		}
		else
		{
			require_once "lib/gamemessage.php";
			libGameMessage::send(0, 'Info', 'This is a choose your country game.', $Game->id);		
		}
		
		// Create starting board conditions, typically based on $countryUnits
		$this->assignTerritories(); // TerrStatus
		$this->assignUnits(); // Units
		$this->assignUnitOccupations(); // TerrStatus occupyingUnitID
		$this->assignTime();
		$this->checkForRelations();
	}
}

?>