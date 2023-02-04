class Mediatheque {

	constructor() {
		this.tabLivres = [];
		this.tabAdherents = [];
	}

	getLivreByNumLivre(numL) {
		return this.tabLivres.find(livre => livre.numLivre === numL) || null;
	}

	getAdherentByNumAdherent(numAdh) {
		return this.tabAdherents.find(adherent => adherent.numAdherent === numAdh) || null;
	}

	ajouteLivre(livre) {
		this.tabLivres.push(livre);
	}

	ajouteAdherent(adherent) {
		this.tabAdherents.push(adherent);
	}

	prete(livre, adherent) {
		livre.estEmprunte = 1;
		livre.numEmprunteur = adherent.numAdherent;
		adherent.emprunte(livre);
	}

	recupere(livre) {
		const adherent = this.getAdherentByNumAdherent(livre.numEmprunteur);
		if (adherent) {
			adherent.retourne(livre);
			livre.numEmprunteur = null;
			livre.estEmprunte = 0;
		}
	}

	insererLivres(tabL) {
		tabL.forEach(livre => this.ajouteLivre(livre));
	}

	insererAdherents(tabA) {
		tabA.forEach(adh => {
			this.ajouteAdherent(adh);
		});
	}

	insererEmprunts(tabL) {
		tabL.forEach(livre => {
			if (livre.numEmprunteur) {
				const adherent = this.getAdherentByNumAdherent(livre.numEmprunteur);
				this.prete(livre, adherent);
			}
		})
	}

}
