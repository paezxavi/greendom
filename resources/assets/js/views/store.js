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
			//this.liste.length = 0;
			this.liste = produits;
			
			//Supprimer produits enregistrées de la liste
			for (var g =0; g < this.panierEnregistres.length; g++) {
				var id = this.panierEnregistres[g].id;
				for (var j=0; j < this.liste.length; j++) {
					if (id == this.liste[j].id) {
						this.liste.splice(j, 1);
					}
				}
			}

			//Supprimer produits enregistrées de la liste
			for (var i =0; i < this.panier.length; i++) {
				var id = this.panier[i].id;
				for (var k=0; k < this.liste.length; k++) {
					if (id == this.liste[k].id) {
						this.liste.splice(k, 1);
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

		//Ajoute au début le produit choisis qui a été supprimé
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
		},

		//Ajoute au début de la liste le produit enregistré qui a été supprimé
		ajoutProduitEnregistreSupprime(produit) {
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
		},

		total() {
			var total = 0;
			for (var i=0; i < this.panierEnregistres.length; i ++) {
				if (this.panierEnregistres[i].remiseBoolean==true) {
					total += ((this.panierEnregistres[i].prix*this.panierEnregistres[i].quantite)*this.panierEnregistres[i].remisePourcent)/100;
				} else {
					total += this.panierEnregistres[i].prix*this.panierEnregistres[i].quantite;
				}
			}
			for (var i=0; i < this.panier.length; i ++) {
				if (this.panier[i].remiseBoolean==true) {
					total += ((this.panier[i].prix*this.panier[i].quantite)*this.panier[i].remisePourcent)/100;
				} else {
					total += this.panier[i].prix*this.panier[i].quantite;
				}
			}
			return total;
		}

	}
});
