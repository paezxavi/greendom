import Vue from 'vue';

export const StoreCatalogue = new Vue({
 

 data() {
     return {
            panierCatalogue: [],
            total: '',
            produitCourant: [],
            produitChoisi: ''
     };
 },

 methods: {
  ajoutPanierCatalogue(produit) {
   var id = produit.id;
   var image = produit.image;
   var nom = produit.nom;
   var description = produit.description;
   var prix = produit.prixVente;
    var total = prix;
    var remiseBoolean = false;
    var remisePrix = 0;
    var remisePourcent = 0;
    var reference = produit.reference;
    var quantite = 1;

    var existe = false;

    for (var i=0; i < this.panierCatalogue.length; i++) {
        if (id == this.panierCatalogue[i].id) {
            this.panierCatalogue[i].quantite = this.panierCatalogue[i].quantite+1;
            existe = true;
        }
    }

    if (existe == false) {
        this.panierCatalogue.push({
            id,
            image,
            nom,
            description,
            prix,
            remiseBoolean,
            remisePrix,
            remisePourcent,
            total,
            reference,
            quantite, 
        })
    }
    
  },

  totalPanier() {
    var total = 0;
    for (var i=0; i < this.panierCatalogue.length; i ++) {
        total += this.panierCatalogue[i].prix*this.panierCatalogue[i].quantite;
    }
    return total;
  },
        
    totalQuantite() {
        return this.panierCatalogue.length;
    },

    viderPanier() {
        this.panierCatalogue.length = 0;
        //window.location = '/#/panier';
    },
        
    produitAffiche(produit) {
        this.produitCourant.length= 0;
        this.produitCourant.push(produit);       
    }
 }
});