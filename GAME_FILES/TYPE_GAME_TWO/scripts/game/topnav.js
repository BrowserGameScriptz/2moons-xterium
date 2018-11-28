function resourceTicker(config, init) {
	if(typeof init !== "undefined" && init === true)
		window.setInterval(function(){resourceTicker(config)}, 1000);
		
	var element	= document.getElementById(config.valueElem);
	
		
	if(element.className.match(/res_current_max/) !== null)
		return false;
		
	var nrResource = Math.max(0, Math.round(config.available + config.production / 3600 * (serverTime.getTime() - startTime) / 1000));
	//console.log(nrResource);
	if (nrResource < config.limit[1]) 
	{
		if (nrResource >= config.limit[1])
			element.className = element.className+" res_current_max";
		else if (nrResource >= config.limit[1] * 0.9)
			element.className = element.className+" res_current_warn";
		
		if(shortlyNumber) {
			element.innerHTML	= Humanize.formatNumber(nrResource);
			element.name		= Humanize.formatNumber(nrResource);
		} else {
			element.innerHTML	= Humanize.formatNumber(nrResource);
			$('#res_block_'+config.valueName+' .pricent').html(String(Math.round(Number(nrResource) / Number(config.limit[1]) * 100)));
			$('#res_block_'+config.valueName+' .stock_percentage').width(String(Math.round(Number(nrResource) / Number(config.limit[1]) * 100))+'%');
		}
	} else {
		$('#res_block_'+config.valueName+' .pricent').html(100);
		$('#res_block_'+config.valueName+' .stock_percentage').width('100%');
		
	}
}

function getRessource(name) {
	if(shortlyNumber) {
		return parseInt($('#current_'+name).attr('name').replace(/\./g, ''));
	} else {
		return parseInt($('#current_'+name).text().replace(/\./g, ''));
	}
}
/*
if (queryString != "page=galaxy"){
function MovimentoPlanet(mo_planet){
        mo_planet = (mo_planet) ? mo_planet : ((evento) ? evento : null);
        if(mo_planet.keyCode == 37) {
         document.location = '?'+queryString+'&cp='+(back);
     }if(mo_planet.keyCode == 39) {
        document.location = '?'+queryString+'&cp='+(next);
      }
	  
  }
  document.onkeydown = MovimentoPlanet;}
  */