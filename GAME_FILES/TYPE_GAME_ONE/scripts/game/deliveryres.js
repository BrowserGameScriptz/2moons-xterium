var ContentDOM	= $(),
	CountPlanet = 0,
	CostOne		= 0,
	r901 		= 0,
	r902 		= 0,
	r903 		= 0,
	DOMr901		= $(),
	DOMr902		= $(),
	DOMr903		= $(),
	DOMs901		= $(),
	DOMs902		= $(),
	DOMs903		= $()
;

$(document).ready(function()
{
	ContentDOM	= $('#ally_content');

	DOMr901		= ContentDOM.find('#r901');
	DOMr902		= ContentDOM.find('#r902');
	DOMr903		= ContentDOM.find('#r903');

	DOMs901		= ContentDOM.find('#s901');
	DOMs902		= ContentDOM.find('#s902');
	DOMs903		= ContentDOM.find('#s903');

	DOMs931		= ContentDOM.find('#cost');
	
	DOMs217		= ContentDOM.find('#totalEvoTransporters');

	DOMr901.keyup(CalculatorResources);
	DOMr902.keyup(CalculatorResources);
	DOMr903.keyup(CalculatorResources);
});

function CalculatorResources()
{
	var Max901 	= Number(getRessource('metal'));
	var Max902 	= Number(getRessource('crystal'));
	var Max903 	= Number(getRessource('deuterium'));
	var Max931 	= Number(getRessource('atm'));
	
	var Val901 	= Number(DOMr901.val().replace(/[^[0-9]|\.]/g, ''));
	var Val902 	= Number(DOMr902.val().replace(/[^[0-9]|\.]/g, ''));
	var Val903 	= Number(DOMr903.val().replace(/[^[0-9]|\.]/g, ''));	

	var sVal901 = Val901 * CountPlanet;
	var sVal902 = Val902 * CountPlanet;
	var sVal903 = Val903 * CountPlanet;
	var sVal931 = CostOne * CountPlanet;	
	
	var MaxResourceChoosen = sVal901 + sVal902 + sVal903;
	var MaxEvoNeeded	   = Math.round(Math.max(1,MaxResourceChoosen/MaxRoomDel));
	
	if(sVal901 > Max901)
		DOMs901.text(NumberGetHumanReadable(sVal901)).css('color', '#DC2E31');	
	else
		DOMs901.text(NumberGetHumanReadable(sVal901)).css('color', '#a47d7a');	
	
	if(sVal902 > Max902)	
		DOMs902.text(NumberGetHumanReadable(sVal902)).css('color', '#DC2E31');	
	else
		DOMs902.text(NumberGetHumanReadable(sVal902)).css('color', '#5ca6aa');	
		
	if(sVal903 > Max903)
		DOMs903.text(NumberGetHumanReadable(sVal903)).css('color', '#DC2E31');
	else
		DOMs903.text(NumberGetHumanReadable(sVal903)).css('color', '#339966');	
	
	if(MaxEvos > MaxEvoNeeded)
		DOMs217.css('color', '#006600');	
	else
		DOMs217.css('color', '#b20000');
	
	DOMr901.val(NumberGetHumanReadable(Val901));
	DOMr902.val(NumberGetHumanReadable(Val902));
	DOMr903.val(NumberGetHumanReadable(Val903));
	
	DOMs217.text(NumberGetHumanReadable(MaxEvoNeeded));
	
	if(sVal931 > Max931)
		DOMs931.text(NumberGetHumanReadable(sVal931)).css('color', '#DC2E31');
	else
		DOMs931.text(NumberGetHumanReadable(sVal931)).css('color', '#76C400');
	
}

function planet_select(id)
{
	if($('#p'+id).prop('checked'))
	{
		
		if(CountPlanet > 0)
			CountPlanet--;
		
		CalculatorResources();
		$('#p'+id).prop('checked', false);
		$('#prow_'+id).removeClass('rd_planet_row_active');
	}
	else
	{
		CountPlanet++;
		CalculatorResources();
		$('#p'+id).prop('checked', true);
		$('#prow_'+id).addClass('rd_planet_row_active');
	}
};

function planet_select_all()
{
	CountPlanet = MaxPlanet;
	CalculatorResources();
	$('.rd_checkbox_planet').prop('checked', true);
	$('.rd_checkbox_moon').prop('checked', true);
	$('.rd_planet_row_select_planet').addClass('rd_planet_row_active');
	$('.rd_planet_row_select_moon').addClass('rd_planet_row_active');
}

function planet_reset_all()
{
	CountPlanet = 0;
	CalculatorResources();
	$('.rd_checkbox_planet').prop('checked', false);
	$('.rd_checkbox_moon').prop('checked', false);
	$('.rd_planet_row_select_planet').removeClass('rd_planet_row_active');
	$('.rd_planet_row_select_moon').removeClass('rd_planet_row_active');
}

function planet_all_planets()
{
	CountPlanet = MaxOPlane;
	CalculatorResources();
	$('.rd_checkbox_moon').prop('checked', false);
	$('.rd_checkbox_planet').prop('checked', true);
	$('.rd_planet_row_select_moon').removeClass('rd_planet_row_active');
	$('.rd_planet_row_select_planet').addClass('rd_planet_row_active');
}

function planet_all_moons()
{
	CountPlanet = MaxOmoons;
	CalculatorResources();
	$('.rd_checkbox_planet').prop('checked', false);
	$('.rd_checkbox_moon').prop('checked', true);
	$('.rd_planet_row_select_planet').removeClass('rd_planet_row_active');
	$('.rd_planet_row_select_moon').addClass('rd_planet_row_active');
}

function delivery_send()
{
	DOMr901.val(function(i, old) {
			return old.replace(/[^[0-9]|\.]/g, '');
		});
	DOMr902.val(function(i, old) {
			return old.replace(/[^[0-9]|\.]/g, '');
		});
	DOMr903.val(function(i, old) {
			return old.replace(/[^[0-9]|\.]/g, '');
		});
		
	return true;
}