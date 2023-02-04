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
    // vide de toutes ses balises la div
    // passée en paramètre
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
    xhr.addEventListener("load", function() {
        let data = JSON.parse(xhr.responseText);
        let livres = data[0];
        let adherents = data[1];

        M.insererAdherents(adherents);
        M.insererLivres(livres);
        MAJ();
    });
    xhr.send();
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
    let urlAdherent = "./php/routeur.php?objet=adherent&action="

}


// méthodes d'affichage et mise à jour de l'interface
function afficherAdherents() {
    // on commence par vider la div des adhérents
    // ensuite, on la reconstruit élément par élément
    // en insérant entre parenthèses le nombre d'emprunts
    // si l'adhérent a des emprunts)
    vide(divlisteAdh);
    M.tabAdherents.forEach(function(adh) {
        let texte = adh.nom + " " + adh.prenom;
        let ul = document.createElement("ul");
        let li = document.createElement("li");
        li.innerHTML = texte;
        ul.appendChild(li);

        divlisteAdh.appendChild(ul);
    });
}

function afficherLivres() {
    // on commence par vider les div des livres dispos et des livres empruntés
    // ensuite, on les reconstruit élément par élément
    // en insérant le livre dans l'une ou dans l'autre selon qu'il est emprunté ou non
    vide(divlisteLivresDispos);
    vide(divlisteLivresEmpruntes);
    M.tabLivres.forEach(function(livre) {
        let texte = livre.titre + " | <strong>" + livre.auteur + "</strong>";
        let ul = document.createElement("ul");
        let li = document.createElement("li");
        li.innerHTML = texte;
        li.id = livre.numLivre;
        ul.appendChild(li)
        if (livre.estEmprunte === "1") {
            divlisteLivresEmpruntes.appendChild(ul);
        } else {
            divlisteLivresDispos.appendChild(ul);
        }
    });
}

// méthodes de gestion des événements liés aux items des listes
function eventsAdherents() {
    // pour chaque adhérent de la div, on ajoute un écouteur d'événement click
    // qui permet d'afficher la liste d'emprunts de l'adhérent (méthode listeEmprunts())
}

function eventsLivresDispos() {
    // pour chaque livre dispo, on ajoute un écouteur d'événement click
    // qui demande à quel adhérent on prête le livre.
    // ensuite, on prête le livre à l'adhérent,
    // et on change le style du bouton de sauvegarde pour prévenir
    // l'utilisateur que des changements sont intervenus.
    // Idéalement, prévoir de tester le numAdhérent entré pour qu'il soit valide.

    let tabLivresDispos = [];
    M.tabLivres.forEach(function(livre) {
        if (livre.estEmprunte === "0") {
            tabLivresDispos.push(livre);
        }
    });
    tabLivresDispos.forEach(function(livre) {
        let livreDispo = document.getElementById(livre.numLivre);
        livreDispo.addEventListener("click", function() {
            let numAdherent = prompt("À quel adhérent prêter le livre " + livre.titre + " ?");
            let unAdh = M.getAdherentByNumAdherent(numAdherent);
            M.prete(livre, unAdh);
        });
    });
}

function eventsLivresEmpruntes() {
    // pour chaque livre emprunté, on ajoute un écouteur d'événement click
    // qui demande confirmation du retour du livre.
    // ce retour implique que la médiathèque récupère le livre,
    // et qu'on met à jour la médiathèque.
    // Ne pas oublier le changement de style du bouton de sauvegarde.
    let tabLivresEmpruntes = [];
    M.tabLivres.forEach(function(livre) {
        if (livre.estEmprunte === "1") {
            tabLivresEmpruntes.push(livre);
        }

    });
    tabLivresEmpruntes.forEach(function(livre) {
        let livreEmprunte = document.getElementById(livre.numLivre);
        livreEmprunte.addEventListener("click", function() {
            let retour = confirm("Confirmez-vous le retour du livre " + livre.titre + " ?");
            if (retour) {
                M.retour(livre);
            }
        });
    });
}

function MAJ() {
    // on affiche les adhérents, on affiche les livres,
    // et on lance les fonctions de gestion des divers événements click
    afficherAdherents();
    afficherLivres();
    eventsAdherents();
    eventsLivresDispos();
    eventsLivresEmpruntes();
}

MAJ();
// écouteurs d'événements permanents
window.addEventListener("load", chargerDonneesAJAX);

boutonSauvegarder.addEventListener('click', function () {
    // après confirmation, on redonne son style initial au bouton de sauvegarde,
    // puis on lance la sauvegarde
});

boutonRecharger.addEventListener('click', function () {
    // après confirmation, on recharge la page par location.reload()
});

enrLivre.addEventListener('click', function () {
    // si les deux imput sont bien remplis,
    // alors on ajoute le livre à la médiathèque.
    // conseil : au moment de créer le nouveau livre (qui sera bien entendu pas encore emprunté),
    // s'arranger pour que son numLivre dépasse d'une unité le max des numLivre existants.
    // ensuite, on adapte le style du bouton de sauvegarde, on efface le contenu des
    // deux input de saisie et on met à jour la médiathèque
});

enrAdh.addEventListener('click', function () {
    // si les deux imput sont bien remplis,
    // alors on ajoute l'adhérent à la médiathèque.
    // conseil : au moment de créer le nouvel adhérent,
    // s'arranger pour que son numAdherent dépasse d'une unité le max des numAdherent existants.
    // ensuite, on adapte le style du bouton de sauvegarde, on efface le contenu des
    // deux input de saisie et on met à jour la médiathèque
});
