//////////F12 disable code////////////////////////
document.onkeypress = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) {
        //alert('No F-12');
        return false;
    }
}
document.onmousedown = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) {
        //alert('No F-keys');
        return false;
    }
}
document.onkeydown = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) {
        //alert('No F-keys');
        return false;
    }
}
/////////////////////end///////////////////////


//Disable right click script
//visit http://www.rainbow.arch.scriptmania.com/scripts/
var message="Don't try to be copy content";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
    if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
//
function disableCtrlKeyCombination(e)
{
    //list all CTRL + key combinations you want to disable
    var forbiddenKeys = new Array('n', 'x', 'u', 's', 'j' , 'w', 's');
    var key;
    var isCtrl;
    if(window.event)
    {
        key = window.event.keyCode;     //IE
        if(window.event.ctrlKey)
            isCtrl = true;
        else
            isCtrl = false;
    }
    else
    {
        key = e.which;     //firefox
        if(e.ctrlKey)
            isCtrl = true;
        else
            isCtrl = false;
    }
//if ctrl is pressed check if other key is in forbidenKeys array
    if(isCtrl)
    {
        for(i=0; i<forbiddenKeys.length; i++)
        {
//case-insensitive comparation
            if(forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase())
            {
                //alert('Key combination CTRL + '+String.fromCharCode(key) +' has been disabled.');
                alert("Don't try to be copy content");
                return false;
            }
        }
    }
    return true;
}