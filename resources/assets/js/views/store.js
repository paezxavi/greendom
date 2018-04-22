import Vue from 'vue';

export const Store = new Vue({

	data() {
	    return {
	    	panier: [],
				panierEnregistres: []
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

		ajoutPanierProduitEnregistrer(produits_recuperes) {
			console.log(produits_recuperes);
			for (var i = 0; i < produits_recuperes.length; i++) {
				var image = produits_recuperes[i].image;
				var nom = produits_recuperes[i].nom;
				var description = produits_recuperes[i].pivot.description;

				var prix = produits_recuperes[i].pivot.prix;
				var quantite = produits_recuperes[i].pivot.quantity;

				var remiseBoolean = produits_recuperes[i].pivot.remiseBoolean;
				var remisePrix = produits_recuperes[i].pivot.remisePrix;
				var remisePourcent = produits_recuperes[i].pivot.remisePourcent;
				var total = produits_recuperes[i].pivot.total;
				//var fournisseur = fournisseurs[0];

				console.log("quantite"+quantite);
				console.log("prix"+prix);

				this.panierEnregistres.push({
					image,
					nom,
					//reference,
					description,
					prix,
					quantite,
					remiseBoolean,
					remisePrix,
					remisePourcent,
					total
					//fournisseur,
					//fournisseurs
						//fournisseurs []
	    	})
			}
		},

		supprimerPanier(id) {
			return 0;
		},

		viderPanier() {
			this.panier = []
		}
	}
});
