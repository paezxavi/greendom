<template>
  <div> </div>
  <!--
    <div id="modal-template" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <div class="box">
          <article class="media"  v-for="(produit, index) in produits" :key="produit.reference">
            <div class="media-left">
              <figure class="image is-64x64">
                <img :src="produit.image" alt="Image">
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong> {{produit.nom}} </strong> <small class="is-pulled-right"> Réf : {{produit.reference}} </small>
                  <br>
                  {{produit.description}}
                <div class="is-pulled-right">
                  <button class="button is-info" @click="ajoutProduit(produit, produit.reference)"> Seléctionner </button>
                </div>
                </p>
              </div>
            </div>
          </article>
          <button class="modal-close" @click="$emit('close')"></button>
          <button class="button is-danger" @click="$emit('close')"> Fermer </button>
        </div>
      </div>
    </div>
  -->

</template>

<script>
  /*
    import {Store} from './store'

    new Vue({
    
        data() {
            return {
                test: 'test',
                produits: '',
                fournisseurs: ''
            }
        },

        created() {
            //Liste des listeProduits
            axios.get('/produitsOffre')
            .then(({data}) => this.produits = data);
        },

        methods:{
            ajoutProduit(produit, reference) {
                axios.get('/fournisseurList/'+produit.id)
                    .then(response => {this.fournisseurs = response.data; console.log(this.fournisseurs); Store.ajoutPanier(produit, reference, this.fournisseurs)});
            },
        }

  })
  */
</script>
