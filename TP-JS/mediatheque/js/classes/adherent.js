class Adherent {

	constructor(numAdherent, nom, prenom) {
		this.numAdherent = numAdherent;
		this.nom = nom;
		this.prenom = prenom;
		this.tabEmprunts = [];
	}

	toString() {
		return `Adhérent[numAdherent = ${this.numAdherent}, nom = ${this.nom}, prénom = ${this.prenom}]`;
	}

	emprunte(livre) {
		this.tabEmprunts.push(livre);
	}

	retourne(livre) {
		let index = this.tabEmprunts.indexOf(livre);
		if (index !== -1) {
			this.tabEmprunts.splice(index, 1);
		}
	}

	listeEmprunts() {
		let liste = "";
		this.tabEmprunts.forEach(emprunt => {
			liste += "\n" + emprunt.numLivre + " - " + emprunt.titre + " | " + emprunt.auteur;
		})
		return liste;
	}

}
