<template>
  <div>
    <div v-for="provider in providers">
      <h4> {{ provider.name }} </h4>
      <p>{{ provider.address }}</p>
      <p>{{ provider.email }}</p>
      <button :id="provider.id" class="btn btn-success" @click="modifyProvider()">Modifier</button>
      <button :id="provider.id" class="btn btn-success" @click="deleteProvider($event)">Supprimer</button>
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
          axios.get('/providersList/')
            .then(response=>{self.providers = response.data;})
            .catch(function (error) {console.log(error);});
      },
      methods: {
        /**
         * Récupère l'id du bouton "supprimer" qui a été cliqué qui correspond à l'id du fournisseur concerné
         * Envoie une requête pour supprimer le fournisseur de la BDD Provider qui a l'id passé en paramètre de la requête
         */
        /** deleteProvider: function(event) {
           var targetId = event.currentTarget.id;
           console.log(targetId);
           axios.delete('/deleteProvider/'+ targetId.value)
           .then(response=>{console.log(response.data);})
           .catch(function (error) {console.log(error);});
         },*/
         /**
          * Récupère l'id du bouton "modifier" qui a été cliqué qui correspond à l'id du fournisseur concerné
          * Redirige sur la page InfoFournisseur => doit passer l'id du fournisseur
          */
         modifyProvider(){
           const self = this;
           self.$router.push('ProviderInfo');
         }
      }
    }
</script>
