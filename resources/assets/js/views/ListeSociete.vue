<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="companies"
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
    <a @click="createCompany" class="button is-primary">Nouvelle société</a>
  </div>
</template>

<script>
  export default {
      data() {
          return {
            columns: [
              {
                label: 'Nom',
                field: 'name',
              },
              {
                label: 'Adresse',
                field: 'address',
              },
              {
                label: 'Email',
                field: 'email',
              },
            ],
            companies: [],
          }
      },
      /**
       * Vérifie qu'il y a un user logué et qu'il est un employé :
       * Si c'est ok :
       *    Efface dans sessionStorage titleComp + idComp
       *    Charge la liste des sociétés dans companies[]
       *  Sinon redirige sur la page login
       */
      created() {
          let self = this;
          this.checkIfLogged()
          .then(response => {
              this.user = response ? response : window.location = '/#/login';
              if(this.user.employee == false){self.$router.push('login');}
          })
          .catch(error => console.log(error));
          sessionStorage.removeItem('titleComp');
          sessionStorage.removeItem('idComp');
          axios.get('/companiesList/')
            .then(response=>{self.companies = response.data;})
            .catch(function (error) {console.log(error);});
      },
      methods: {
        /**
         * Enregistre dans le sessionStorage le titre de la page InfoCompagnie
         * Redirige sur la page InfoCompagnie
         */
         createCompany(){
           const self = this;
           sessionStorage.setItem('titleComp','Nouvelle société');
           self.$router.push('companyInfo');

         },

         /**
          * Récupère l'id de l'objet cliqué qui correspond à l'id de la société concernée
          * Enregistre dans le sessionStorage l'id de la société
          * Enregistre dans le sessionStorage le titre de la page InfoCompagnie
          * Redirige sur la page InfoFournisseur
          */
         onRowClick(params){
           const self = this;
           var targetId = params.row.id;
           sessionStorage.setItem('idComp',targetId);
           sessionStorage.setItem('titleComp','Modification société');
           self.$router.push('companyInfo');
         }
      }
    }
</script>
