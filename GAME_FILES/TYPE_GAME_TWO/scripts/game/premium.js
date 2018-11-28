function SliderDown(name, type)
{
	$('#'+type+'_'+name).stop(true,false).slideDown(300);
	$('#btn_'+type+'_'+name).css('display','none');
	$('#btn_'+type+'_cls_'+name).css('display','inline-block');
}

function SliderUp(name, type)
{
	$('#'+type+'_'+name).stop(true,false).slideUp(300);
	$('#btn_'+type+'_cls_'+name).css('display','none');
	$('#btn_'+type+'_'+name).css('display','inline-block');
}

function OpenBox(Key){
	var btn = $('#open_btn_'+Key)
	if(btn.text() == '+')
	{
		$('#box_'+Key).stop(true,false).slideDown(300);
		btn.text('-')
	}
	else
	{
		$('#box_'+Key).stop(true,false).slideUp(300);
		btn.text('+')
	}
}

function Totalstardust()
{
	var stardust	= $('#stardust').val();
	
	cost 	= Number(stardust) * cost_stardust;
	$('#cost_stardust').text(NumberGetHumanReadable(cost));
	if(cost > atm)
		$('#cost_stardust').css('color','#f30');
	else
		$('#cost_stardust').css('color','#090');
}

function Totalbox()
{
	var box	= $('#box').val();
	
	cost 	= Number(box) * cost_box;
	$('#cost_box').text(NumberGetHumanReadable(cost));
	if(cost > atm)
		$('#cost_box').css('color','#f30');
	else
		$('#cost_box').css('color','#090');
}

function KeyUpBuy(name)
{
	var count		= $('#count_'+name).val();
	var prem_days	= $('#days_'+name).val();
	
	var Cost		= pblist.Cost[name];
	var Factor		= pblist.Factor[name];
	var RangeValue	= pblist.RangeValue[name];
	var SetTime		= pblist.SetTime[name];
	
	var CostPerDay	= Cost * Math.pow(Factor[0], (Math.floor(Number(count)/Factor[1]))-RangeValue[0]) * Number(count);
	var Discount	= 1 - Math.min(0.50, (Number(prem_days) * 0.5 / 100)) ;
	var FullCost	= Number(prem_days) * (Number(CostPerDay) * Number(Discount));
	
	$('#cost_'+name).text(NumberGetHumanReadable(Math.round((Number(FullCost)))));
	
	if(FullCost > atm)
		$('#cost_'+name).css('color','#f30');
	else
		$('#cost_'+name).css('color','#090');
}

function KeyUpExt(name, count)
{
	var prem_days	= $('#days_'+name).val();
	
	var Cost		= pblist.Cost[name];
	var Factor		= pblist.Factor[name];
	var RangeValue	= pblist.RangeValue[name];
	var SetTime		= pblist.SetTime[name];
	
	var CostPerDay	= Cost * Math.pow(Factor[0], (Math.floor(Number(count)/Factor[1]))-RangeValue[0]) * Number(count);
	
	var Discount = 1 - Math.min(0.50, (Number(prem_days) * 0.5 / 100));
	
	var FullCost	= Number(prem_days) * (Number(CostPerDay) * Number(Discount));
	
	$('#cost_'+name).text(NumberGetHumanReadable(Math.round((Number(FullCost)))));
	if(FullCost > atm)
		$('#cost_'+name).css('color','#f30');
	else
		$('#cost_'+name).css('color','#090');
}

function resetBonus(name)
{
	$.post("game.php?page=premium", {'mode': 'premResetInfo', 'item': name, 'ajax': 1}, function(info) {
		if(confirm(info.msg) && info.done == 1)
		{
			$.post("game.php?page=premium", {'mode': 'premReset', 'item': name, 'ajax': 1}, function(data) {
				alert(data.msg);
				window.location = 'game.php?page=premium';
			}, "json");
		}
	}, "json");
}

(function(e){var t=0;var n=1;var r=1e3;jQuery.autocountdown=function(){e(".countdown2").countdown2();t=setInterval("$('.countdown2').countdown2();",r)};jQuery.fn.countdown2=function(r){var s={refresh:1,interval:1e3,cdClass:"countdown2",granularity:4,label:["w ","d ","h","m:",""],units:[604800,86400,3600,60,1]};if(r&&r.label){e.extend(s.label,r.label);delete r.label}if(r&&r.units){e.extend(s.units,r.units);delete r.units}e.extend(s,r);var o=function(e,t){e=String(e);t=parseInt(t)||2;while(e.length<t)e="0"+e;if(e<1)e="00";return e};var u=function(e){var t=s.label;var n=s.units;var r=s.granularity;output="";for(i=1;i<=n.length;i++){value=n[i];if(e>=value){var u=o(Math.floor(e/value),2);u=u>0?u:"00";output+=u+t[i];e%=value;r--}else if(value==1)output+="00";if(r==0)break}if(output.length<3)output="00:"+output;return output?output:"00:00"};return this.each(function(){secs=e(this).attr("secs");e(this).html(u(secs));secs--;if(secs<1){e(this).attr("secs","...");clearInterval(t);if(n)window.location.href=window.location.href}else e(this).attr("secs",secs)})};e.autocountdown()})(jQuery)
