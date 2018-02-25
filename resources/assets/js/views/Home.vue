<template>
  <div class="container">

    <router-link to="/devis">
      <button class="btn btn-success">
          Devis
      </button>
    </router-link>

    <div class="col-md-2 column produitBox"  v-for="produit in produits" :key="produit.id">
        <img :src="produit.image">
        <div class="produitTitre">
            <h4> {{ produit.nom }} </h4>
            <p> {{produit.categorie}} </p>
        </div>
        <div class="produitPrix">
            CHF {{produit.prixVente}}.-
        </div>
            <button
                class="btn btn-success"
                @click="ajoutPanier(produit)">
                Ajouter au panier
            </button>
      </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                products: []
            }
        },

        created() {
            axios.get('/products')
                .then(({data}) => this.products = data);

        }
    }
</script>
