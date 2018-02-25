<template>
    <div>
        <div style="padding-top:40px" class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <form method="POST">

              <div>
                <h1 class="title" v-show="commande.status_id == 1 || commande.status_id == 2">Devis N°{{ this.commande.num_devis }}</h1>
                <h1 class="title" v-show="commande.status_id == 3 || commande.status_id == 4">Offre N°{{ this.commande.num_offre }}</h1>
              </div>

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
                <div class="card">
                  <header class="card-header">
                    <p class="card-header-title">
                      Données Société
                    </p>
                  </header>
                  <div class="card-content">
                    <div class="content">

                          <label class="label">Société : {{ company.nom }}</label>

                          <label class="label">Adresse : {{ company.adresse }}</label>

                          <label class="label">Email : {{ company.email }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="field">
                <label class="label">Concerne</label>
                <div class="control">
                  <input class="input" type="text" placeholder="Objet" v-model="commande.concerne" :disabled="this.commande.status_id > 1 && !this.customer.employee">
                </div>
                <label class="label">Message</label>
                <div class="control">
                  <textarea class="textarea" placeholder="Décrivez ici votre cas ..." v-model="commande.descriptionDevis" :disabled="this.commande.status_id > 1 && !this.customer.employee"></textarea>
                </div>
              </div>

              <div class="field" v-if="!visibiliteActionDevisEnvoye">
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


              <!-- TRAVAILLE KEVIN/FRANK // Pour tester-->
              <!-- Fenêtre modale -->
              <div id="modal" class="modal">
                <div class="modal-background"></div>
                <div class="modal-content">
                  <div class="box">
                    <article class="media">
                      <div class="media-left">
                        <figure class="image is-64x64">
                          <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                        </figure>
                      </div>
                      <div class="media-content">
                        <div class="content">
                          <p>
                            <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
                            <br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.
                          </p>
                        </div>
                        <nav class="level is-mobile">
                          <div class="level-left">
                            <a class="level-item">
                              <span class="icon is-small"><i class="fas fa-reply"></i></span>
                            </a>
                            <a class="level-item">
                              <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                            </a>
                            <a class="level-item">
                              <span class="icon is-small"><i class="fas fa-heart"></i></span>
                            </a>
                          </div>
                        </nav>
                      </div>
                    </article>
                  </div>
                </div>
                <button class="modal-close is-large"> Fermer </button>
              </div>

              <!-- http://192.168.10.10/#/devis/2/4 -->
              <!-- Ajout d'articles -->
              <div class="card" style="margin-bottom:15px" v-show="commande.status_id == 3 || commande.status_id == 4"> <!-- Si la commande est une offre (3) on montre -->
                <header class="card-header">
                  <p class="card-header-title">
                    Articles
                  </p>
                </header>
                <div class="card-content">
                  <div class="content">
                    <div class="field">
                      <div class="columns is-mobile">
                        <div class="column">
                          <!-- Bouton + -->
                          <ul id="liste_produits">
                            <!--<li v-for="produit in produits">
                              {{produit.nom}}
                            </li> -->
                          </ul>
                          <div class="buttons has-addons is-left">
                              <button @click.prevent="showModal = true" class="button is-primary modal-button" style="margin-right:2px">+</button>
                              <!-- use the modal component, pass in the prop -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN TRAVAILLE KEVIN/FRANK -->

              <div class="field">
                <div class="buttons has-addons is-centered" v-if="!visibiliteActionDevisEnvoye">
                    <button @click.prevent="enregistrer" class="button is-info" style="margin-right:2px">Enregistrer</button>
                    <button @click.prevent="envoyer" class="button is-success" style="margin-left:2px;margin-right:2px">Envoyer</button>
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
                produits: "",
                commande: {
                  id: "",
                  concerne: "",
                  descriptionDevis: "",
                  status_id: ""
                },
                company: "",
                active : false
            }
        },

        created() {
            //Liste des listeProduits
            axios.get('/produitsOffre')
              .then(({data}) => this.produits = data);


            if (!this.$route.params.commande){
              //commande inexistante
              self.commande = "";
              //user
              axios.get('/'+this.$route.params.user)
                  .then(({data}) => this.customer = data);
              //company
              axios.get('/company/'+this.$route.params.user)
                  .then(({data}) => this.company = data);

            } else {
              //user
              axios.get('/'+this.$route.params.user+'/'+this.$route.params.commande)
                  .then(({data}) => this.customer = data);
              //commande
              axios.get('/infoDevis/'+this.$route.params.commande)
                  .then(({data}) => this.commande = data)
                  .catch(function (error) {
                    console.log(error.response);
                  });
              //company
              axios.get('/company/'+this.$route.params.user+'/'+this.$route.params.commande)
                  .then(({data}) => this.company = data);
            }


            //pdf
            axios.get('/devis/pdf')
                .then(console.log(""));
        },

        methods:{
          //enregistrer modif devis
          enregistrer() {
            var id = this.customer.id;
            if (!this.commande.id){
              axios.post('/insertNewDevis/'+this.customer.id, {typeSubmit: "Enregistrer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            } else {
              axios.post('/storeDevis/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Enregistrer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            }
          },

          //Travaille
          selectionProduit() {

          },

          envoyer() {
            var id = this.customer.id;
            if (!this.commande.id){
              axios.post('/insertNewDevis/'+this.customer.id, {typeSubmit: "Envoyer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            } else {
              axios.post('/storeDevis/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Envoyer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            }
          }

        },

        computed:{
          visibiliteActionDevisEnvoye(){
            if (this.commande.status_id > 1 && !this.customer.employee){
              return true;
            }
            return false;
          }
        }
    }
</script>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>
