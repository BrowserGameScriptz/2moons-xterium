{block name="title" prepend}{$LNG.lm_academy}{/block}
{block name="content"}
<div id="tooltip" class="tip"></div>
    	<div id="body"><div id="popup_conteirer">
	<div id="content">
	
	<div id="achivment">
    <div class="ach_main_block" style="width:683px;">

<div class="ach_main_content" style="height: 170px;">
                            
            <div class="ach_menu">
                <ul>
                	                    <li class="active">
                        <a href="#"  onClick="comparse();">Ban User</a>
                    </li>
                                     
                                        <li>
                        <a href="#" onClick="comparso();">Unban User</a>
                    </li>
                              
                                    
                                    </ul>  
            </div> 
            
            <div class="ach_content_box">
			
			<div id="divo" style="display:none">
<a class="tooltip_class_a_bigbtn" href="LINK">UNBLOCK USER</a></div>

<div id="diva" style="display:none">
<a class="tooltip_class_a_bigbtn" style="bottom: 10px;position: absolute;width: 70%;margin: 10px;"  href="LINK">MUTE USER</a></div>

<div id="dive">

<a class="tooltip_class_a_bigbtn" href="LINKK">BLOCK USER</a></div>


<div id="divu" style="display:none">
  <div style="padding: 10px;">
<div class="fl_mission_selector_row" style="WIDTH: 48%;float: left;">            
                		<input name="radio" value="1" type="radio">
                		<label>ALL MESSAGES</label>
                    </div>
<div class="fl_mission_selector_row" style="WIDTH: 48%;float: left;">            
                		<input name="radio" value="2" type="radio">
                		<label>SPECIFIC MESSAGES</label>
                    </div>
  
  <br>
  <textarea placeholder="REASON: TEXT INPUT" cols="60" rows="3" style="width: 98%;"></textarea></div>
<a class="tooltip_class_a_bigbtn" style="bottom: 10px;position: absolute;width: 70%;margin: 10px;"  href="LINKK">DELETE MESSAGES</a></div>
    <div class="clear"></div>
        		                </div>   
                <div style="padding-top:7px;"></div>
                <div class="clear"></div>   
                            
	 		</div>

</div>
</div>
            <div class="clear"></div>   
            </div> </div> </div>         
        <!--/body-->
		

		{/block}
		
		{block name="script" append}
				<script> 
function comparso() {
if (document.getElementById("divo").style.display=="none"){ 
document.getElementById("divo").style.display="block";
document.getElementById("diva").style.display="none";
document.getElementById("dive").style.display="none";
document.getElementById("divu").style.display="none";
} else {
document.getElementById("divo").style.display="none";} }

function comparsa() {
if (document.getElementById("diva").style.display=="none"){ 
document.getElementById("diva").style.display="block";
document.getElementById("divo").style.display="none";
document.getElementById("dive").style.display="none";
document.getElementById("divu").style.display="none";
} else {
document.getElementById("diva").style.display="none";} }

function comparse() {
if (document.getElementById("dive").style.display=="none"){ 
document.getElementById("dive").style.display="block";
document.getElementById("diva").style.display="none";
document.getElementById("divo").style.display="none";
document.getElementById("divu").style.display="none";
} else {
document.getElementById("dive").style.display="none";} }

function comparsu() {
if (document.getElementById("divu").style.display=="none"){ 
document.getElementById("divu").style.display="block";
document.getElementById("diva").style.display="none";
document.getElementById("dive").style.display="none";
document.getElementById("divo").style.display="none";
} else {
document.getElementById("divu").style.display="none";} }
</script> 
		{/block}
