import Vue from 'vue';

export const Store = new Vue({

	data() {
	    return {
	    	panier: []
	    };
	},

	methods: {
		ajoutPanier(produit, reference) {
      var nom = produit.nom;
      var image = produit.image;
      var description = produit.description;
				this.panier.push({
          image,
          nom,
          reference,
          description,
          quantite: 1
        })
        console.log("normal");
		},

		supprimerPanier(id) {
			return 0;
		},

		viderPanier() {
			this.panier = []
		}
	}
});
