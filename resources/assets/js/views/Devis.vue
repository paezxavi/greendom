<template>
    <div>
        <div style="padding-top:40px" class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <form method="POST">

              <h1 class="title">Devis N°{{ this.commande.num_devis }}</h1>

              <div class="card" style="margin-bottom:15px">
                <header class="card-header">
                  <p class="card-header-title">
                    Données personnelles
                  </p>
                </header>
                <div class="card-content">
                  <div class="content">

                    <div class="field">
                      <div class="columns is-mobile">
                        <div class="column">
                          <label class="label">Nom : {{ customer.name }}</label>
                        </div>
                        <div class="column">
                          <label class="label">Prenom : {{ customer.forename }}</label>
                        </div>
                      </div>
                    </div>

                    <div class="field">
                      <label class="label">Adresse : {{ customer.adresse }}</label>
                    </div>

                    <div class="field">
                      <div class="columns is-mobile">
                        <div class="column">
                          <label class="label">Email : {{ customer.email }}</label>
                        </div>
                        <div class="column">
                          <label class="label">Contact : {{ customer.contact }}</label>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="field" v-if="customer.company_id != null">
                <div class="control">
                  <label class="checkbox">
                    <input type="checkbox" @click="active = !active">
                    Concerne la société pour laquelle je travaille
                  </label>
                </div>
              </div>

              <div class="field" v-show="active">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Société : {{ company.nom }}</label>
                  </div>
                  <div class="column">
                    <label class="label">Adresse : {{ company.adresse }}</label>
                  </div>
                  <div class="column">
                    <label class="label">Email : {{ company.email }}</label>
                  </div>
                </div>
              </div>

              <div class="field">
                <label class="label">Concerne</label>
                <div class="control">
                  <input class="input" type="text" placeholder="Objet" v-model="commande.concerne">
                </div>
                <label class="label">Message</label>
                <div class="control">
                  <textarea class="textarea" placeholder="Décrivez ici votre cas ..." v-model="commande.descriptionDevis"></textarea>
                </div>
              </div>

              <div class="field">
                <div class="file">
                  <label class="file-label">
                    <input class="file-input" type="file" name="resume">
                    <span class="file-cta">
                      <span class="file-icon">
                        <i class="fas fa-upload"></i>
                      </span>
                      <span class="file-label">
                        Choose a File…
                      </span>
                    </span>
                  </label>
                </div>
              </div>

              <div class="field">
                <div class="buttons has-addons is-centered">
                    <button @click.prevent="enregistrer" class="button is-info" style="margin-right:2px">Enregistrer</button>
                    <button class="button is-success" style="margin-left:2px;margin-right:2px">Envoyer</button>
                    <button class="button is-danger" style="margin-left:2px">Annuler</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</template>


<script>
    export default {

        data() {
            return {
                customer: "",
                commande: {
                  id: "",
                  concerne: "",
                  descriptionDevis: ""
                },
                company: "",
                active : false
            }
        },

        created() {
            //user
            axios.get('/'+this.$route.params.user)
                .then(({data}) => this.customer = data);

            //commande
            if (!this.$route.params.commande){
              self.commande = "";
            } else {
              axios.get('/infoDevis/'+this.$route.params.user+'/'+this.$route.params.commande)
                  .then(({data}) => this.commande = data)
                  .catch(function (error) {
                    console.log(error.response);
                  });
            }

            //company
            axios.get('/company/'+this.$route.params.user)
                .then(({data}) => this.company = data);
            //pdf
            axios.get('/devis/pdf')
                .then(console.log(""));
        },

        methods:{
          //enregistrer modif devis
          enregistrer() {
            var id = this.customer.id;
            if (!this.commande.id){
              axios.post('/storeDevis/'+this.customer.id, {commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            } else {
              axios.post('/storeDevis/'+this.customer.id+"/"+this.commande.id, {commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            }
          },

          envoyer() {
            var id = this.customer.id;

          }

        }
    }
</script>
