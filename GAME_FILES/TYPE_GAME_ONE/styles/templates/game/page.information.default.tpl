{block name="title" prepend}{$LNG.lm_info}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
<div id="ally_content" class="conteiner" style="width:auto;">
    <div class="gray_stripe">
       {$LNG.tech.$elementID}             
    </div> 
	<div class="info_elements">
    	<div class="content_box">
            <div class="image">
               <img src="./styles/theme/gow/gebaeude/{$elementID}.{if $elementID >=600 && $elementID <= 699}jpg{else}gif{/if}" alt="">
            </div>
            <div class="prices">
                {$LNG.longDescription.$elementID}
            </div>
        </div>
        <div class="clear"></div>	
              {if !empty($productionTable.production)}
{include file="shared.information.production.tpl"}
{/if}
{if !empty($productionTable.storage)}
{include file="shared.information.storage.tpl"}
{/if}
{if !empty($FleetInfo)}
{include file="shared.information.shipInfo.tpl"}
{/if}
{if !empty($gateData)}
{include file="shared.information.gate.tpl"}
{/if}
{if !empty($MissileList)}
{include file="shared.information.missiles.tpl"}
{/if}                          	</div>
</div>
</div>
</div>
            <div class="clear"></div>   
						<script type="text/javascript">
var ctrlKeyDown = false;

$(document).ready(function(){    
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
});

function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};

function keyup(e){
    // Key up Ctrl
    if ((e.which || e.keyCode) == 17) 
        ctrlKeyDown = false;
};

function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

$(document).ready(function(){
$(document).on("keydown", disableF5);
});


</script>
			
            </div>         
        </div><!--/body-->
		
		
					
					
					
					


{/block}