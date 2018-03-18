import Vue from 'vue';

export const Store = new Vue({

	data() {
	    return {
	    	panier: []
	    };
	},

	methods: {
		ajoutPanier(produit, reference, fournisseurs) {
			var image = produit.image;
			var nom = produit.nom;
			var description = produit.description;
			var prix = 0;
			var remiseBoolean = false;
			var remisePrix = 0;
			var remisePourcent = 0;
			var total = prix - remisePrix;
			var fournisseur = fournisseurs[0];

			this.panier.push({
				image,
				nom,
				reference,
				description,
				quantite: 1,
				prix,
				remiseBoolean,
				remisePrix,
				remisePourcent,
				total,
				fournisseur,
				fournisseurs
					//fournisseurs []
        	})
		},

		supprimerPanier(id) {
			return 0;
		},

		viderPanier() {
			this.panier = []
		}
	}
});
