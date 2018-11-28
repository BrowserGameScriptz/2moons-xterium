var IdEnchere = 0;
var IdAcq=0

 function FadeMsgBox(msg,param) {

        md = document.createElement('div');
        md.style.position= "absolute";
        md.style.display = "block";
        if (param) {
            img = 'checkOK.png';
        } else {
            img = 'checkKO.png';
        }
        var l = 305;
        var h = 40;
        md.innerHTML = "<div class='FadeMsgBox' style='width:315px;height:100px;line-height:18px;'><table width='" + l + "px' height='" + h + "px'><tr><td style='text-align:right;width:50px;padding-left:20px;'><img src='styles/images/" + img + "' width='50px;'></td><td><b>" + msg + "</b></td></tr></table></div>";
        centre = document.getElementById("Centre");
        var x = (centre.clientWidth-l)/2;
        var y = (centre.clientHeight - h) / 3 + centre.scrollTop;
        md.style.top = "40px";
        md.style.left = x+"px";
        centre.appendChild(md);
        Fade();
    }

    var cur = 0;
    var md;
    var effets=[0,1,2,3,4,5,6,7,8,9,10,10,10,10,10,9,8,7,6,5,4,3,2,1,0]
    function Fade() {
        md.style.opacity = effets[cur]/10;
        md.style.filter = "alpha(opacity = '" + effets[cur] * 10 + "')";
        cur++;
        if (cur >= effets.length) {
            centre.removeChild(md);
            cur = 0;
            md = null;
            return; 
        }
        window.setTimeout("Fade();", 50 + effets[cur] *20);
}
	
function Encherir() {

            if (IdAcq==IdJ) {
                FadeMsgBox(lng5, false)
                return
            }
            var TMet = SansPoints(document.getElementById('current_metal').innerHTML);
            var TCri = SansPoints(document.getElementById('current_crystal').innerHTML);
            var TDeut = SansPoints(document.getElementById('current_deuterium').innerHTML);
            
            var met = GetValue('TxtMetal');
            var cri = GetValue('TxtCristal');
            var deut = GetValue('TxtDeuterium');

            var EnchereMini = parseFloat(SansPoints(document.getElementById('LblEnchereMini').innerHTML));
            var DejaMise = parseFloat(SansPoints(document.getElementById('LblMontantEnchere').innerHTML));
            document.getElementById('TxtMetal').value = "";
            document.getElementById('TxtCristal').value = "";
            document.getElementById('TxtDeuterium').value = "";
            if (Math.round(met + cri * CTICri + deut * CTIDeut) + DejaMise < EnchereMini) return;
			if (Math.round(met + cri * CTICri + deut * CTIDeut) + DejaMise > EnchereMini + 1000000000) return;
                
            document.getElementById('LblAjoutEnchere').innerHTML = '0';

            var xhr = getXhr();
            xhr.open("GET", "FaireEnchere.php?m="+met+"&c="+cri+"&d="+deut+"&Date=" + new Date() * Math.random(), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var Reponse = xhr.responseText;
                    var param = Reponse.split('|');
                    if (param[0] == 'OK') {
                        document.getElementById('LblMontantEnchere').innerHTML = MEFN(param[1])
                        MsgEnchere(true);
						var metals 			= Number(String($('#current_metal').text()).replace(/[.]/g, ''));
						var crystals		= Number(String($('#current_crystal').text()).replace(/[.]/g, ''));
						var deuteriums		= Number(String($('#current_deuterium').text()).replace(/[.]/g, ''));
						$('#current_metal').text(NumberGetHumanReadable(metals - met));
						$('#current_crystal').text(NumberGetHumanReadable(crystals - cri));
						$('#current_deuterium').text(NumberGetHumanReadable(deuteriums - deut));
                    } else {
                        MsgEnchere(false);
                    }
                }
            }
            xhr.send(null);
            SuiviEncheres(false)
}
function SuiviEncheres(Auto) {
            var xhr = getXhr();
            xhr.open("GET", "SuiviEnchere.php?Date=" + new Date() * Math.random(), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    Message = xhr.responseText;
                    if (Message != '') {
                        var param = Message.split('|');
                        if (param[0] == 'F') {
                            window.setTimeout("Reload();", 500);
                            return;
                        }
                        else {
                            var sColor = '#00FF00';
                            if (parseFloat(param[5]) <= 5) {
                                sColor = '#FF0000';
                            } else if (parseFloat(param[5]) < 11) sColor = '#FFA500';
                            document.getElementById('LblTempsRestant').innerHTML =  lng3 + "&nbsp;<span style='color:" + sColor + ";'>approx. " + param[5] + "&nbsp;" + lng4;
                        }
                        document.getElementById('LblEnchereActuelle').innerHTML = MEFN(param[1]);
                        document.getElementById('LblAcquereur').innerHTML = param[2];
                        document.getElementById('LblNbEncheres').innerHTML = MEFN(param[3]);
                        document.getElementById('LblMontantEnchere').innerHTML = MEFN(param[7]);
                        IdAcq=parseInt(param[6]);
                        if (IdJ == IdAcq) document.getElementById('LblMontantEnchere').innerHTML = MEFN(param[1]);
                        if (param[1] != 0) document.getElementById('LblEnchereMini').innerHTML = MEFN(parseFloat(param[1]) + 1000000000);
                        var NewIdEnchere = parseFloat(param[4]);
                        if (NewIdEnchere != IdEnchere) {
                            Cligno(0);
                            IdEnchere = NewIdEnchere;
                        }
                    }
                    if (Auto) window.setTimeout("SuiviEncheres(true);", 1000);
                }
            }
            xhr.send(null);
}
  function getXhr() {
            var xhr = null;
            if (window.XMLHttpRequest)
                xhr = new XMLHttpRequest();
            else if (window.ActiveXObject) { // Internet Explorer 
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            }
            else {
                alert("Your browser does not support XMLHttpRequest objects...");
                xhr = false;
            }
            return xhr

}
function Cligno(c) {

            var col = "000000"
            if (c % 2 == 0) col = "FFFFFF";          
            document.getElementById('TblEnchere').style.backgroundColor = "#" + col;            
            c++;            
            if (c<4) window.setTimeout("Cligno("+c+");", 50);
}
		
function SansPoints(aString) {
        while (aString.indexOf('.') != -1) {
            aString = aString.replace('.', '');
        }
        while (aString.indexOf(' ') != -1) {
            aString = aString.replace(' ', '');
        }
        return aString;
}

function SetMax(Idobj) {

            //var EnchereActuelle = parseInt(SansPoints(document.getElementById('LblEnchereActuelle').innerHTML));
            var enchereMini = parseInt(SansPoints(document.getElementById('LblEnchereMini').innerHTML));
            var DejaMise= parseInt(SansPoints(document.getElementById('LblMontantEnchere').innerHTML));
            var Reste = enchereMini - DejaMise;
                        
            var met = GetValue('TxtMetal');
            var cri = GetValue('TxtCristal') * CTICri;
            var deut = GetValue('TxtDeuterium') * CTIDeut;
            if (Idobj == 'TxtMetal') {
                var Mise = Reste - (cri + deut);
                if (Mise > 0) {
                    var TMet = SansPoints(document.getElementById('current_metal').innerHTML);
                    if (Mise <= TMet) {
                        document.getElementById(Idobj).value = Mise;
                    } else {
                        document.getElementById(Idobj).value = TMet;
                    }
                    Augmentation();
                }
            }
            if (Idobj == 'TxtCristal') {
                var Mise = Math.ceil((Reste - (met + deut))/CTICri);
                if (Mise > 0) {
                    var TCri = SansPoints(document.getElementById('current_crystal').innerHTML);
                    if (Mise <= TCri) {
                        document.getElementById(Idobj).value = Mise;
                    } else {
                        document.getElementById(Idobj).value =TCri;
                    }
                    Augmentation();
                }
            }
            if (Idobj == 'TxtDeuterium') {
                var Mise = Math.ceil((Reste - (met + cri))/ CTIDeut);
                if (Mise > 0) {
                    var TDeut = SansPoints(document.getElementById('current_deuterium').innerHTML);
                    if (Mise <= TDeut) {
                        document.getElementById(Idobj).value = Mise;                        
                    } else {
                        document.getElementById(Idobj).value = TDeut;
                    }
                    Augmentation();
                }
            }
}

function GetValue(obj) {
            var v = document.getElementById(obj).value;
            var ret = 0;
            if (v != '') ret = parseFloat(v);
            return ret;
}

function Augmentation() {
            var met = GetValue('TxtMetal');
            var cri = GetValue('TxtCristal');
            var deut = GetValue('TxtDeuterium');
            var t = Math.ceil(met + cri * CTICri + deut * CTIDeut);
            if (!isNaN(t) && t != 0) {
                var enchereMini = parseInt(SansPoints(document.getElementById('LblEnchereMini').innerHTML));
                var enchereActuelle = parseInt(SansPoints(document.getElementById('LblMontantEnchere').innerHTML)) + t;
                if (enchereActuelle < enchereMini) {
                    document.getElementById('LblAjoutEnchere').innerHTML = "<span style='color:red;'>+" + MEFN(t) + "</span>"
                } else {
                    document.getElementById('LblAjoutEnchere').innerHTML = "<span style='color:lime;'>+" + MEFN(t) + "</span>"
                }
            }
            else {
                document.getElementById('LblAjoutEnchere').innerHTML = "0"
            }
}

function MEFN(nb) {

        var StrNb = Math.abs(nb) + '';
        var Aff = '';
        var Dot = 0;
        for (i = StrNb.length - 1; i >= 0; i--) {
            Aff = StrNb.substring(i, i + 1) + Aff;
            if (Dot++ == 2) {
                if (i != 0) {
                    Aff = "." + Aff;
                    Dot = 0;
                }
            }
        }
        if (nb < 0) Aff = "-" + Aff;
        return Aff;
}

function CheckNb(event) {
            if (!event && widows.event) {
                event=window.event;            
            }        
            var key = event.keyCode;
            if ((key < 48 || key > 57) && (key < 35 || key > 46) && (key < 96 || key > 105) && key!=8 && key!=9 ) {                
                return false;
            }

}
function CompteRebourg() {
            var no = 0;
            var noV = 0;
            do {
                sortie = false;
                var Obj = document.getElementById('CR' + no);
                if (Obj != null) {

                    DtFin = new Date(Date.parse(TabCR[no]));
                    DtNow = new Date();
                    sec = Math.floor((DtFin.valueOf() - DtNow.valueOf()) / 1000) + delta;
                    var sec2 = sec;

                    if (sec < 0) {                        
                        window.setTimeout("Reload();", 500);
                        return;
                    }
                    else {
                        min = 0;
                        hour = 0;
                        if (sec > 59) {
                            min = Math.floor(sec / 60);
                            sec -= min * 60;
                        }
                        if (min > 59) {
                            hour = Math.floor(min / 60);
                            min -= hour * 60;
                        }
                        if (sec < 10) sec = '0' + sec;
                        if (min < 10) min = '0' + min;

                        var h = ""
                        if (hour > 0) h = hour + "h ";
                        document.getElementById('CR' + no).innerHTML = h+ min + "m " + sec+"s";
                        if (no == 0) {                            
                            document.title = h+min + "m " + sec + "s -" + StrPage;
                        }
                    }

                    var pic = document.getElementById('V' + no);
                    if (pic != null) {
                        var offset = parseFloat(TabOff[noV]);
                        var x0 = parseInt(sec2 * offset);
                        if (offset >= 0) {
                            x0 = 310 - x0;
                        } else {
                            x0 = -x0;
                        }
                        pic.style.left = x0 + "px";
                        noV++;
                    }
                    no++;
                    sortie = true;
                }
            }
            while (sortie == true);
            window.setTimeout("CompteRebourg();", 500);
        }

function Reload() {
            document.location = "/game.php?page=auctioneer"
}

function checkpopup() {
            if (PopupAffiche == 1) {
                if (Math.abs(MouseX - backMouseX) > 2 || Math.abs(MouseY - backMouseY) > 2) {
                    clearpopup();
                    PopupAffiche = 0;
                }
            }
}
function MsgEnchere(value) {
            cpmd = document.createElement('div');
            cpmd.style.position = "absolute";
            cpmd.style.display = "block";            
            var l = 305;
            var h = 90;
            var msg;
            var img;
            if (value) {
                msg= lng1
                img = 'checkOK.png';
            } else {
                msg = lng2
                img = 'checkKO.png';
            }

            cpmd.innerHTML = "<div class='FadeMsgBox' style='width:315px;height:100px;'><table width='" + l + "px' height='" + h + "px'><tr><td style='text-align:right;width:50px;padding-left:20px;'><img src='styles/images/" + img + "' width='50px;'></td><td><b>" + msg + "</b></td></tr></table></div>";
            centre = document.getElementById("Centre");
            var x = (centre.clientWidth - l) / 2;
            var y = (centre.clientHeight - h) / 3 + centre.scrollTop;
            cpmd.style.top = "40px";
            cpmd.style.left = x + "px";
            centre.appendChild(cpmd);
            qFade();
}
function clearpopup() {
            document.getElementById('popup').style.display = 'none';
}
 function qFade() {
            cpmd.style.opacity = effets[cur] / 10;
            cpmd.style.filter = "alpha(opacity = '" + effets[cur] * 10 + "')";
            cur++;
            if (cur >= effets.length) {
                centre.removeChild(cpmd);
                cur = 0;
                lmd = null;
                return;
            }
            window.setTimeout("qFade();", 50 + effets[cur] * 20);
}
