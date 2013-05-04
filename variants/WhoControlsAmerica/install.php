<?php
// This is file installs the map data for the WhoControlsAmerica variant
defined('IN_CODE') or die('This script can not be run by itself.');
require_once("variants/install.php");

InstallTerritory::$Territories=array();
$countries=$this->countries;
$territoryRawData=array(
	array('Democratic National Committee', 'Land', 'No', 291, 200, 151, 104, 'Democratic Party'),
	array('Triads', 'Land', 'Yes', 193, 547, 110, 240, 'The Underworld'),
	array('Democratic Convention', 'Land', 'Yes', 371, 276, 191, 136, 'Democratic Party'),
	array('Democratic Senators', 'Land', 'No', 447, 284, 229, 135, 'Democratic Party'),
	array('Democratic Primaries', 'Land', 'Yes', 481, 336, 243, 168, 'Democratic Party'),
	array('Democratic Governors', 'Land', 'No', 559, 332, 281, 158, 'Democratic Party'),
	array('Democratic Leadership', 'Land', 'Yes', 639, 409, 311, 205, 'Democratic Party'),
	array('Environmentalists', 'Land', 'Yes', 462, 113, 229, 53, 'Liberal Interests'),
	array('People for the Ethical Treatment of Animals', 'Land', 'No', 520, 139, 259, 67, 'Liberal Interests'),
	array('Pro-Choice Movement', 'Land', 'Yes', 593, 170, 293, 86, 'Liberal Interests'),
	array('Gun Control Lobby', 'Land', 'No', 561, 232, 280, 114, 'Liberal Interests'),
	array('AFL-CIO (Trade Unions)', 'Land', 'Yes', 635, 272, 346, 128, 'Liberal Interests'),
	array('Ivy League Colleges', 'Land', 'No', 662, 376, 334, 182, 'Liberal Interests'),
	array('Air Force', 'Land', 'No', 984, 186, 494, 91, 'The Military'),
	array('Central Intelligence Agency', 'Land', 'Yes', 929, 216, 464, 113, 'The Military'),
	array('Navy', 'Land', 'No', 818, 182, 424, 91, 'The Military'),
	array('Joint Chiefs of Staff', 'Land', 'Yes', 827, 257, 417, 132, 'The Military'),
	array('Army', 'Land', 'No', 731, 287, 366, 140, 'The Military'),
	array('The Pentagon', 'Land', 'Yes', 730, 374, 362, 166, 'The Military'),
	array('Wall Street', 'Land', 'Yes', 1250, 282, 593, 184, 'Corporate America'),
	array('Big Pharma (Pharmaceutical Industry)', 'Land', 'No', 1027, 377, 516, 186, 'Corporate America'),
	array('The Banks', 'Land', 'Yes', 965, 411, 485, 219, 'Corporate America'),
	array('Technology Sector', 'Land', 'No', 887, 332, 443, 164, 'Corporate America'),
	array('The Media', 'Land', 'Yes', 834, 359, 419, 209, 'Corporate America'),
	array('Industrialists', 'Land', 'No', 768, 411, 384, 201, 'Corporate America'),
	array('Republican National Committee', 'Land', 'No', 1097, 605, 554, 323, 'Republican Party'),
	array('Republican Convention', 'Land', 'Yes', 928, 707, 489, 311, 'Republican Party'),
	array('Republican Senators', 'Land', 'No', 904, 622, 461, 291, 'Republican Party'),
	array('Republican Primaries', 'Land', 'Yes', 851, 602, 447, 255, 'Republican Party'),
	array('Republican Governors', 'Land', 'No', 826, 523, 399, 267, 'Republican Party'),
	array('Republican Leadership', 'Land', 'Yes', 736, 475, 369, 225, 'Republican Party'),
	array('Street Gangs', 'Land', 'No', 353, 535, 178, 266, 'The Underworld'),
	array('South American Drug Cartels', 'Land', 'Yes', 428, 548, 216, 277, 'The Underworld'),
	array('White Collar Crime', 'Land', 'No', 469, 467, 235, 241, 'The Underworld'),
	array('The Mafia', 'Land', 'Yes', 536, 453, 264, 221, 'The Underworld'),
	array('Corruption', 'Land', 'No', 596, 463, 297, 233, 'The Underworld'),
	array('Free Masons', 'Land', 'Yes', 644, 520, 323, 263, 'Secret Societies'),
	array('Bilderberg Group', 'Land', 'No', 620, 578, 311, 290, 'Secret Societies'),
	array('Scientologists', 'Land', 'Yes', 597, 644, 280, 311, 'Secret Societies'),
	array('The Fellowship', 'Land', 'No', 508, 650, 249, 320, 'Secret Societies'),
	array('Skull and Bones', 'Land', 'Yes', 506, 712, 248, 346, 'Secret Societies'),
	array('Illuminati', 'Land', 'No', 378, 678, 187, 337, 'Secret Societies'),
	array('Mormons', 'Land', 'No', 702, 499, 343, 266, 'Conservative Interests'),
	array('Religious Right', 'Land', 'Yes', 741, 569, 379, 275, 'Conservative Interests'),
	array('Energy Lobby', 'Land', 'No', 703, 658, 342, 327, 'Conservative Interests'),
	array('Pro-Life Movement', 'Land', 'Yes', 775, 703, 389, 349, 'Conservative Interests'),
	array('Tea Party Movement', 'Land', 'No', 742, 771, 384, 382, 'Conservative Interests'),
	array('National Rifle Association', 'Land', 'Yes', 667, 855, 334, 430, 'Conservative Interests'),
	array('The White House', 'Land', 'Yes', 691, 418, 344, 202, 'Neutral'),
	array('Congress', 'Land', 'Yes', 683, 463, 336, 229, 'Neutral')
);

foreach($territoryRawData as $territoryRawRow)
{
	list($name, $type, $supply, $x, $y, $sx, $sy, $country)=$territoryRawRow;
	if( $country=='Neutral' )
		$countryID=0;
	else
		$countryID=$this->countryID($country);
		
	new InstallTerritory($name, $type, $supply, $countryID, $x, $y, $sx, $sy);
}
unset($territoryRawData);
$bordersRawData=array(
	array('Democratic National Committee','Triads','No','Yes'),
	array('Democratic National Committee','Democratic Convention','No','Yes'),
	array('Democratic National Committee','Environmentalists','No','Yes'),
	array('Democratic National Committee','People for the Ethical Treatment of Animals','No','Yes'),
	array('Democratic National Committee','Street Gangs','No','Yes'),
	array('Triads','Democratic National Committee','No','Yes'),
	array('Triads','Democratic Convention','No','Yes'),
	array('Triads','Street Gangs','No','Yes'),
	array('Triads','Skull and Bones','No','Yes'),
	array('Triads','Illuminati','No','Yes'),
	array('Democratic Convention','Democratic National Committee','No','Yes'),
	array('Democratic Convention','Triads','No','Yes'),
	array('Democratic Convention','Democratic Senators','No','Yes'),
	array('Democratic Convention','Environmentalists','No','Yes'),
	array('Democratic Convention','People for the Ethical Treatment of Animals','No','Yes'),
	array('Democratic Convention','Pro-Choice Movement','No','Yes'),
	array('Democratic Convention','Street Gangs','No','Yes'),
	array('Democratic Convention','South American Drug Cartels','No','Yes'),
	array('Democratic Senators','Democratic Convention','No','Yes'),
	array('Democratic Senators','Democratic Primaries','No','Yes'),
	array('Democratic Senators','People for the Ethical Treatment of Animals','No','Yes'),
	array('Democratic Senators','Pro-Choice Movement','No','Yes'),
	array('Democratic Senators','Gun Control Lobby','No','Yes'),
	array('Democratic Senators','Street Gangs','No','Yes'),
	array('Democratic Senators','South American Drug Cartels','No','Yes'),
	array('Democratic Senators','White Collar Crime','No','Yes'),
	array('Democratic Primaries','Democratic Senators','No','Yes'),
	array('Democratic Primaries','Democratic Governors','No','Yes'),
	array('Democratic Primaries','Pro-Choice Movement','No','Yes'),
	array('Democratic Primaries','Gun Control Lobby','No','Yes'),
	array('Democratic Primaries','AFL-CIO (Trade Unions)','No','Yes'),
	array('Democratic Primaries','South American Drug Cartels','No','Yes'),
	array('Democratic Primaries','White Collar Crime','No','Yes'),
	array('Democratic Primaries','The Mafia','No','Yes'),
	array('Democratic Governors','Democratic Primaries','No','Yes'),
	array('Democratic Governors','Democratic Leadership','No','Yes'),
	array('Democratic Governors','Gun Control Lobby','No','Yes'),
	array('Democratic Governors','AFL-CIO (Trade Unions)','No','Yes'),
	array('Democratic Governors','Ivy League Colleges','No','Yes'),
	array('Democratic Governors','White Collar Crime','No','Yes'),
	array('Democratic Governors','The Mafia','No','Yes'),
	array('Democratic Governors','Corruption','No','Yes'),
	array('Democratic Leadership','Democratic Governors','No','Yes'),
	array('Democratic Leadership','AFL-CIO (Trade Unions)','No','Yes'),
	array('Democratic Leadership','Ivy League Colleges','No','Yes'),
	array('Democratic Leadership','The Mafia','No','Yes'),
	array('Democratic Leadership','Corruption','No','Yes'),
	array('Democratic Leadership','The White House','No','Yes'),
	array('Democratic Leadership','Congress','No','Yes'),
	array('Environmentalists','Democratic National Committee','No','Yes'),
	array('Environmentalists','Democratic Convention','No','Yes'),
	array('Environmentalists','People for the Ethical Treatment of Animals','No','Yes'),
	array('Environmentalists','Air Force','No','Yes'),
	array('Environmentalists','Central Intelligence Agency','No','Yes'),
	array('People for the Ethical Treatment of Animals','Democratic National Committee','No','Yes'),
	array('People for the Ethical Treatment of Animals','Democratic Convention','No','Yes'),
	array('People for the Ethical Treatment of Animals','Democratic Senators','No','Yes'),
	array('People for the Ethical Treatment of Animals','Environmentalists','No','Yes'),
	array('People for the Ethical Treatment of Animals','Pro-Choice Movement','No','Yes'),
	array('People for the Ethical Treatment of Animals','Air Force','No','Yes'),
	array('People for the Ethical Treatment of Animals','Central Intelligence Agency','No','Yes'),
	array('People for the Ethical Treatment of Animals','Navy','No','Yes'),
	array('Pro-Choice Movement','Democratic Convention','No','Yes'),
	array('Pro-Choice Movement','Democratic Senators','No','Yes'),
	array('Pro-Choice Movement','Democratic Primaries','No','Yes'),
	array('Pro-Choice Movement','People for the Ethical Treatment of Animals','No','Yes'),
	array('Pro-Choice Movement','Gun Control Lobby','No','Yes'),
	array('Pro-Choice Movement','Central Intelligence Agency','No','Yes'),
	array('Pro-Choice Movement','Navy','No','Yes'),
	array('Pro-Choice Movement','Joint Chiefs of Staff','No','Yes'),
	array('Gun Control Lobby','Democratic Senators','No','Yes'),
	array('Gun Control Lobby','Democratic Primaries','No','Yes'),
	array('Gun Control Lobby','Democratic Governors','No','Yes'),
	array('Gun Control Lobby','Pro-Choice Movement','No','Yes'),
	array('Gun Control Lobby','AFL-CIO (Trade Unions)','No','Yes'),
	array('Gun Control Lobby','Navy','No','Yes'),
	array('Gun Control Lobby','Joint Chiefs of Staff','No','Yes'),
	array('Gun Control Lobby','Army','No','Yes'),
	array('AFL-CIO (Trade Unions)','Democratic Primaries','No','Yes'),
	array('AFL-CIO (Trade Unions)','Democratic Governors','No','Yes'),
	array('AFL-CIO (Trade Unions)','Democratic Leadership','No','Yes'),
	array('AFL-CIO (Trade Unions)','Gun Control Lobby','No','Yes'),
	array('AFL-CIO (Trade Unions)','Ivy League Colleges','No','Yes'),
	array('AFL-CIO (Trade Unions)','Joint Chiefs of Staff','No','Yes'),
	array('AFL-CIO (Trade Unions)','Army','No','Yes'),
	array('AFL-CIO (Trade Unions)','The Pentagon','No','Yes'),
	array('Ivy League Colleges','Democratic Governors','No','Yes'),
	array('Ivy League Colleges','Democratic Leadership','No','Yes'),
	array('Ivy League Colleges','AFL-CIO (Trade Unions)','No','Yes'),
	array('Ivy League Colleges','Army','No','Yes'),
	array('Ivy League Colleges','The Pentagon','No','Yes'),
	array('Ivy League Colleges','The White House','No','Yes'),
	array('Air Force','Environmentalists','No','Yes'),
	array('Air Force','People for the Ethical Treatment of Animals','No','Yes'),
	array('Air Force','Central Intelligence Agency','No','Yes'),
	array('Air Force','Wall Street','No','Yes'),
	array('Air Force','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('Central Intelligence Agency','Environmentalists','No','Yes'),
	array('Central Intelligence Agency','People for the Ethical Treatment of Animals','No','Yes'),
	array('Central Intelligence Agency','Pro-Choice Movement','No','Yes'),
	array('Central Intelligence Agency','Air Force','No','Yes'),
	array('Central Intelligence Agency','Navy','No','Yes'),
	array('Central Intelligence Agency','Wall Street','No','Yes'),
	array('Central Intelligence Agency','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('Central Intelligence Agency','The Banks','No','Yes'),
	array('Navy','People for the Ethical Treatment of Animals','No','Yes'),
	array('Navy','Pro-Choice Movement','No','Yes'),
	array('Navy','Gun Control Lobby','No','Yes'),
	array('Navy','Central Intelligence Agency','No','Yes'),
	array('Navy','Joint Chiefs of Staff','No','Yes'),
	array('Navy','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('Navy','The Banks','No','Yes'),
	array('Navy','Technology Sector','No','Yes'),
	array('Joint Chiefs of Staff','Pro-Choice Movement','No','Yes'),
	array('Joint Chiefs of Staff','Gun Control Lobby','No','Yes'),
	array('Joint Chiefs of Staff','AFL-CIO (Trade Unions)','No','Yes'),
	array('Joint Chiefs of Staff','Navy','No','Yes'),
	array('Joint Chiefs of Staff','Army','No','Yes'),
	array('Joint Chiefs of Staff','The Banks','No','Yes'),
	array('Joint Chiefs of Staff','Technology Sector','No','Yes'),
	array('Joint Chiefs of Staff','The Media','No','Yes'),
	array('Army','Gun Control Lobby','No','Yes'),
	array('Army','AFL-CIO (Trade Unions)','No','Yes'),
	array('Army','Ivy League Colleges','No','Yes'),
	array('Army','Joint Chiefs of Staff','No','Yes'),
	array('Army','The Pentagon','No','Yes'),
	array('Army','Technology Sector','No','Yes'),
	array('Army','The Media','No','Yes'),
	array('Army','Industrialists','No','Yes'),
	array('The Pentagon','AFL-CIO (Trade Unions)','No','Yes'),
	array('The Pentagon','Ivy League Colleges','No','Yes'),
	array('The Pentagon','Army','No','Yes'),
	array('The Pentagon','The Media','No','Yes'),
	array('The Pentagon','Industrialists','No','Yes'),
	array('The Pentagon','The White House','No','Yes'),
	array('Wall Street','Air Force','No','Yes'),
	array('Wall Street','Central Intelligence Agency','No','Yes'),
	array('Wall Street','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('Wall Street','Republican National Committee','No','Yes'),
	array('Wall Street','Republican Convention','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','Air Force','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','Central Intelligence Agency','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','Navy','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','Wall Street','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','The Banks','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','Republican National Committee','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','Republican Convention','No','Yes'),
	array('Big Pharma (Pharmaceutical Industry)','Republican Senators','No','Yes'),
	array('The Banks','Central Intelligence Agency','No','Yes'),
	array('The Banks','Navy','No','Yes'),
	array('The Banks','Joint Chiefs of Staff','No','Yes'),
	array('The Banks','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('The Banks','Technology Sector','No','Yes'),
	array('The Banks','Republican Convention','No','Yes'),
	array('The Banks','Republican Senators','No','Yes'),
	array('The Banks','Republican Primaries','No','Yes'),
	array('Technology Sector','Navy','No','Yes'),
	array('Technology Sector','Joint Chiefs of Staff','No','Yes'),
	array('Technology Sector','Army','No','Yes'),
	array('Technology Sector','The Banks','No','Yes'),
	array('Technology Sector','The Media','No','Yes'),
	array('Technology Sector','Republican Senators','No','Yes'),
	array('Technology Sector','Republican Primaries','No','Yes'),
	array('Technology Sector','Republican Governors','No','Yes'),
	array('The Media','Joint Chiefs of Staff','No','Yes'),
	array('The Media','Army','No','Yes'),
	array('The Media','The Pentagon','No','Yes'),
	array('The Media','Technology Sector','No','Yes'),
	array('The Media','Industrialists','No','Yes'),
	array('The Media','Republican Primaries','No','Yes'),
	array('The Media','Republican Governors','No','Yes'),
	array('The Media','Republican Leadership','No','Yes'),
	array('Industrialists','Army','No','Yes'),
	array('Industrialists','The Pentagon','No','Yes'),
	array('Industrialists','The Media','No','Yes'),
	array('Industrialists','Republican Governors','No','Yes'),
	array('Industrialists','Republican Leadership','No','Yes'),
	array('Industrialists','The White House','No','Yes'),
	array('Industrialists','Congress','No','Yes'),
	array('Republican National Committee','Wall Street','No','Yes'),
	array('Republican National Committee','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('Republican National Committee','Republican Convention','No','Yes'),
	array('Republican National Committee','Tea Party Movement','No','Yes'),
	array('Republican National Committee','National Rifle Association','No','Yes'),
	array('Republican Convention','Wall Street','No','Yes'),
	array('Republican Convention','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('Republican Convention','The Banks','No','Yes'),
	array('Republican Convention','Republican National Committee','No','Yes'),
	array('Republican Convention','Republican Senators','No','Yes'),
	array('Republican Convention','Pro-Life Movement','No','Yes'),
	array('Republican Convention','Tea Party Movement','No','Yes'),
	array('Republican Convention','National Rifle Association','No','Yes'),
	array('Republican Senators','Big Pharma (Pharmaceutical Industry)','No','Yes'),
	array('Republican Senators','The Banks','No','Yes'),
	array('Republican Senators','Technology Sector','No','Yes'),
	array('Republican Senators','Republican Convention','No','Yes'),
	array('Republican Senators','Republican Primaries','No','Yes'),
	array('Republican Senators','Energy Lobby','No','Yes'),
	array('Republican Senators','Pro-Life Movement','No','Yes'),
	array('Republican Senators','Tea Party Movement','No','Yes'),
	array('Republican Primaries','The Banks','No','Yes'),
	array('Republican Primaries','Technology Sector','No','Yes'),
	array('Republican Primaries','The Media','No','Yes'),
	array('Republican Primaries','Republican Senators','No','Yes'),
	array('Republican Primaries','Republican Governors','No','Yes'),
	array('Republican Primaries','Religious Right','No','Yes'),
	array('Republican Primaries','Energy Lobby','No','Yes'),
	array('Republican Primaries','Pro-Life Movement','No','Yes'),
	array('Republican Governors','Technology Sector','No','Yes'),
	array('Republican Governors','The Media','No','Yes'),
	array('Republican Governors','Industrialists','No','Yes'),
	array('Republican Governors','Republican Primaries','No','Yes'),
	array('Republican Governors','Republican Leadership','No','Yes'),
	array('Republican Governors','Mormons','No','Yes'),
	array('Republican Governors','Religious Right','No','Yes'),
	array('Republican Governors','Energy Lobby','No','Yes'),
	array('Republican Leadership','The Media','No','Yes'),
	array('Republican Leadership','Industrialists','No','Yes'),
	array('Republican Leadership','Republican Governors','No','Yes'),
	array('Republican Leadership','Mormons','No','Yes'),
	array('Republican Leadership','Religious Right','No','Yes'),
	array('Republican Leadership','The White House','No','Yes'),
	array('Republican Leadership','Congress','No','Yes'),
	array('Street Gangs','Democratic National Committee','No','Yes'),
	array('Street Gangs','Triads','No','Yes'),
	array('Street Gangs','Democratic Convention','No','Yes'),
	array('Street Gangs','Democratic Senators','No','Yes'),
	array('Street Gangs','South American Drug Cartels','No','Yes'),
	array('Street Gangs','The Fellowship','No','Yes'),
	array('Street Gangs','Skull and Bones','No','Yes'),
	array('Street Gangs','Illuminati','No','Yes'),
	array('South American Drug Cartels','Democratic Convention','No','Yes'),
	array('South American Drug Cartels','Democratic Senators','No','Yes'),
	array('South American Drug Cartels','Democratic Primaries','No','Yes'),
	array('South American Drug Cartels','Street Gangs','No','Yes'),
	array('South American Drug Cartels','White Collar Crime','No','Yes'),
	array('South American Drug Cartels','Scientologists','No','Yes'),
	array('South American Drug Cartels','The Fellowship','No','Yes'),
	array('South American Drug Cartels','Skull and Bones','No','Yes'),
	array('White Collar Crime','Democratic Senators','No','Yes'),
	array('White Collar Crime','Democratic Primaries','No','Yes'),
	array('White Collar Crime','Democratic Governors','No','Yes'),
	array('White Collar Crime','South American Drug Cartels','No','Yes'),
	array('White Collar Crime','The Mafia','No','Yes'),
	array('White Collar Crime','Bilderberg Group','No','Yes'),
	array('White Collar Crime','Scientologists','No','Yes'),
	array('White Collar Crime','The Fellowship','No','Yes'),
	array('The Mafia','Democratic Primaries','No','Yes'),
	array('The Mafia','Democratic Governors','No','Yes'),
	array('The Mafia','Democratic Leadership','No','Yes'),
	array('The Mafia','White Collar Crime','No','Yes'),
	array('The Mafia','Corruption','No','Yes'),
	array('The Mafia','Free Masons','No','Yes'),
	array('The Mafia','Bilderberg Group','No','Yes'),
	array('The Mafia','Scientologists','No','Yes'),
	array('Corruption','Democratic Governors','No','Yes'),
	array('Corruption','Democratic Leadership','No','Yes'),
	array('Corruption','The Mafia','No','Yes'),
	array('Corruption','Free Masons','No','Yes'),
	array('Corruption','Bilderberg Group','No','Yes'),
	array('Corruption','The White House','No','Yes'),
	array('Corruption','Congress','No','Yes'),
	array('Free Masons','The Mafia','No','Yes'),
	array('Free Masons','Corruption','No','Yes'),
	array('Free Masons','Bilderberg Group','No','Yes'),
	array('Free Masons','Mormons','No','Yes'),
	array('Free Masons','Religious Right','No','Yes'),
	array('Free Masons','Congress','No','Yes'),
	array('Bilderberg Group','White Collar Crime','No','Yes'),
	array('Bilderberg Group','The Mafia','No','Yes'),
	array('Bilderberg Group','Corruption','No','Yes'),
	array('Bilderberg Group','Free Masons','No','Yes'),
	array('Bilderberg Group','Scientologists','No','Yes'),
	array('Bilderberg Group','Mormons','No','Yes'),
	array('Bilderberg Group','Religious Right','No','Yes'),
	array('Bilderberg Group','Energy Lobby','No','Yes'),
	array('Scientologists','South American Drug Cartels','No','Yes'),
	array('Scientologists','White Collar Crime','No','Yes'),
	array('Scientologists','The Mafia','No','Yes'),
	array('Scientologists','Bilderberg Group','No','Yes'),
	array('Scientologists','The Fellowship','No','Yes'),
	array('Scientologists','Religious Right','No','Yes'),
	array('Scientologists','Energy Lobby','No','Yes'),
	array('Scientologists','Pro-Life Movement','No','Yes'),
	array('The Fellowship','Street Gangs','No','Yes'),
	array('The Fellowship','South American Drug Cartels','No','Yes'),
	array('The Fellowship','White Collar Crime','No','Yes'),
	array('The Fellowship','Scientologists','No','Yes'),
	array('The Fellowship','Skull and Bones','No','Yes'),
	array('The Fellowship','Energy Lobby','No','Yes'),
	array('The Fellowship','Pro-Life Movement','No','Yes'),
	array('The Fellowship','Tea Party Movement','No','Yes'),
	array('Skull and Bones','Triads','No','Yes'),
	array('Skull and Bones','Street Gangs','No','Yes'),
	array('Skull and Bones','South American Drug Cartels','No','Yes'),
	array('Skull and Bones','The Fellowship','No','Yes'),
	array('Skull and Bones','Illuminati','No','Yes'),
	array('Skull and Bones','Pro-Life Movement','No','Yes'),
	array('Skull and Bones','Tea Party Movement','No','Yes'),
	array('Skull and Bones','National Rifle Association','No','Yes'),
	array('Illuminati','Triads','No','Yes'),
	array('Illuminati','Street Gangs','No','Yes'),
	array('Illuminati','Skull and Bones','No','Yes'),
	array('Illuminati','Tea Party Movement','No','Yes'),
	array('Illuminati','National Rifle Association','No','Yes'),
	array('Mormons','Republican Governors','No','Yes'),
	array('Mormons','Republican Leadership','No','Yes'),
	array('Mormons','Free Masons','No','Yes'),
	array('Mormons','Bilderberg Group','No','Yes'),
	array('Mormons','Religious Right','No','Yes'),
	array('Mormons','Congress','No','Yes'),
	array('Religious Right','Republican Primaries','No','Yes'),
	array('Religious Right','Republican Governors','No','Yes'),
	array('Religious Right','Republican Leadership','No','Yes'),
	array('Religious Right','Free Masons','No','Yes'),
	array('Religious Right','Bilderberg Group','No','Yes'),
	array('Religious Right','Scientologists','No','Yes'),
	array('Religious Right','Mormons','No','Yes'),
	array('Religious Right','Energy Lobby','No','Yes'),
	array('Energy Lobby','Republican Senators','No','Yes'),
	array('Energy Lobby','Republican Primaries','No','Yes'),
	array('Energy Lobby','Republican Governors','No','Yes'),
	array('Energy Lobby','Bilderberg Group','No','Yes'),
	array('Energy Lobby','Scientologists','No','Yes'),
	array('Energy Lobby','The Fellowship','No','Yes'),
	array('Energy Lobby','Religious Right','No','Yes'),
	array('Energy Lobby','Pro-Life Movement','No','Yes'),
	array('Pro-Life Movement','Republican Convention','No','Yes'),
	array('Pro-Life Movement','Republican Senators','No','Yes'),
	array('Pro-Life Movement','Republican Primaries','No','Yes'),
	array('Pro-Life Movement','Scientologists','No','Yes'),
	array('Pro-Life Movement','The Fellowship','No','Yes'),
	array('Pro-Life Movement','Skull and Bones','No','Yes'),
	array('Pro-Life Movement','Energy Lobby','No','Yes'),
	array('Pro-Life Movement','Tea Party Movement','No','Yes'),
	array('Tea Party Movement','Republican National Committee','No','Yes'),
	array('Tea Party Movement','Republican Convention','No','Yes'),
	array('Tea Party Movement','Republican Senators','No','Yes'),
	array('Tea Party Movement','The Fellowship','No','Yes'),
	array('Tea Party Movement','Skull and Bones','No','Yes'),
	array('Tea Party Movement','Illuminati','No','Yes'),
	array('Tea Party Movement','Pro-Life Movement','No','Yes'),
	array('Tea Party Movement','National Rifle Association','No','Yes'),
	array('National Rifle Association','Republican National Committee','No','Yes'),
	array('National Rifle Association','Republican Convention','No','Yes'),
	array('National Rifle Association','Skull and Bones','No','Yes'),
	array('National Rifle Association','Illuminati','No','Yes'),
	array('National Rifle Association','Tea Party Movement','No','Yes'),
	array('The White House','Democratic Leadership','No','Yes'),
	array('The White House','Ivy League Colleges','No','Yes'),
	array('The White House','The Pentagon','No','Yes'),
	array('The White House','Industrialists','No','Yes'),
	array('The White House','Republican Leadership','No','Yes'),
	array('The White House','Corruption','No','Yes'),
	array('The White House','Congress','No','Yes'),
	array('Congress','Democratic Leadership','No','Yes'),
	array('Congress','Industrialists','No','Yes'),
	array('Congress','Republican Leadership','No','Yes'),
	array('Congress','Corruption','No','Yes'),
	array('Congress','Free Masons','No','Yes'),
	array('Congress','Mormons','No','Yes'),
	array('Congress','The White House','No','Yes')
);

foreach($bordersRawData as $borderRawRow)
{
	list($from, $to, $fleets, $armies)=$borderRawRow;
	InstallTerritory::$Territories[$to]  ->addBorder(InstallTerritory::$Territories[$from],$fleets,$armies);
}
unset($bordersRawData);

InstallTerritory::runSQL($this->mapID);
InstallCache::terrJSON($this->territoriesJSONFile(),$this->mapID);
?>