<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="providers"
      :search-options="{
        enabled: true,
      }"
      :sort-options="{
        enabled: true,
        initialSortBy: {field: 'name', type: 'asc'}
      }"
      :pagination-options="{
        enabled: true,
        perPage: 25,
      }"
      @on-row-click="onRowClick"
      styleClass="vgt-table striped bordered"/>
    <br/>
    <a @click="createProvider" class="button is-primary">Nouveau fournisseur</a>
  </div>
</template>

<script>
  export default {
      data() {
          return {
            columns: [
              {
                label: 'Nom',
                field: 'nom',
              },
              {
                label: 'Adresse',
                field: 'adresse',
              },
              {
                label: 'Email',
                field: 'email',
              },
              {
                label: 'Téléphone',
                field: 'phone',
              },
              {
                label: 'Compte skype',
                field: 'skype',
              },
            ],
            providers: [],
          }
      },
      /**
       * Vérifie qu'il y a un user logué et qu'il est un employé :
       * Si c'est ok :
       *    Efface dans sessionStorage titleProv + idProv
       *    Charge la liste des fournisseurs dans providers[]
       *  Sinon redirige sur la page home
       */
      created() {
          let self = this;
          this.checkIfLogged()
          .then(response => {
              this.user = response ? response : window.location = '/#/home';
              if(this.user.employee == false){self.$router.push('home');}
          })
          .catch(error => console.log(error));
          sessionStorage.removeItem('titleProv');
          sessionStorage.removeItem('idProv');
          axios.get('/providersList/')
            .then(response=>{self.providers = response.data;})
            .catch(function (error) {console.log(error);});
      },
      methods: {
         /**
          * Enregistre dans le sessionStorage le titre de la page InfoFournisseur
          * Redirige sur la page InfoFournisseur
          */
         createProvider(){
           const self = this;
           sessionStorage.setItem('titleProv','Nouveau fournisseur');
           self.$router.push('providerInfo');

         },

         /**
          * Récupère l'id de l'objet cliqué qui correspond à l'id du fournisseur concerné
          * Enregistre dans le sessionStorage l'id du fournisseur
          * Redirige sur la page InfoFournisseur
          */
         onRowClick(params){
           const self = this;
           var targetId = params.row.id;
           sessionStorage.setItem('idProv',targetId);
           sessionStorage.setItem('titleProv','Modification fournisseur');
           self.$router.push('providerInfo');
         }
      }
    }
</script>
