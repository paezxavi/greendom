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
			var id = produit.id;
			var image = produit.image;
			var nom = produit.nom;
			var description = produit.description;
			var prix = 0;
			var remiseBoolean = false;
			var remisePrix = 0;
			var remisePourcent = 0;
			var total = prix - remisePrix;
			var fournisseurChoisi = fournisseurs[0].nom;
			console.log(fournisseurs);

			this.panier.push({
				image,
				id,
				nom,
				reference,
				description,
				quantite: 1,
				prix,
				remiseBoolean,
				remisePrix,
				remisePourcent,
				total,
				fournisseurChoisi,
				fournisseurs
					
      		})
		},

		ajoutPanierProduitEnregistrer(produits_recuperes) {
			console.log(produits_recuperes);
			for (var i = 0; i < produits_recuperes.length; i++) {
				var image = produits_recuperes[i].image;
				var reference = produits_recuperes[i].reference;
				var id = produits_recuperes[i].id;
				var nom = produits_recuperes[i].nom;
				var description = produits_recuperes[i].pivot.description;

				var prix = produits_recuperes[i].pivot.prix;
				var quantite = produits_recuperes[i].pivot.quantity;

				var remiseBoolean = produits_recuperes[i].pivot.remiseBoolean;
				var remisePrix = produits_recuperes[i].pivot.remisePrix;
				var remisePourcent = produits_recuperes[i].pivot.remisePourcent;
				var total = produits_recuperes[i].pivot.total;
				var fournisseurChoisi = produits_recuperes[i].pivot.fournisseur;

				this.panierEnregistres.push({
					image,
					id,
					nom,
					reference,
					description,
					prix,
					quantite,
					remiseBoolean,
					remisePrix,
					remisePourcent,
					total,
					fournisseurChoisi
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
