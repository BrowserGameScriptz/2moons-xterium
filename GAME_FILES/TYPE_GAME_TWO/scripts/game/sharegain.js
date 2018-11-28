function change_langue() {
	var text = new Array();
	text = {nb_a: 'Nomber of attacker :', nom_a: 'Name of attacker', bilan: 'Bilan', perdu: 'Amount of lost ships', pertes: 'Losses', pillages: 'Looting', perte_pil: 'losses after looting', rec: 'Recycling', deut_dep: 'Deut consumed', renta: 'Rentability after losses and looting', diff: 'Difference with the average', sat: 'Solar satellite', pt: 'Light cargo', gt: 'Heavy cargo', cle: 'Light fighter', clo: 'Heavy fighter', m7: 'M-7', cyclo: 'Recycler', cro: 'Cruiser', vdb: 'Battleship', tdb: 'Battle transporter', tra: 'Battle cruiser', destru: 'Star fighter', bomber: 'Planet bomber', m19: 'M-19', rdb: 'Battle recycler', galli: 'Galleon', destro: 'Destroyer', edlm: 'Battle fortress', lunen: 'Black moon', m32: 'M-32', freg: 'Frigate', black: 'Black wanderer', flyi: 'Flying death', avat: 'Avatar', cuir: 'Battleship classe O\'neill', }
            
	var id = new Array('nba', 'vaiseau_perdu', 'pertetd', 'pillage', 'perteapil', 'recy', 'deut_dep', 'rentadp_pus_a', 'fin');
	var id_text = new Array(text.nb_a, text.perdu, text.pertes, text.pillages, text.perte_pil, text.rec, text.deut_dep, text.renta, text.diff);
	for (var j = 0; j < id.length; j++) {
		document.getElementById(id[j]).innerHTML = id_text[j];
	}
	
	document.getElementsByClassName('noma')[0].innerHTML = text.nom_a;
	//var vaisseau_id = new Array('sat', 'pt', 'gt', 'cle', 'clo', 'M7', 'cyclo', 'cro', 'vdb', 'tdb', 'tra', 'destru', 'bomber', 'M19', 'rdb', 'galli', 'destro', 'edlm', 'lunen', 'M32', 'freg', 'black', 'flyi', 'avat', 'cuir');
	var vaisseau = new Array(text.sat, text.pt, text.gt, text.cle, text.clo, text.m7, text.cyclo, text.cro, text.vdb, text.tdb, text.tra, text.destru, text.bomber, text.m19, text.rdb, text.galli, text.destro, text.edlm, text.lunen, text.m32, text.freg, text.black, text.flyi, text.avat, text.cuir);
	var vaisseau_id = document.getElementsByClassName('vsx');
	for (var j = 0; j < vaisseau_id.length; j++) {
		document.getElementsByClassName('vsx')[j].innerHTML = vaisseau[j];
	}
	var nb_bilan = document.getElementsByClassName('btm').length;
	for (var f = 0; f < nb_bilan.length; f++) {
		document.getElementsByClassName('btm')[f].innerHTML = text.bilan;
	}
}

// separateur de milier
function addPoints(nombre) {
	if (nombre == '?') {
		return nombre;
	}
	else if (nombre == 0) {
		return nombre;
	}
	else {
		var signe = '';
		if (nombre < 0) {
			nombre = Math.abs(nombre);
			signe = '-';
		}
		var str = nombre.toString()
		, n = str.length;
		if (n < 4) {
			return signe + nombre;
		}
		else {
		return signe + (((n % 3) ? str.substr(0, n % 3) + '.' : '') + str.substr(n % 3).match(new RegExp('[0-9]{3}', 'g')).join('.'));
		}
	}
}

function supr0(chiffre) {
	if (chiffre.indexOf('0') == 0 && chiffre != 0) {
		var chiffre = chiffre.substring(1);
	}
	return chiffre;
}

function couleur() {
	var nb = parseInt(arguments[0]);
	if (arguments[1] != undefined) {
		var avant_nb = arguments[1];
	}
	else {
		var avant_nb = '';
	}
	if (arguments[2] != undefined) {
		var apres_nb = arguments[2];
	}
	else {
		var apres_nb = '';
	}
	if (nb > 0) {
		var color = 'green';
	}
	else if (nb == 0) {
		var color = 'blue';
	}
	else {
		var color = 'red';
	}
	var a_retourner = '<span style="color:' + color + ';">' + avant_nb + addPoints(nb) + apres_nb + '</span>';
	return a_retourner;
}

function caculer_perte() { 
	//alert(document.getElementsByClassName("s202")[0].innerHTML);
	var vaisseau = new Array('s202','s203','s204','s205','s229','s209','s206','s207','s217','s215','s213','s211','s224','s219','s225','s226','s214','s216','s230','s227','s228','s222','s218','s221');
	var vaisseau_perte_m = new Array("2000", "6000", "3000", "6000", "5000", "10000", "15000", "41000", "35000", "50000", "60000", "70000", "75000", "1000000", "900000", "3000000", "6000000", "8000000", "21000000", "30000000", "80000000", "220000000", "275000000", "300000000");
	var vaisseau_perte_c = new Array("2000", "6000", "1000", "4000", "5000", "6000", "9500", "17000", "20000", "40000", "50000", "45000", "65000", "600000", "700000", "2000000", "3500000", "4000000", "5000000", "10000000", "40000000", "110000000", "130000000", "220000000");
	var vaisseau_perte_d = new Array("0", "0", "0", "0", "500", "2000", "2000", "0", "1500", "10000", "15000", "5000", "10000", "200000", "200000", "200000", "1000000", "500000", "1750000", "2000000", "7000000", "30000000", "60000000", "60000000");
	var attaquant_perte_m = new Array(0, 0, 0, 0, 0);
	var attaquant_perte_c = new Array(0, 0, 0, 0, 0);
	var attaquant_perte_d = new Array(0, 0, 0, 0, 0);
	var perte_m = 0;
	var perte_c = 0;
	var perte_d = 0;
	var nb_attaquant = document.getElementById("nb_attaquant").value;
	var classename;
	var class_input_att = new Array('att1i', 'att2i', 'att3i', 'att4i', 'att5i');
	var class_att = new Array('att1', 'att2', 'att3', 'att4', 'att5');
	var nom_att;
	var nb_remp = document.getElementsByClassName(class_att[0]).length;
	for (var j = 0; j < nb_attaquant; j++) {
		nom_att = document.getElementsByClassName(class_input_att[j])[0].value;
		for (var d = 0; d < nb_remp; d++) {
			document.getElementsByClassName(class_att[j])[d].innerHTML = nom_att;
		}
	}
	for (var j = 0; j < nb_attaquant; j++) {
		for (var k = 0; k < vaisseau.length; k++) {
			classename = vaisseau[k];
			nb_vaisseau_type = supr0(document.getElementsByClassName(classename)[j].value);
			attaquant_perte_m[j] = parseInt(attaquant_perte_m[j]) + parseInt(vaisseau_perte_m[k]) * parseInt(nb_vaisseau_type.replace(/[^0-9-]/g, ""));
			attaquant_perte_c[j] = parseInt(attaquant_perte_c[j]) + parseInt(vaisseau_perte_c[k]) * parseInt(nb_vaisseau_type.replace(/[^0-9-]/g, ""));
			attaquant_perte_d[j] = parseInt(attaquant_perte_d[j]) + parseInt(vaisseau_perte_d[k]) * parseInt(nb_vaisseau_type.replace(/[^0-9-]/g, ""));
		}
		document.getElementsByClassName("perte_m")[j].innerHTML = couleur(attaquant_perte_m[j]);
		document.getElementsByClassName("perte_c")[j].innerHTML = couleur(attaquant_perte_c[j]);
		document.getElementsByClassName("perte_d")[j].innerHTML = couleur(attaquant_perte_d[j]);
	}
}

function calculer_gain_par_attaquant_apres_pillage() {
	var gain_pillage_total_m = 0;
	var gain_pillage_total_c = 0;
	var gain_pillage_total_d = 0;
	var attaquant_pillage_m = new Array(0, 0, 0, 0, 0);
	var attaquant_pillage_c = new Array(0, 0, 0, 0, 0);
	var attaquant_pillage_d = new Array(0, 0, 0, 0, 0);
	var attaquant_perte_m = new Array(0, 0, 0, 0, 0);
	var attaquant_perte_c = new Array(0, 0, 0, 0, 0);
	var attaquant_perte_d = new Array(0, 0, 0, 0, 0);
	var nb_attaquant = document.getElementById("nb_attaquant").value;
	for (var j = 0; j < nb_attaquant; j++) {
		attaquant_pillage_m[j] = parseInt(supr0(document.getElementsByClassName('pillage_m')[j].value.replace(/[^0-9-]/g, "")));
		attaquant_pillage_c[j] = parseInt(supr0(document.getElementsByClassName('pillage_c')[j].value.replace(/[^0-9-]/g, "")));
		attaquant_pillage_d[j] = parseInt(supr0(document.getElementsByClassName('pillage_d')[j].value.replace(/[^0-9-]/g, "")));
		gain_pillage_total_m = gain_pillage_total_m + attaquant_pillage_m[j];
		gain_pillage_total_c = gain_pillage_total_c + attaquant_pillage_c[j];
		gain_pillage_total_d = gain_pillage_total_d + attaquant_pillage_d[j];
		attaquant_perte_m[j] = supr0(document.getElementsByClassName("perte_m")[j].getElementsByTagName('span')[0].innerHTML.replace(/[^0-9-]/g, ""));
		attaquant_perte_c[j] = supr0(document.getElementsByClassName("perte_c")[j].getElementsByTagName('span')[0].innerHTML.replace(/[^0-9-]/g, ""));
		attaquant_perte_d[j] = supr0(document.getElementsByClassName("perte_d")[j].getElementsByTagName('span')[0].innerHTML.replace(/[^0-9-]/g, ""));
		document.getElementsByClassName("perte_a_pil_m")[j].innerHTML = couleur(attaquant_pillage_m[j] - parseInt(attaquant_perte_m[j]));
		document.getElementsByClassName("perte_a_pil_c")[j].innerHTML = couleur(attaquant_pillage_c[j] - parseInt(attaquant_perte_c[j]));
		document.getElementsByClassName("perte_a_pil_d")[j].innerHTML = couleur(attaquant_pillage_d[j] - parseInt(attaquant_perte_d[j]));
	}
	document.getElementsByClassName("b_pillage_m")[0].innerHTML = couleur(gain_pillage_total_m);
	document.getElementsByClassName("b_pillage_c")[0].innerHTML = couleur(gain_pillage_total_c);
	document.getElementsByClassName("b_pillage_d")[0].innerHTML = couleur(gain_pillage_total_d);
}

function calculer_fin() {
// on recupere les recyclages calcul les nouvelle pertes. et fait un bilan de tout (recyclage et des pertes/rentabilite)
	var renta_avant_rc_m = new Array(0, 0, 0, 0, 0);
	var renta_avant_rc_c = new Array(0, 0, 0, 0, 0);
	var renta_avant_rc_d = new Array(0, 0, 0, 0, 0);
	var renta_total_m = 0;
	var renta_total_c = 0;
	var renta_total_d = 0;
	var gain_rc_total_m = 0;
	var gain_rc_total_c = 0;
	var attaquant_cdr_m = new Array(0, 0, 0, 0, 0);
	var attaquant_cdr_c = new Array(0, 0, 0, 0, 0);
	var renta_apres_rc_m = new Array(0, 0, 0, 0, 0);
	var renta_apres_rc_c = new Array(0, 0, 0, 0, 0);
	var renta_apres_rc_d = new Array(0, 0, 0, 0, 0);
	var deut_d = new Array(0, 0, 0, 0, 0);
	var nb_attaquant = document.getElementById("nb_attaquant").value;
	for (var j = 0; j < nb_attaquant; j++) {
		attaquant_cdr_m[j] = parseInt(supr0(document.getElementsByClassName('rc_m')[j].value.replace(/[^0-9-]/g, "")));
		attaquant_cdr_c[j] = parseInt(supr0(document.getElementsByClassName('rc_c')[j].value.replace(/[^0-9-]/g, "")));
		gain_rc_total_m = gain_rc_total_m + attaquant_cdr_m[j];
		gain_rc_total_c = gain_rc_total_c + attaquant_cdr_c[j];
		deut_d[j] = parseInt(document.getElementsByClassName('deut_d')[j].value.replace(/[^0-9-]/g, ""));
		renta_avant_rc_m[j] = parseInt(supr0(document.getElementsByClassName("perte_a_pil_m")[j].getElementsByTagName('span')[0].innerHTML.replace(/\./g, "")));
		renta_avant_rc_c[j] = parseInt(supr0(document.getElementsByClassName("perte_a_pil_c")[j].getElementsByTagName('span')[0].innerHTML.replace(/\./g, "")));
		renta_avant_rc_d[j] = parseInt(supr0(document.getElementsByClassName("perte_a_pil_d")[j].getElementsByTagName('span')[0].innerHTML.replace(/\./g, "")));
		renta_total_m = renta_total_m + parseInt(renta_avant_rc_m[j]) + parseInt(attaquant_cdr_m[j]);
		renta_total_c = parseInt(renta_total_c) + parseInt(renta_avant_rc_c[j]) + parseInt(attaquant_cdr_c[j]);
		renta_total_d = parseInt(renta_total_d) + parseInt(renta_avant_rc_d[j]) - deut_d[j];
		renta_apres_rc_m[j] = parseInt(attaquant_cdr_m[j]) + parseInt(renta_avant_rc_m[j]);
		renta_apres_rc_c[j] = parseInt(attaquant_cdr_c[j]) + parseInt(renta_avant_rc_c[j]);
		renta_apres_rc_d[j] = parseInt(renta_avant_rc_d[j]) - deut_d[j];
		document.getElementsByClassName("renta_a_pil_m")[j].innerHTML = couleur(parseInt(renta_apres_rc_m[j]));
		document.getElementsByClassName("renta_a_pil_c")[j].innerHTML = couleur(parseInt(renta_apres_rc_c[j]));
		document.getElementsByClassName("renta_a_pil_d")[j].innerHTML = couleur(parseInt(renta_apres_rc_d[j]));
	}
	document.getElementsByClassName("b_rc_m")[0].innerHTML = couleur(parseInt(gain_rc_total_m));
	document.getElementsByClassName("b_rc_c")[0].innerHTML = couleur(parseInt(gain_rc_total_c));
	var deut_dep_m = -(deut_d[0] + deut_d[1] + deut_d[2] + deut_d[3] + deut_d[4]);
	document.getElementsByClassName("b_deut_d")[0].innerHTML = couleur(deut_dep_m);
	document.getElementsByClassName("renta_total_m")[0].innerHTML = couleur(parseInt(renta_total_m));
	document.getElementsByClassName("renta_total_c")[0].innerHTML = couleur(parseInt(renta_total_c));
	document.getElementsByClassName("renta_total_d")[0].innerHTML = couleur(parseInt(renta_total_d));
	var renta_moy_m = Math.round(renta_total_m / nb_attaquant);
	var renta_moy_c = Math.round(renta_total_c / nb_attaquant);
	var renta_moy_d = Math.round(renta_total_d / nb_attaquant);
	document.getElementsByClassName("renta_moyenne_m")[0].innerHTML = couleur(renta_moy_m);
	document.getElementsByClassName("renta_moyenne_c")[0].innerHTML = couleur(renta_moy_c);
	document.getElementsByClassName("renta_moyenne_d")[0].innerHTML = couleur(renta_moy_d);
	// on finit .
	for (var j = 0; j < nb_attaquant; j++) {
		document.getElementsByClassName("donne_m")[j].innerHTML = couleur(renta_apres_rc_m[j] - renta_moy_m);
		document.getElementsByClassName("donne_c")[j].innerHTML = couleur(renta_apres_rc_c[j] - renta_moy_c);
		document.getElementsByClassName("donne_d")[j].innerHTML = couleur(renta_apres_rc_d[j] - renta_moy_d);
	}
}

function klikfleets(){$('#show_fleet_content').stop(false,true).slideToggle(300);};
function kliklost(){$('#show_lost_content').stop(false,true).slideToggle(300);};
function kliklostaftersteal(){$('#show_lostaftersteal_content').stop(false,true).slideToggle(300);};
function kliklostaftersteal3(){$('#show_lostaftersteal3_content').stop(false,true).slideToggle(300);};
function klikrecycle(){$('#show_recycle_content').stop(false,true).slideToggle(300);};
function klikdeutused(){$('#show_deutused_content').stop(false,true).slideToggle(300);};
function kliklostaftersteal2(){$('#show_lostaftersteal2_content').stop(false,true).slideToggle(300);};
function klikdiff(){$('#show_diff_content').stop(false,true).slideToggle(300);};