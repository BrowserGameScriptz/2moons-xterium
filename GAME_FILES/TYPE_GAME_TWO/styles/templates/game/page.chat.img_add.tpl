<div id="chat_img_add" class="chat_img_add conteiner">
	{$LNG.chat_img_add}<br />
	<input name="chat_img" class="chat_submenu_txt_input" type="text" id="chat_img" onKeyPress="if(event.keyCode == 13){ document.chat_form.chat_img_send.click(); }"><br />
	<input class="chat_submenu_btn_send cursor" type="button" name="chat_img_send" value="{$LNG.mg_send}" id="chat_img_send" onClick="addImage();event.returnValue = false;">
</div>