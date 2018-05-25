<template>
  <div class="column">
    <button class="button is-block is-info is-large" v-on:click="createProvider()">Nouveau fournisseur</button>
  <div>
    <div v-for="provider in providers">
      <h4> {{ provider.name }} </h4>
      <p>{{ provider.address }}</p>
      <p>{{ provider.email }}</p>
      <button :id="provider.id" class="btn btn-success" @click="modifyProvider($event)">Modifier</button>
    </div>
  </div>
    </div>
</template>

<script>
  export default {
      data() {
          return {
              providers: [],
          }
      },
      created() {
          let self = this;
          sessionStorage.removeItem('title');
          axios.get('/providersList/')
            .then(response=>{self.providers = response.data;})
            .catch(function (error) {console.log(error);});
      },
      methods: {
        /**
         * Récupère l'id du bouton "supprimer" qui a été cliqué qui correspond à l'id du fournisseur concerné
         * Envoie une requête pour supprimer le fournisseur de la BDD Provider qui a l'id passé en paramètre de la requête
         */
         /**deleteProvider: function(event) {
           var targetId = event.currentTarget.id;
           console.log(targetId);
           axios.delete('/deleteProvider/'+ targetId.value)
           .then(response=>{console.log(response.data);})
           .catch(function (error) {console.log(error);});
         },*/

         /**
          *
          */
         createProvider(){
           const self = this;
           sessionStorage.setItem('title','Nouveau fournisseur');
           self.$router.push('ProviderInfo');

         },

         /**
          * Récupère l'id du bouton "modifier" qui a été cliqué qui correspond à l'id du fournisseur concerné
          * Enregistre dans le sessionStorage l'id du fournisseur
          * Redirige sur la page InfoFournisseur
          */
         modifyProvider(event){
           const self = this;
           var targetId = event.currentTarget.id;
           sessionStorage.setItem('idProv',targetId);
           sessionStorage.setItem('title','Modification fournisseur');
           self.$router.push('ProviderInfo');
         }
      }
    }
</script>
