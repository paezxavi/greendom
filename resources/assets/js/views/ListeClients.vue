<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="customers"
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
    <a @click="createCustomer" class="button is-primary">Nouveau client</a>
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
                label: 'Prénom',
                field: 'forename',
              },
              {
                label: 'Adresse',
                field: 'address',
              },
              {
                label: 'Société',
                field: 'company',
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
                field: 'contact',
              },
            ],
            customers: [],
          }
      },
      created() {
          let self = this;
          this.checkIfLogged()
          .then(response => {
              this.user = response ? response : window.location = '/#/login';
              if(this.user.employee == false){self.$router.push('login');}
          })
          .catch(error => console.log(error));
          sessionStorage.removeItem('idCu');
          axios.get('/customersList/')
            .then(response=>{self.customers = response.data;})
            .catch(function (error) {console.log(error);});
      },
      methods: {
         /**
          *
          */
         createCustomer(){
           const self = this;
           self.$router.push('newCustomer');

         },

         /**
          * Récupère l'id de l'objet cliqué qui correspond à l'id du fournisseur concerné
          * Enregistre dans le sessionStorage l'id du user
          * Redirige sur la page SignUp
          */
         onRowClick(params){
           const self = this;
           sessionStorage.setItem('idCu',params.row.id);
           self.$router.push('customerInfo');
         }
      }
    }
</script>
