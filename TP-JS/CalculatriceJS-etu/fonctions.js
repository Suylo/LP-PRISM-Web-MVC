
function effacer(){
    document.getElementById("ecran").value = "";
}

function MAJecran(c) {
    document.getElementById("ecran").value += c;
}

function calculer() {
    document.getElementById("ecran").value = eval(document.getElementById("ecran").value);
}

function correction() {
	let ecranval = document.getElementById("ecran").value;
    document.getElementById("ecran").value = ecranval.slice(0, ecranval.length - 1);
}


