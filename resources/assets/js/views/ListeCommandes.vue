<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="arrayCommande"
      :search-options="{
        enabled: true,
      }"
      :pagination-options="{
        enabled: true,
        perPage: 25,
      }"
      @on-row-click="onRowClick"
      styleClass="vgt-table striped bordered"/>
    <br/>
    <a @click="nouvelleDemande" class="button is-primary">Nouvelle demande</a>

  </div>
</template>

<script>
export default {
  name: 'my-component',
  data(){
    return {
      columns: [
        {
          label: 'Date de début',
          field: 'dateDebut',
          type: 'date',
          dateInputFormat: 'YYYY-MM-DD',
          dateOutputFormat: 'DD-MM-YYYY',
        },
        {
          label: 'Dernière modification',
          field: 'update_at',
          type: 'date',
          dateInputFormat: 'YYYY-MM-DD',
          dateOutputFormat: 'DD-MM-YYYY',
        },
        {
          label: 'Client',
          field: this.getClient,
        },
        {
          label: 'Concerne',
          field: 'concerne',
        },
        {
          label: 'Statut',
          field: 'status.nom',
        },
      ],
        arrayCommande: [],
        //defaultOpenedDetails: [1],
        currentUser: "",
        user: false,
    };
  },
  created() {
        let self = this;
        this.checkIfLogged()
        .then(response => {
                this.user = response ? response : window.location = '/#/login';
                console.log(this.user);
            })                    
        .catch(error => console.log(error));
        axios.get('/'+this.$route.params.user)
            .then(({data}) => this.currentUser = data);
        /*axios.get('/commandeList/'+this.$route.params.user)
            .then(({data}) => this.arrayCommande = data);*/
        axios({
            method: 'get',
            url: '/commandeList/'+this.$route.params.user,
            })
            .then(function (response) {
                self.arrayCommande = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },

    methods: {
        onRowClick(params) {
            window.location.href="/#/commande/"+this.user.id+"/"+params.row.id;
            location.reload();
        },

        getClient(rowObj) {
            return rowObj.users.forename + " " + rowObj.users.name;
        },
        nouvelleDemande(){
                    this.$router.push('/commande/'+ this.$route.params.user);

        },
    }
};
</script>