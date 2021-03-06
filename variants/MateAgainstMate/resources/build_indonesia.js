function CustomBuild_Indonesia() {

	MyOrders.map(function(OrderObj) {
			OrderObj.updateToTerrChoices = function () {
				switch( this.type )
				{
					case 'Wait':
						this.toTerrChoices = undefined;
						return;
					case 'Build Army':
					case 'Build Fleet':
						this.toTerrChoices = SupplyCenters.select(function(sc){
							if( this.type=='Build Army' && (sc.coast=='Parent'||sc.coast=='No'))
								return true;
							else if ( this.type=='Build Fleet' && ( sc.type != 'Land' && sc.coast!='Parent' && sc.id !='33' ) )
								return true;
							else
								return false;
						},this).pluck('id');
						break;
					case 'Destroy':
						this.toTerrChoices = MyUnits.pluck('Territory').pluck('coastParent').pluck('id');
						break;
				}
				
				this.toTerrChoices=this.arrayToChoices(this.toTerrChoices);
				
				return this.toTerrChoices;
			};

			OrderObj.updateChoices(OrderObj.requirements);
			OrderObj.requirements.map(function(n){ OrderObj.reHTML(n); },OrderObj);

		}, this);

};	
