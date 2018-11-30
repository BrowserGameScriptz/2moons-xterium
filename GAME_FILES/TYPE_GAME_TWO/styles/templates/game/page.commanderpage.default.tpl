{block name="title" prepend}Admirals Seite{/block}
{block name="content"}
<style>
.tip {
	padding: 7px 10px;
	border: 1px solid #3096c0;
	background: #003f7f;
	background: rgba(0, 63, 127, 0.9);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
	text-align: left;
	line-height: 15px;
	position: absolute;
	display: none;
	z-index: 9999;
}
/*Commander ZONE*/

 .com_status_eq {
float: left;
width: 630px;
}
 .com_status {
width: 370px;
float: left;
height: 312px;
background: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_eq_status.png) 0px -2px;
box-shadow: inset 0 0 7px #74a5c2;
_margin-bottom: 2px;
}
 .com_status .con_box {
padding: 10px 10px 0px;
_padding: 10px 6px 0px;
}
 .com_name {
font-weight: bold;
width: 155px;
float: left;
white-space: nowrap;
overflow: hidden;
}
 .com_details {
clear: both;
padding-top: 5px;
_zoom: 1;
_padding: 0px;
}
.commander_bg_s {
background: url(//static.{$my_game_url}/media/gamemedia/media/images/commanderbg_85x85.jpg);
width: 83px;
height: 83px;
padding: 1px;
float: left;
}
.commander_race3 .commander2 {
background: url(//static.{$my_game_url}/media/gamemedia/media/images/commanderinfantry_commander_attack.png);
}
.commander_bg_s .commander_s {
background-position: -33px -10px;
background-repeat: no-repeat;
height: 100%;
}
 .com_de_info {
white-space: nowrap;
overflow: hidden;
padding-left: 7px;
padding-top: 3px;
line-height: 16px;
}
 .com_de_info {
white-space: nowrap;
line-height: 16px;
}
 .com_de_info {
white-space: nowrap;
line-height: 16px;
}
 .com_de_info .info_value {
color: #fad375;
}
 .bar_box {
clear: both;
padding: 0px 0px 0px 92px;
_padding-top: 0px;
_padding-left: 88px;
_zoom: 1;
}
 .bar_box .bar_con {
padding-top: 1px;
clear: both;
}
 .bar_box .bar_label {
float: left;
line-height: 20px;
width: 28px;
_width: 32px;
}
 .bar {
height: 20px;
float: left;
background: #1f3143;
margin: 0;
overflow: hidden;
}
 .bar_box .bar {
width: 94px;
margin: 0 0 0 5px;
}
.pop_orange {
color: #fad375;
}
 .bar .bartxt {
height: 20px;
float: left;
text-align: center;
position: absolute;
font-weight: bold;
padding: 0;
line-height: 20px;
}
 .bar_box .bartxt {
width: 94px;
}
 .bar_box .bar .bartxt {
font-weight: normal;
}
 .barcolor {
height: 18px;
float: left;
background: url("//static.{$my_game_url}/media/gamemedia/media/images/commander/loading_bar.gif") no-repeat;
margin-top: 1px;
}
 .bar_box .bar_con {
padding-top: 1px;
clear: both;
}
 .bar_box .bar_label {
float: left;
line-height: 20px;
width: 28px;
_width: 32px;
}
 .bar_box .bar {
width: 94px;
margin: 0 0 0 5px;
}
 .bar .bartxt {
height: 20px;
float: left;
text-align: center;
position: absolute;
font-weight: bold;
padding: 0;
line-height: 20px;
}
 .bar_box .bartxt {
width: 94px;
}
 .bar_box .bar .bartxt {
font-weight: normal;
}
 .barcolor.red {
background-position: 0 -20px;
}
 .points_area {
clear: both;
padding-top: 8px;
_padding-top: 6px;
}
 .points_area {
line-height: 22px;
_line-height: 21px;
}
 .points_area ul {
_zoom: 1;
}
 .points_area li {
clear: both;
_height: 21px;
padding: 1px 0px 0px;
margin: 0px;
font-weight: normal;
border-top: 1px solid #3f536c;
}
 .points_area .obj {
float: left;
}
 .points_area .silk {
width: 108px;
}
 .points_area .title_line .talent_w {
color: #fff;
}
 .points_area .value_w {
width: 147px;
_width: 158px;
text-align: center;
white-space: nowrap;
position: relative;
}
 .points_area .ass_w {
text-align: center;
width: 41px;
}
 .points_area .silk {
width: 108px;
}
 .points_area {
line-height: 22px;
}
.points_area ul{
	list-style: none;
}
.comm_icon {
width: 21px;
height: 21px;
background: url("//static.{$my_game_url}/media/gamemedia/media/images/commander/comm_icon.png") no-repeat;
float:left;
}
 .points_area .talent_w {
color: #fad375;
}
 .points_area li {
font-weight: normal;
}
 .points_area .value_w {
text-align: center;
white-space: nowrap;
}
.pop_green {
color: #2ebe23;
}
 .com_eq {
margin-left: 1px;
background: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_eq_box.gif) no-repeat;
float: left;
position: relative;
width: 254px;
height: 314px;
}
 .com_eq .eq_name {
padding: 0px 10px;
text-align: center;
line-height: 40px;
font-weight: bold;
}
 .race_eq_body {
position: absolute;
top: 41px;
left: 78px;
height: 203px;
width: 97px;
}
 .race3 .race_body_0 {
background-image: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/eq_body_1.png);
}
 .slot1 {
top: 51px;
left: 16px;
}
 .com_eq .eq_slot {
width: 56px;
height: 56px;
position: absolute;
cursor: pointer;
}
.tooltip.eq_info_tip {
width: 300px;
padding: 0px;
}
.eq_info_tip .title_row {
background: #012851;
line-height: 20px;
padding: 0px 10px 1px;
}
.eq_info_tip .eq_status {
padding-right: 15px;
}
.item_image {
display: block;
}
.eq_info_tip .eq_status .item_image {
float: left;
margin-left: 5px;
}
.item_image .item {
width: 86px;
height: 86px;
background: url("//static.{$my_game_url}/media/gamemedia/media/images/commander/none.png") no-repeat;
float: left;
}
.item_image .real_item246 {
background: url("//static.{$my_game_url}/media/gamemedia/media/images/commander/246_helmet_of_frost.png") no-repeat;
}
 .item_image .item {
position: relative;
display: block;
float: none;
}
 .com_eq .eq_name {
padding: 0px 10px;
text-align: center;
line-height: 40px;
font-weight: bold;
}
.eq_info_tip .eq_sp {
padding: 0px 0px 5px 100px;
}
.eq_info_tip .requir_area {
clear: both;
padding: 2px 10px 8px;
}
.eq_info_tip .requir_area .req_need {
white-space: nowrap;
}
.small_item_image {
height: 40px;
width: 40px;
display: block;
margin: 0 auto;
padding: 0;
}
 .com_eq .eq_slot .small_item_image {
margin: 10px 0px 0px 10px;
}
.small_item_image .istorage_item {
height: 36px;
width: 36px;
margin: 4px auto;
display: block;
}
.small_item_image .real_item246_s {
background: url("//static.{$my_game_url}/media/gamemedia/media/images/commander/246_helmet_of_frost_s.png") no-repeat;
}
 .slot2 {
top: 51px;
left: 180px;
}
 .slot2 { top:51px; left:180px; }
 .slot3 { top:111px; left:16px; }
 .slot4 { top:111px; left:180px; }
 .slot5 { top:170px; left:16px; }
 .slot6 { top:170px; left:180px; }
 .slot7 { top:247px; left:60px; }
 .slot8 { top:247px; left:139px; }
 .slot1 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_1.png) no-repeat; }
 .slot2 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_2.png) no-repeat; }
 .slot3 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_3.png) no-repeat; }
 .slot4 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_4.png) no-repeat; }
 .slot5 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_5.png) no-repeat; }
 .slot6 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_6.png) no-repeat; }
 .slot7 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_7.png) no-repeat; }
 .slot8 .eq_img { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/e_slot_7.png) no-repeat; }
 .com_eq .eq_slot .small_item_image { margin:10px 0px 0px 10px; }
 .race_eq_body { position:absolute; top:41px; left:78px; height:203px; width:97px; }
 .race1 .race_body_0 { background-image: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/eq_body_6.png); }
 .race1 .race_body_1 { background-image: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/eq_body_5.png); }
 .race2 .race_body_0 { background-image: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/eq_body_3.png); }
 .race2 .race_body_1 { background-image: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/eq_body_4.png); }
 .race3 .race_body_0 { background-image: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/eq_body_1.png); }
 .race3 .race_body_1 { background-image: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/eq_body_2.png); }
 .com_storage { width:626px; height:126px;  background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage.gif) no-repeat; position:relative; _margin-top:3px; float:left; }
 .active_item { height:105px; width:90px; text-align:center; position:absolute; top:12px; left:11px; }
 .active_item .item_image { margin:0px auto; }
 .active_item a.dis_link { text-decoration:underline; }
 .active_item a.dis_link:hover { text-decoration:none; }
 .active_item .item_image { margin-left:2px; }
 .com_storage .active_item .item_image .empty_sl1 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_1.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_1.png')}
 .com_storage .active_item .item_image .empty_sl2 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_2.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_2.png')}
 .com_storage .active_item .item_image .empty_sl3 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_3.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_3.png')}
 .com_storage .active_item .item_image .empty_sl4 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_4.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_4.png')}
 .com_storage .active_item .item_image .empty_sl5 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_5.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_5.png')}
 .com_storage .active_item .item_image .empty_sl6 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_6.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_6.png')}
 .com_storage .active_item .item_image .empty_sl7 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_7.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_7.png')}
 .com_storage .active_item .item_image .empty_sl8 { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty_7.png); background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty_7.png')}
 .storage_item_list { padding-left:125px; line-height:24px; font-weight:bold; }
 .sto_title { padding-bottom:5px; }
 .item_li { padding-left:2px; float:left; }
 .com_storage .item_image .item { background-position:0px 6px; }
 .com_storage .storage_item_list .item_image .empty { background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage_empty.png) no-repeat; background:none\9;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/com_storage_empty.png')}
 .com_storage .page_btn { position:absolute; top:3px; right:32px; }
 .com_storage .page_label { float:left; line-height:22px; margin-right:5px; }
 .com_storage .arrow_btn2 { float:left; margin-left:2px; }
 .item_image .item { position:relative; display:block; float:none; }


.equip_popup_box .eq_title { font-size:14px; font-weight:bold; text-align:center; padding-bottom:10px; padding-top:5px;  }
.equip_popup_box .eq_container { background:#041f30; float:left;  width:230px; padding-top:5px; }
.equip_popup_box .eq_status {  padding-right:15px; }
.equip_popup_box .eq_status .item_image { float:left; margin-left:5px; }
.equip_popup_box .eq_name { font-weight:bold; padding:5px 0px 8px 100px; }
.equip_popup_box .eq_sp { padding:0px 0px 5px 100px; }
.equip_popup_box .requir_area { clear:both; padding:2px 10px 8px; }
.equip_popup_box .requir_area .req_need { white-space:nowrap; }
.equip_popup_box .confirm_tips { text-align:center;  padding:10px 0px 13px; clear:both; }
.equip_popup_box .eq_com_arrow { width:13px; height:26px; background:url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_eq_arrow.gif) no-repeat; float:left; margin:60px 12px 20px 13px; }
.equip_popup_box .eq_exist { background:#021521; padding:3px 10px; }
.equip_popup_box .eq_current { color:#fff; }
.equip_popup_box .eq_new { color:#2ebe23; }

.com_eq .eq_img {
width: 56px;
height: 56px;
}

 .plus_btn {
 margin: 0px auto;
width: 20px;
height: 20px;
background: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/plus_btn.gif) no-repeat;
}

.com_storage {
width: 626px;
height: 126px;
background: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/com_storage.gif) no-repeat;
position: relative;
_margin-top: 3px;
float: left;
}.active_item {
height: 105px;
width: 90px;
text-align: center;
position: absolute;
top: 12px;
left: 11px;
}
.storage_item_list {
padding-left: 25px;
line-height: 24px;
font-weight: bold;
}
.sto_title {
padding-bottom: 5px;
}
.item_li {
list-style: none;
float: left;
padding-left:10px;
}
.has_item {
cursor: pointer;
}
.item_image {
display: block;
}
.page_btn {
position: absolute;
top: 3px;
right: 32px;
}
.page_label {
float: left;
line-height: 22px;
margin-right: 5px;
}
.arrow_btn2 {
float: left;
margin-left: 2px;
}
.arrow_btn2 {
width: 22px;
height: 22px;
background: url(//static.{$my_game_url}/media/gamemedia/media/images/commander/arrow_btn_2.gif) no-repeat;
}
.arrow_btn2_left {
background-position: 0px 0px;
}
.arrow_btn2_left:hover {
background-position: 0px -22px;
}
.arrow_btn2_right {
background-position: -22px 0px;
}
.item_conainer{
	margin: 0;
	padding : 0;
}
</style>
<script>
	function Unequip(x,y){
		var i = y; //item
		var p = x; //poz
			
		$.ajax({
			type: 'POST',
			url: 'game.php?page=comPage&act=unequip',
			data: 'item='+i+'&position='+p,
			dataType: 'json',
			global: false,
			success: function(json) {
				if (json.success) {
					alert('Item unequiped succesfully');
					location.reload();
				}else{
					return false;
				}
			}
		});
	}
</script>

	<table class="table519">
	<tbody>
	
	<tr>
		<tr>
			<td>
			<span class="gray_stripe">Commander</span>
		<a href="game.php?page=buyInvItems" class="right_flank input_blue">>>>{$LNG.ComP2}<<<</a><br>		
	<div id="hero_info_zone" class="com_status_eq ui-tabs-panel ui-widget-content ui-corner-bottom" style="clear:none;">  <div class="com_status">
  <div class="con_box">
    <div class="com_details">
      <div class="commander_race3">
        <div class="commander_bg_s">
          <div class="commander2 commander_s ie_fix"></div>
        </div>
      </div>
      <div class="com_de_info" style="float:left;">
        <div class="info_line">Name: <span class="info_value">{$user_details.username}</span></div>
        <div class="info_line">Level: <span class="info_value">{$user_details.user_level}</span></div>
      </div>
    </div>
    <div class="bar_box">
      <div class="bar_con exp_con">
        <span class="bar_label">Exp: </span>
        <div class="bar">
          <div class="bartxt pop_orange">{$user_details.user_experience}/{$needed_xp}</div>
          <div class="clear"></div>
          <div style="width: {$user_details.user_experience/$needed_xp*100}%;" class="barcolor"></div>
        </div>
      </div>
    </div>
    <div class="points_area">
      <ul>
        <li>
          <div class="box title_line">
            <div class="obj silk">&nbsp;</div>
            <div class="obj value_w">Total Value</div>
            <div class="obj ass_w"></div>
          </div>
        </li>
        <li>
          <div class="box">
            <div class="obj silk"><div class="ie_fix comm_icon icon1 left"></div>Angriff</div>
            <div class="obj value_w"><span base="195">{$user_details.user_attack_bonus}</span></div>
            <div class="obj ass_w">
              <a style="float: left; {if empty($user_details.user_remain_points)}display:none;{/if}" class="plus_btn" href="javascript:;" data-type="attack"></a>
            </div>
          </div>
        </li>
        <li>
          <div class="box">
            <div class="obj silk"><div class="ie_fix comm_icon icon1 left"></div>Schild</div>
            <div class="obj value_w"><span class="shield" base="86">{$user_details.user_shield_bonus}</span></div>
            <div class="obj ass_w">
               <a style="float: left; {if empty($user_details.user_remain_points)}display:none;{/if}" class="plus_btn" href="javascript:;" data-type="shield"></a>
            </div>
          </div>
        </li>
        <li>
          <div class="box">
            <div class="obj silk"><div class="ie_fix comm_icon icon1 left"></div>Lager</div>
            <div class="obj value_w"><span class="cargo" base="87">{$user_details.user_cargo_bonus}</span></div>
            <div class="obj ass_w">
               <a style="float: left; {if empty($user_details.user_remain_points)}display:none;{/if}" class="plus_btn" href="javascript:;" data-type="cargo"></a>
            </div>
          </div>
        </li>
		 <li>
          <div class="box">
            <div class="obj silk"><div class="ie_fix comm_icon icon1 left"></div>Speed</div>
            <div class="obj value_w"><span class="speed" base="87">{$user_details.user_speed_bonus}</span></div>
            <div class="obj ass_w">
               <a style="float: left; {if empty($user_details.user_remain_points)}display:none;{/if}" class="plus_btn" data-type="speed" href="javascript:;"></a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="com_eq ie_fix">
  <div class="eq_name">Armor</div>
  <span class="race3">
   
		<div class="race_eq_body race_body_0 ie_fix">
		</div>
	
  </span>
	{foreach from=$all_slots item=i key=k}
		 {if !empty($i)}
 <a href="#" slot="{$k-1}" class="eq_slot slot{$k} tooltip_holder tooltip_sticky" data-tooltip-content="<table width=170px><tr><td colspan='2'>{$i.item_name}</td></tr><tr><td>Angriff</td><td>{$i.item_attack_bonus}</td></tr><tr><td>Schild</td><td>{$i.item_shield_bonus}</td></tr><tr><td>Lager</td><td>{$i.item_cargo_bonus}</td></tr><tr><td>Speed</td><td>{$i.item_speed_bonus}</td></tr><tr><td>Minimum Level</td><td>{$i.item_lvl_req}</td></tr><tr><td>Action</td><td><a href='javascript:;' onclick='Unequip({$k},{$i.item_id})'>{$LNG.ComP5}</a></table>">
		<div class="small_item_image">
				<img src="{$i.item_picture}" width="40px" height="40px">
		</div>
	</a>
	{else}
		<a href="#" slot="{$k-1}" class="eq_slot slot{$k} tooltip_sticky" data-tooltip-content="{$k}">
			<div class="eq_img empty ie_fix"></div>
		</a>
    {/if}
	{/foreach}
	</div>
</div>
	</td></tr></table>

</div>
<script>
	$(function(){
		$(".plus_btn").click(function(){
			var atribute = $(this).attr('data-type');
			remain_points = parseInt($("span #status_pt").text());
			if(remain_points<=0)
				return false;
		//POST
			$.ajax({
				type: 'POST',
				url: 'game.php?page=comPage&act=i',
				data: 'type='+atribute,
				dataType: 'json',
				global: false,
				success: function(json) {
					if (json.success) {
						$("span #status_pt").text(remain_points-1);
						$("."+atribute).text(parseInt($("."+atribute).text())+1);
					}else{
						return false;
					}
	  
      }
    });
		});
	})
</script>
{/block}