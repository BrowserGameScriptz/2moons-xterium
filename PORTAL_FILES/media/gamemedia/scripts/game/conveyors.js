function counting(id)
{
	var Data 			= elementList[id];
	var	sitem			= '#item_'+(String(id));
	var Ellimet			= $(sitem);
	var it 				= 1;
	var	count 			= Math.max( 1, Math.min( 100, Number(Ellimet.find(".number_count").val())));
	var costRessources 	= 0;
	var res 			= 0;
	var costRessources	= Array();
	costRessources[901]	= 0;
	costRessources[902] = 0;
	costRessources[903] = 0;
	costRessources[921] = 0;
	var factor_class	= Number(Data.factorClass);
	var level_item		= Number(Data.level);
	
	var metal 			= Number(String($('#current_metal').text()).replace(/[.]/g, ''));
	var crystal 		= Number(String($('#current_crystal').text()).replace(/[.]/g, ''));
	var deuterium 		= Number(String($('#current_deuterium').text()).replace(/[.]/g, ''));
	var darkmatter 		= Number(String($('#current_darkmatter').text()).replace(/[.]/g, ''));
	
	for (it; it <= count; it++) 
	{
		if(typeof Data.SCostRessources[901] !== "undefined")
		{
			res = Number(Data.SCostRessources[901]);
			costRessources[901] += Math.round(res * (1 + level_item + (it - 1)) * Math.pow(factor_class, level_item + (it - 1)));
		}
		if(typeof Data.SCostRessources[902] !== "undefined")
		{
			res = Number(Data.SCostRessources[902]);
			costRessources[902] += Math.round(res * (1 + level_item + (it - 1)) * Math.pow(factor_class, level_item + (it - 1)));
		}
		if(typeof Data.SCostRessources[903] !== "undefined")
		{
			res = Number(Data.SCostRessources[903]);
			costRessources[903] += Math.round(res * (1 + level_item + (it - 1)) * Math.pow(factor_class, level_item + (it - 1)));
		}
		if(typeof Data.SCostRessources[921] !== "undefined")
		{
			res = Number(Data.SCostRessources[921]);
			costRessources[921] += Math.round(res * (1 + level_item + (it - 1)) * Math.pow(factor_class, level_item + (it - 1)));
		}
	}
	
	if(costRessources[901] > 0)
	{
		if(id == 502 || id == 503)
			costRessources[901] *= 1500;
			
		Ellimet.find(".res901").find(".text").html(NumberGetHumanReadable(costRessources[901]));
		
		if(metal < costRessources[901])	
		{
			Ellimet.find(".res901").addClass('required'); 
			Ellimet.find(".res901").find(".text").addClass('tooltip'); 
			Ellimet.find(".res901").find(".text").attr('data-tooltip-content', LNGning + ' ' + LNGtech901 + ' ' + NumberGetHumanReadable(costRessources[901] - metal)); 
		}	
		else
		{
			Ellimet.find(".res901").removeClass('required')
			Ellimet.find(".res901").find(".text").removeClass('tooltip'); 
			Ellimet.find(".res901").find(".text").removeAttr('data-tooltip-content'); 
		}
	}
	
	if(costRessources[902] > 0)
	{
		if(id == 502 || id == 503)
			costRessources[902] *= 1500;
			
		Ellimet.find(".res902").find(".text").html(NumberGetHumanReadable(costRessources[902]));
		
		if(crystal < costRessources[902])	
		{
			Ellimet.find(".res902").addClass('required'); 
			Ellimet.find(".res902").find(".text").addClass('tooltip'); 
			Ellimet.find(".res902").find(".text").attr('data-tooltip-content', LNGning + ' ' + LNGtech902 + ' ' + NumberGetHumanReadable(costRessources[902] - crystal)); 
		}	
		else
		{
			Ellimet.find(".res902").removeClass('required')
			Ellimet.find(".res902").find(".text").removeClass('tooltip'); 
			Ellimet.find(".res902").find(".text").removeAttr('data-tooltip-content'); 
		}
	}	
	
	if(costRessources[903] > 0)
	{
		if(id == 502 || id == 503)
			costRessources[903] *= 1500;
			
		Ellimet.find(".res903").find(".text").html(NumberGetHumanReadable(costRessources[903]));
		
		if(deuterium < costRessources[903])	
		{
			Ellimet.find(".res903").addClass('required'); 
			Ellimet.find(".res903").find(".text").addClass('tooltip'); 
			Ellimet.find(".res903").find(".text").attr('data-tooltip-content', LNGning + ' ' + LNGtech903 + ' ' + NumberGetHumanReadable(costRessources[903] - deuterium)); 
		}	
		else
		{
			Ellimet.find(".res903").removeClass('required')
			Ellimet.find(".res903").find(".text").removeClass('tooltip'); 
			Ellimet.find(".res903").find(".text").removeAttr('data-tooltip-content'); 
		}
	}	
	
	if(costRessources[921] > 0)
	{
		if(id == 502 || id == 503)
			costRessources[921] *= 1500;
			
		Ellimet.find(".res921").find(".text").html(NumberGetHumanReadable(costRessources[921]));
		
		if(darkmatter < costRessources[921])	
		{
			Ellimet.find(".res921").addClass('required'); 
			Ellimet.find(".res921").find(".text").addClass('tooltip'); 
			Ellimet.find(".res921").find(".text").attr('data-tooltip-content', LNGning + ' ' + LNGtech921 + ' ' + NumberGetHumanReadable(costRessources[921] - darkmatter)); 
		}	
		else
		{
			Ellimet.find(".res921").removeClass('required')
			Ellimet.find(".res921").find(".text").removeClass('tooltip'); 
			Ellimet.find(".res921").find(".text").removeAttr('data-tooltip-content'); 
		}
	}			

};