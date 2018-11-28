function CheckArg()
{
	DotsToCount();
	
	diameter	= $('#diameter').val();
	mondbasis	= $('#mondbasis').val();
	stars		= $('#stars').val();
	prem		= $('#prem').val();
		
	if(diameter > 0 && stars > 0) {
		//document.getElementById('form').submit();
		$('#form').submit();
	} else {
		alert('Значения в полях помеченных звёздочкой, должны быть больше нуля!');
	}
	return false;
}
function DotsToCount() {
	$('#form input[type=text]').val(function(i, old) {
		return old.replace(/[^[0-9]|\.]/g, '');
	});
}
function countDots() {
	$('#form input[type=text]').val(function(i, old) {
		return NumberGetHumanReadable(old.replace(/[^[0-9]|\.]/g, ''));
	});	
}
$(function() {
	$('#form input[type=text]').keyup(function() {
		countDots();
	});
	$('#form').submit(function() {
		DotsToCount();
	});
});
jQuery(document).ready(function(){
	countDots();
});