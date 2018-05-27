<template>
      <div class="container">
        <div class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <div class="has-text-centered">
              <h3 class="title has-text-grey">Modification produit</h3>
              <br/>
            </div>
            <div class="box">
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Nom</label>
                    <div class="control">
                      <input type="text" name="name" id="name" class="input" value="" v-model="product.nom">
                    </div>
                  </div>
                  <div class="column">
                    <label class="label">Catégorie</label>
                    <div class="control">
                      <input type="text" name="categorie" id="categorie" class="input"  value="" v-model="product.categorie">
                    </div>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Description</label>
                <div class="control">
                  <input type="text" name="desc" id="desc" class="input"  value="" v-model="product.description">
                </div>
              </div>
              <div class="field">
                  <label class="label">Référence GreenDom</label>
                  <input type="text" name="refGreen" id="refGreen" class="input"  value="" v-model="product.reference">
              </div>
              <div class="field">
                <label class="label">Référence fournisseur</label>
                <input type="text" name="refFou" id="refFou" class="input"  value="" v-model="product.refSupplier">
            </div>
                <div class="field">
                  <div class="columns is-mobile">
                    <div class="column">
                  <label class="label">Prix d'achat</label>
                  <div class="control">
                    <input type="number" name="pAchat" id="pAchat" class="input"  value="" v-model="product.prixAchat">
                  </div>
                  </div>
                  <div class="column">
                    <label class="label">Prix de vente</label>
                    <div class="control">
                      <input type="number" name="pvente" id="pvente" class="input"  value="" v-model="product.prixVente">
                    </div>
                  </div>
                 </div>
                </div>
                <div class="columns is-mobile">
                  <div class="column">
                    <button class="button is-block is-success is-large is-fullwidth" v-on:click="updateProduct()">Valider</button>
                  </div>
                  <div class="column">
                    <button class="button is-block is-danger is-large is-fullwidth" v-on:click="cancel()">Annuler</button>
                  </div>
              </div>
            </div>
            <div id="product" v-model="product"></div>
          </div>
        </div>
        </div>
      </div>
</template>

<script>

    export default {

        data() {
            return {
                product: {
                  id:"",
                  nom: "",
                  categorie: "",
                  description: "",
                  reference: "",
                  refSupplier: "",
                  prixAchat: "",
                  prixVente: "",
                }
            }
        },
        /**
         * Fait une requête pour avoir les informations du fournisseur qui a pour id l'id passé en paramètre dans sessionStorage.getItem('idProd')
         * Charge la page avec les informations récupérées
         * Efface la variable 'idPov' de sessionStorage
         */
        created() {
            let self = this;
              self.product.id = sessionStorage.getItem('idProd');
              sessionStorage.removeItem('idProd');
              axios.get('/product/', {params: {id: self.product.id}} )
                .then(response=>{self.product = response.data;})
                .catch(function (error) {console.log(error);});
        },

        methods: {
          /**
           * Lance la mise à jour du produit dans la BDD avec les infos des champs
           * Affiche un message différent si la requête s'est déroulée correctement ou non
           * Si la requête s'est déroulée correctement, redirige sur page ListeProduit
           */
            updateProduct(){
              const self = this;
                axios.put('/product/', {id: self.product.id,name: self.product.nom.trim(),categorie: self.product.categorie.trim(),
                                         reference: self.product.reference.trim(),refSupplier: self.product.refSupplier.trim(),prixAchat: self.product.prixAchat,
                                         prixVente: self.product.prixVente})
                  .then(response=>{
                    if (response.status == 200){
                    alert("Le produit a bien été modifié !");
                    self.$router.push('listProducts');
                  }else{alert("Le système n\' a pas réussi à enregistrer les modifications.");}
                  })
                  .catch(function (error) {
                    console.log(error);
                    {alert("Le système n\' a pas réussi à enregistrer les modifications.");}
                  })
            },

            /**
             * Redirige sur la page Liste produits
             */
            cancel(){
              const self = this;
              self.$router.push('listProducts');
            }
        }
      }
</script>
