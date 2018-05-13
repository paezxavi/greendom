import Vue from 'vue';

export const Store = new Vue({

	data() {
	    return {
	    	panier: [],
			panierEnregistres: [],
			liste: []
	    };
	},

	methods: {
		
		listeProduits(produits) {
			this.liste.length = 0;
			this.liste = produits;
			
			for (var g =0; g < this.panierEnregistres.length; g++) {
				var id = this.panierEnregistres[g].id;
				//console.log("id "+id);
				for (var j=0; j < this.liste.length; j++) {
					//console.log("J - id " + this.liste[j].id);
					if (id == this.liste[j].id) {
						//console.log("Suppr");
						this.liste.splice(j, 1);
					}
				}
			}
			
		},
		
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
			var quantite = 1;
			//console.log(fournisseurs);

			var existe = false;

            for (var i=0; i < this.panier.length; i++) {
                if (id == this.panier[i].id) {
                    this.panier[i].quantite = this.panier[i].quantite+1;
                    existe = true;
                }
            }

			if (existe == false) {
				this.panier.push ({
					image,
					id,
					nom,
					reference,
					description,
					quantite,
					prix,
					remiseBoolean,
					remisePrix,
					remisePourcent,
					total,
					fournisseurChoisi,
					fournisseurs
				})
			}

			//Supprimer de la liste des produit à choisir
			for (var j=0; j < this.liste.length; j++) {
				if (id == this.liste[j].id) {
					this.liste.splice(j, 1);
				}
			}
			
		},

		ajoutPanierProduitEnregistrer(produits_recuperes) {
			//console.log(produits_recuperes);
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
				if(this.panierEnregistres.length == 0){
					//console.log("panier vide");
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
				} else {
					//console.log("pas vide");
					var count = 0;
					for(var k = 0; k < this.panierEnregistres.length; k++){
						//console.log(this.panierEnregistres[k]);
						if(this.panierEnregistres[k].id != id){
							count = count + 1;
						}
					}
					if(count == this.panierEnregistres.length){
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
				}
			}
		},

		viderPanier() {
			this.panier.length = 0;
		},

		//Ajoute au début le produit choisis
		ajoutProduitSupprime(produit) {
			var id = produit.id;
			var image = produit.image;
			var nom = produit.nom;
			var description = produit.description;
			var reference = produit.reference;
			var prix = 0;
			var remiseBoolean = false;
			var remisePrix = 0;
			var remisePourcent = 0;
			var total = prix - remisePrix;
			var fournisseurs = produit.fournisseurs;
			var fournisseurChoisi = fournisseurs[0].nom;
			var quantite = 1;

			/*
			for (var i=0; i < this.liste.length; i++) {
				if (this.liste[i].id == id) {
					i++;
		    */
					this.liste.unshift ({
						image,
						id,
						nom,
						reference,
						description,
						quantite,
						prix,
						remiseBoolean,
						remisePrix,
						remisePourcent,
						total,
						fournisseurChoisi,
						fournisseurs				
					})
					//break;
				//}
			//}
			
		},

		ajoutProduitEnregistreSupprime(produit) {
			console.log("produit enregistré");
			console.log(produit);
			var id = produit.id;
			var image = produit.image;
			var nom = produit.nom;
			var description = produit.description;
			var reference = produit.reference;
			var prix = 0;
			var remiseBoolean = false;
			var remisePrix = 0;
			var remisePourcent = 0;
			var total = prix - remisePrix;
			var fournisseurChoisi = produit.fournisseurChoisi;
			var quantite = 1;

			/*
			for (var i=0; i < this.liste.length; i++) {
				if (this.liste[i].id == id) {
					i++;
		    */
					this.liste.unshift ({
						image,
						id,
						nom,
						reference,
						description,
						quantite,
						prix,
						remiseBoolean,
						remisePrix,
						remisePourcent,
						total,
						fournisseurChoisi			
					})
					//break;
				//}
			//}
		}
	}
});
