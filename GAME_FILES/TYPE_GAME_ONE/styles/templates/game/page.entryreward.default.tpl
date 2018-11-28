{block name="title" prepend}{/block}
{block name="content"}
<div class="title-nav bga-tn">
	<div class="title-text"></div>
</div>
<div id="popup">
	
<div class="foll-scroll">
	<div class="bn-lup-bg i-er-0" style="top:40px;">
		<div class="bn-lup-title">Награда за вход</div>
		<div id="er-ico-1" class="bn-er-ico"></div>
		<div id="er-ico-2" style="display:none;" class="bn-er-ico i-er-901"></div>
	</div>
	
		<div class="bn-awards-title msg-res-row c-901 tooltip" style="width:150px; margin:auto; display:none; top:255px;" data-tooltip-content="Металл">
		<div class="msg-res-row-i ri i-901"></div>
		15 150 000
	</div>
	</div>
<script type="text/javascript">
var arrayER 	= [1,2,3,4,5,6,7,8,9,10,11,901,902,903,921,200,400];
$(function() 
{	
	$('.title-nav:first').hide();
	$('#popup').css('top',0);
	
	DOM['er-ico-1']	= $('#er-ico-1');
	DOM['er-ico-2']	= $('#er-ico-2');
	erewardbust(100,0);
});
function erewardbust(time,i)
{	
	if(time > 550)
	{
		DOM['er-ico-1'].hide();
		DOM['er-ico-2'].show();	
		$('.bn-awards-title').show();		
	}
	else
	{
		do{
			var rand = Math.floor(Math.random() * (arrayER.length));
		} while (i == arrayER[rand]);
		
		DOM['er-ico-1'].attr('class', 'bn-er-ico i-er-'+arrayER[rand]);
		setTimeout('erewardbust('+(time*1.08)+', '+rand+')', time);	
		
	}
}
</script>
{/block}
{block name="script" append}

{/block}