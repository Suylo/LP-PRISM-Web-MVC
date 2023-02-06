// variables javascript liées à l'interface HTML
let enrAdh = document.querySelector('#enregistrerAdherent');
let inpNomAdh = document.querySelector('#nomAdherent');
let inpPreAdh = document.querySelector('#prenomAdherent');

let enrLivre = document.querySelector('#enregistrerLivre');
let inpTitre = document.querySelector('#titreLivre');
let inpAuteur = document.querySelector('#auteurLivre');

let divBoutons = document.querySelector('#boutons');
let boutonRecharger = document.getElementById('recharger');
let boutonSauvegarder = document.getElementById('sauvegarder');

let divlisteAdh = document.getElementById('listeAdherents');
let divlisteLivresDispos = document.getElementById('listeLivresDisponibles');
let divlisteLivresEmpruntes = document.getElementById('listeLivresEmpruntes');

// création de la médiathèque
let M = new Mediatheque();

// méthodes utiles internes
function vide(div) {
    div.innerHTML = "";
}

function videM() {
    // vide les 3 colonnes de l'interface (adhérents, livres dispos et livres empruntés)
    // et réinitialise les tableaux tabLivres et tabAdherents de la médiathèque M
    divlisteLivresEmpruntes.innerHTML = "";
    divlisteLivresDispos.innerHTML = "";
    divlisteAdh.innerHTML = "";
    M.tabLivres = [];
    M.tabAdherents = [];
}

// méthode de chargement des données
function chargerDonneesAJAX() {
    // vide la médiathèque,
    // puis charge par un objet XMLHttpRequest les données de la base : adhérents et livres.
    // une fois les données chargées, on remplit les colonnes de la médiathèque
    // grâce aux méthodes insererLivres, insererAdherents et insererEmprunts
    // enfin, on met à jour la médiathèque
    videM();
    let xhr = new XMLHttpRequest();
    let url = "./php/routeur?objet=mediatheque&action=chargerDonneesMySQL";
    xhr.open("GET", url);
    xhr.send();

    xhr.addEventListener("load", function () {
        let [tabLivres, tabAdherents] = JSON.parse(xhr.responseText);
        tabLivres = tabLivres.map(livre => new Livre(parseInt(livre.numLivre), livre.titre, livre.auteur, parseInt(livre.numEmprunteur), livre.estEmprunte));
        M.insererLivres(tabLivres);
        tabAdherents = tabAdherents.map(adherent => new Adherent(parseInt(adherent.numAdherent), adherent.nom, adherent.prenom));
        M.insererAdherents(tabAdherents);
        M.insererEmprunts(tabLivres);
        MAJ();
    });
}

// méthode de sauvegarde des données
function sauvegardeMySQL() {
    // on initialise deux objets XMLHttpRequest
    // le premier va mettre à jour les adhérents en appelant MAJadherents.php,
    // et en passant en paramètre dans l'url la chaîne correspondant au tableau des adhérents
    // le deuxième va mettre à jour les livres en appelant MAJemprunteurs.php,
    // et en passant en paramètre dans l'url la chaîne correspondant au tableau des livres
    // enfin, on redonne au bouton de sauvegarde son aspect initial
    let xhrAdherent = new XMLHttpRequest();
    let urlAdherent = "./php/routeur.php?objet=adherent&action=MAJadherents&donnees=" + JSON.stringify(M.tabAdherents);
    xhrAdherent.open("GET", urlAdherent);
    xhrAdherent.send();

    let xhrEmprunteur = new XMLHttpRequest();
    let urlEmprunteur = "./php/routeur.php?objet=livre&action=MAJemprunteurs&donnees=" + JSON.stringify(M.tabLivres);
    xhrEmprunteur.open("GET", urlEmprunteur);
    xhrEmprunteur.send();
}


// méthodes d'affichage et mise à jour de l'interface
function afficherAdherents() {
    vide(divlisteAdh);
    M.tabAdherents.forEach(adh => {
        let texte = adh.nom + " " + adh.prenom;
        let ul = document.createElement("ul");
        let li = document.createElement("li");
        li.textContent = texte;
        li.id = "adherent-" + adh.numAdherent;
        if (adh.tabEmprunts.length > 0) {
            li.textContent += " (" + adh.tabEmprunts.length + ")";
        }
        ul.appendChild(li);
        divlisteAdh.appendChild(ul);
    });
}

function afficherLivres() {
    vide(divlisteLivresDispos);
    vide(divlisteLivresEmpruntes);
    M.tabLivres.forEach(function (livre) {
        let texte = livre.titre + " | <strong>" + livre.auteur + "</strong>";
        let ul = document.createElement("ul");
        let li = document.createElement("li");
        li.innerHTML = texte;
        if (livre.estEmprunte === "1" || livre.estEmprunte === 1) {
            li.id = "livre-emprunt-" + livre.numLivre;
            divlisteLivresEmpruntes.appendChild(ul);
        } else {
            li.id = "livre-" + livre.numLivre;
            divlisteLivresDispos.appendChild(ul);
        }
        ul.appendChild(li)
    });
}

// méthodes de gestion des événements liés aux items des listes
function eventsAdherents() {
    M.tabAdherents.forEach(adh => {
        let adherent = document.getElementById("adherent-" + adh.numAdherent);
        adherent.addEventListener('click', (e) => {
            let adherent = M.getAdherentByNumAdherent(adh.numAdherent);
            if (adh.tabEmprunts.length > 0) {
                alert("Adhérent : " + adherent.nom + " " + adherent.prenom + "\n\nListe de livres empruntés : " + adherent.listeEmprunts());
            } else {
                alert("L'adhérent ne possède aucun emprunt");
            }
        })
    })
}

function eventsLivresDispos() {
    let tabLivresDispos = [];
    M.tabLivres.forEach(function (livre) {
        if (livre.estEmprunte === "0" || livre.estEmprunte === 0) {
            tabLivresDispos.push(livre);
        }
    });
    tabLivresDispos.forEach(function (livre) {
        let livreDispo = document.getElementById("livre-" + livre.numLivre);
        livreDispo.addEventListener("click", function () {
            let numAdherent = prompt("À quel adhérent prêter le livre " + livre.titre + " ?");
            let unAdh = M.getAdherentByNumAdherent(parseInt(numAdherent));
            if (unAdh) {
                M.prete(livre, unAdh);
                saveBtn();
                MAJ();
            } else {
                alert("l'adhérent n'existe pas !");
            }
        });
    });
}

function eventsLivresEmpruntes() {
    let tabLivresEmpruntes = [];
    M.tabLivres.forEach(function (livre) {
        if (livre.estEmprunte === "1" || livre.estEmprunte === 1) {
            tabLivresEmpruntes.push(livre);
        }

    });
    tabLivresEmpruntes.forEach(function (livre) {
        let livreEmprunte = document.getElementById("livre-emprunt-" + livre.numLivre);
        livreEmprunte.addEventListener("click", function () {
            let retour = confirm("Confirmez-vous le retour du livre " + livre.titre + " ?");
            if (retour) {
                M.recupere(livre);
                MAJ();
                saveBtn();
            } else {
                alert("Il faut que les champs soit bien complété !");
            }
        });
    });
}

function MAJ() {
    afficherLivres();
    afficherAdherents();
    eventsAdherents();
    eventsLivresDispos();
    eventsLivresEmpruntes();
}

MAJ();
// écouteurs d'événements permanents
window.addEventListener("load", chargerDonneesAJAX);

boutonSauvegarder.addEventListener('click', function () {
    saveBtn(true);
    sauvegardeMySQL();
});

boutonRecharger.addEventListener('click', function () {
    let confirmReload = confirm("Êtes-vous sûr de vouloir recharger la page ? Cela affectera tous vos changements non sauvegardés!!")
    if (confirmReload) {
        location.reload();
    }
});

enrLivre.addEventListener('click', function () {
    let inputTitre = document.getElementById("titreLivre");
    let inputAuteur = document.getElementById("auteurLivre");
    if (inputAuteur.value && inputTitre.value) {
        let count = M.tabLivres.length;
        let newLivre = new Livre(count + 1, inputTitre.value, inputAuteur.value, 0, 0);
        M.ajouteLivre(newLivre);
        MAJ();
        saveBtn();
        inputTitre.value = "";
        inputAuteur.value = "";
    } else {
        alert("Veuillez remplir les champs avant de continuer !");
    }
});

enrAdh.addEventListener('click', function () {
    let inputNom = document.getElementById("nomAdherent");
    let inputPrenom = document.getElementById("prenomAdherent");
    if (inputNom.value && inputPrenom.value) {
        let count = M.tabAdherents.length;
        let newAdherent = new Adherent(count + 1, inputNom.value, inputPrenom.value);
        M.ajouteAdherent(newAdherent);
        MAJ();
        saveBtn();
        inputNom.value = "";
        inputPrenom.value = "";
    } else {
        alert("Veuillez remplir les champs avant de continuer !");
    }
});


function saveBtn(remove = false) {
    if (!remove) {
        boutonSauvegarder.style.background = "white";
        boutonSauvegarder.style.color = "green";
        boutonSauvegarder.style.border = "1px solid green";
        boutonSauvegarder.style.boxShadow = "2px 2px 0px rgba(0,0,0,0.2)";
    } else {
        boutonSauvegarder.style.background = "grey";
        boutonSauvegarder.style.color = "black";
    }
}