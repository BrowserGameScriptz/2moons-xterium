function proverka_email(input)
{input.value=input.value.replace(/[^a-zA-Z0-9@\-\_.]+$/g,'');};function proverka_login(input)
{input.value=input.value.replace(/[^a-zA-Z0-9@\-\_]+$/g,'');};function proverka_pass(input)
{input.value=input.value.replace(/[^a-zA-Z0-9@\-\_.]+$/g,'');};$(document).ready(function(){document.cookie="_width = "+screen.width;document.cookie="_height = "+screen.height;});function CheckEmail(mailteste)
{jQuery.post("../verif.php?action=verifemail",{'email':mailteste,'ajax':1},function(data)
{if(data.verif==0){$('#regemailcption').html('<label class="error" generated="true" for="email">'+data.message+'</label>');}else{$('#regemailcption').html('<label class="ok" generated="true" for="email">'+data.message+'</label>');}},"json");}
function CheckUsername(userteste)
{jQuery.post("../verif.php?action=verifpsuedo",{'username':userteste,'ajax':1},function(data)
{if(data.verif==0){$('#regnamecption').html('<label class="error" generated="true" for="username">'+data.message+'</label>');}else{$('#regnamecption').html('<label class="ok" generated="true" for="username">'+data.message+'</label>');}},"json");}
function CheckPwd(pwd)
{jQuery.post("../verif.php?action=verifpwd",{'username':pwd,'ajax':1},function(data)
{if(data.verif==0){$('#regpasswcption').html('<label class="error" generated="true" for="passwd">'+data.message+'</label>');}else{$('#regpasswcption').html('<label class="ok" generated="true" for="passwd">'+data.message+'</label>');}},"json");}
function setLNG(LNG,Query){var nom='lang';document.cookie=nom+"="+LNG;if(typeof Query==="undefined")
document.location.reload();else
document.location.href=document.location.href+Query;}
function getCookie(name){var v=document.cookie.match('(^|;) ?'+name+'=([^;]*)(;|$)');return v?v[2]:null;}
function fb_connect(){creategame_fb(1);}
function creategame_fb(submitgame){if(submitgame==1){fb_loginstate();return;}
token=$('#facebook_token').val();userId=$('#facebook_userId').val();window.location.href="https://warofgalaxyz.com/index.php?page=registerFB&facebook_token="+token+"&facebook_userId="+userId+"&referralID="+getCookie('ReferalId');}
function fb_loginstate(){FB.getLoginStatus(function(response){fb_status(response);});}
function fb_status(response){switch(response.status){case'connected':$('#facebook_token').val(response.authResponse.accessToken);$('#facebook_userId').val(response.authResponse.userID);creategame_fb(2);break;default:FB.login(function(response){if(response.status=='connected'){fb_status(response);}else if(response.status=='not_authorized'){window.location.href="https://warofgalaxyz.com/index.php?page=fbnoauthorize";}else{location.reload();}},{scope:'email,user_friends,publish_actions'});break;}}