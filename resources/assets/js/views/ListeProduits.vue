<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="arrayProduct"
      :search-options="{
        enabled: true,
      }"
      :sort-options="{
        enabled: true,
        initialSortBy: {field: 'nom', type: 'asc'}
      }"
      :pagination-options="{
        enabled: true,
        perPage: 25,
      }"
      @on-row-click="onRowClick"
      styleClass="vgt-table striped bordered"/>
    <br/>
  </div>
</template>

<script>
export default {
  name: 'my-component',
  data(){
    return {
      columns: [
        {
          label: 'Nom',
          field: 'nom',
        },
        {
          label: 'Catégorie',
          field: 'categorie',
        },
        {
          label: 'Référence GreenDom',
          field: 'reference',
        },
        {
          label: 'Référence fournisseur',
          field: 'refSupplier',
        },
        {
          label: 'Fournisseur',
          field: 'name',
        },
        {
          label: 'Prix achat',
          field: 'prixAchat',
          type: 'number',
        },
        {
          label: 'Prix de vente',
          field: 'prixVente',
          type: 'number',
        },
      ],
      arrayProduct: [],
    };
  },

  /**
   * Vérifie qu'il y a un user logué et qu'il est un employé :
   * Si c'est ok :
   *    Efface dans sessionStorage idProd
   *    Charge la liste des produits avec le nom des fournisseurs dans arrayProduct[]
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
        sessionStorage.removeItem('idProd');
        axios({
            method: 'get',
            url: '/productListWithProvName/'
            })
            .then(function (response) {
                self.arrayProduct = response.data;
            })
            .catch(function (error) {
                console.log(error);
        });
    },

    /**
     * Enregistre dans le sessionStorage l'id du produit cliqué
     * Redirige sur la page InfoProduit
     */
    methods: {
        onRowClick(params) {
            sessionStorage.setItem('idProd',params.row.id);
            this.$router.push('productInfo');
        },
    }
};
</script>
