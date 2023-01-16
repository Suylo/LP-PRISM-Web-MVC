function estBissextile(annee) {
	return (annee % 400 == 0) || ((annee % 4 == 0) && (annee % 100 != 0));
}

function nbJours(annee,mois) {
	let n = 31;
	if ((mois == 4) || (mois == 6) || (mois == 9) || (mois == 11)) {
		n = 30;
	} else if (mois == 2) {
		if (estBissextile(annee)) {
			n = 29;
		} else {
			n = 28;
		}
	}
	return n;
}

function mettreajourcalendrier() {
	let annee = document.getElementById('selectA').value;
	let mois = document.getElementById('selectM').value;
	creerCalendrier(annee,mois);
}

function avancer(i) {

}

function reculer(i) {

}

function creerSelectA() {

}

function creerSelectM() {

}

function toutCreer() {

}

function LMMJVSD(annee,mois,jour) {

}

function creerCalendrier(annee,mois) {

}

function actualiser_heure() {
	
}
