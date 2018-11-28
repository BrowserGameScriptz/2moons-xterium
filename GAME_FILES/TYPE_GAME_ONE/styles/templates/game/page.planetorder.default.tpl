{block name="title" prepend}{$LNG.fleetta_res}{/block}
{block name="content"}

	<style>
		
		.connected, .sortable, .exclude, .handles {
			margin: auto;
			padding: 0;
			width: 310px;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.sortable.grid {
			overflow: hidden;
		}
		.connected li, .sortable li, .exclude li, .handles li {
			list-style: none;
			margin: 5px;
			padding: 5px;
			height: 22px;
			border: 1px solid #000;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
	background:rgba(0,102,204,0.1);
		}
		.connected li:hover, .sortable li:hover, .exclude li:hover, .handles li:hover {
			list-style: none;
			margin: 5px;
			padding: 5px;
			height: 22px;
			border: 1px solid #000;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
	background:rgba(102,204,255,0.1)!important; 
		}
		.handles span {
			cursor: move;
		}
		li.disabled {
			opacity: 0.5;
		}
		.sortable.grid li {
			line-height: 80px;
			float: left;
			width: 80px;
			height: 80px;
			text-align: center;
		}
		li.highlight {
			background: #FEE25F;
		}
		#connected {
			width: 440px;
			overflow: hidden;
			margin: auto;
		}
		.connected {
			float: left;
			width: 200px;
		}
		.connected.no2 {
			float: right;
		}
		li.sortable-placeholder {
			border: 1px dashed #CCC;
			background: none;
		}
	</style>
	
<div id="page">
	<div id="content">
<div id="ally_content" class="conteiner" style="width: 350px;">

	<form action="game.php?page=gestion" method="post" id="form">

    
    <div class="gray_stripe">
    	Order your planets
    </div>


	<section>
		<ul class="sortable list">
		{foreach $PlanetListin as $ID => $Element}
			<li id="prow_{$ID}"> <div style="width: 25px;height: 25px;border-right: 1px solid #000;float: left;padding-right: 5px;">
            <img title="{$Element.name} [{$Element.galaxy}:{$Element.system}:{$Element.planet}]" src="./styles/theme/gow/planeten/small/s_{$Element.image}.png" alt="">
        </div>
        
        <div style="float: left;line-height: 22px;margin-left: 5px;">
            <span style="color:#CC6; margin-right:10px">{$Element.name}</span>           
            <span style="color:#CCC;">[{$Element.galaxy}:{$Element.system}:{$Element.planet}]</span><br>
                    </div>
        
        <div style="float: right; margin-left: 5px;">        
        
  <select id="classement_{$ID}" name="classement_{$ID}">
  {for $order=1 to $number}
    <option value="{$order}" {if $Element.plaPosition == $order}selected="selected"{/if}>{$order}</option>
	{/for}
  </select>

        </div>      </li>
			{/foreach}
		</ul>
	</section>
	
	<div class="clear"></div>
    <div class="build_band ticket_bottom_band" style="padding-left:20px;">    

        <input class="bottom_band_submit" value="{$LNG.reduce_res_1}" type="submit">    
    </div>
    
        
	</form>
</div>

</div>
</div>

	
            <div class="clear"></div>   
            </div>         
        </div><!--/body-->
{/block}

{block name="script" append}
<script src="scripts/game/jquery.sortable.js"></script>
<script>
		$(function() {
			$('.sortable').sortable();
			$('.handles').sortable({
				handle: 'span'
			});
			$('.connected').sortable({
				connectWith: '.connected'
			});
			$('.exclude').sortable({
				items: ':not(.disabled)'
			});
		});
	</script>
{/block}