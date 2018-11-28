
<div id="msg_color_menu" class="chat_img_add conteiner">
	<div style="color:#c6ff00;" class="tooltip" data-tooltip-content="<div>{$LNG.chat_msg_5}</div>">{$LNG.chat_msg_6}</div>
	<div class="separator"></div>
	<input name="msg_color" value="{$user_color}" type="hidden">
	<div id="msg_color_my">
		<input class="chat_submenu_txt_input" name="chat_msg_color_my" value="{$user_color}" maxlength="7" id="chat_msg_color_my" onkeypress="if(event.keyCode == 13){ document.chat_form.chat_msg_color_send.click();event.returnValue = false;return false; }" type="text">
		<input class="chat_submenu_btn_send cursor" name="chat_msg_color_send" value="{$LNG.chat_msg_7}" id="chat_msg_color_send" onclick="msgColorSelect('my', {$authlevel}, {$userID});event.returnValue = false;return false;" type="button">
	</div>
	<div class="separator"></div>
		<div class="msg_color_selector" style="background:#ffffff;" onclick="msgColorSelect('#ffffff', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#b0e700;" onclick="msgColorSelect('#b0e700', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#634673;" onclick="msgColorSelect('#634673', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#ff7fbd;" onclick="msgColorSelect('#ff7fbd', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#53c156;" onclick="msgColorSelect('#53c156', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#056495;" onclick="msgColorSelect('#056495', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#e7b10e;" onclick="msgColorSelect('#e7b10e', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#7145a8;" onclick="msgColorSelect('#7145a8', {$authlevel}, {$userID});"></div>
	<div class="msg_color_selector" style="background:#00ffde;" onclick="msgColorSelect('#00ffde', {$authlevel}, {$userID});"></div>
</div>
