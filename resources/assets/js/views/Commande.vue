<template>
    <div>
        <div style="padding-top:40px" class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <form method="POST">

              <div>
                <h1 class="title" v-show="commande.status_id == 1">Demande - En cours N°{{ this.commande.num_demande }}</h1>
                <h1 class="title" v-show="commande.status_id == 2">Demande - Envoyé N°{{ this.commande.num_demande }}</h1>
                <h1 class="title" v-show="commande.status_id == 3">Offre - En cours N°{{ this.commande.num_offre }}</h1>

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
                  <input class="input" type="text" placeholder="Objet" v-model="commande.concerne" :disabled="this.commande.status_id > 1 && !this.currentUser.employee">
                </div>
                <label class="label">Message</label>
                <div class="control">
                  <textarea class="textarea" placeholder="Décrivez ici votre cas ..." v-model="commande.descriptionCommande" :disabled="this.commande.status_id > 1 && !this.currentUser.employee"></textarea>
                </div>
              </div>

              <div class="field" v-if="!visibiliteActioncommandeEnvoye">
                <div class="field">
                <input type="file" id="files" ref="files" multiple v-on:change="handleFileUploads()"/>
              </div>
              </div>


            </form>

            <!-- TRAVAILLE KEVIN/FRANK // Pour tester-->
            <!-- http://192.168.10.10/#/commande/2/4 -->
            <!-- Ajout d'articles -->


            <div class="card" style="margin-bottom:15px" v-show="enableAjoutProduits"> <!-- Si la commande est une offre (3) on montre -->
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

                        <!-- Liste produits choisis -->
                        <article class="media"  v-for="(produit, index) in produits_choisis"> <!--  :key="produit.reference" Utile pour voir si deja dans liste -->
                          <div class="media-left">
                            <figure class="image is-64x64">
                              <img :src="produit.image" alt="Image">
                            </figure>
                          </div>
                          <div class="media-content">
                            <div class="content">
                              <p>
                                <strong> {{produit.nom}} </strong> <small class="is-pulled-right"> Réf : {{produit.reference}} </small>
                                <br/>
                                    <button class="is-pulled-left button is-danger" @click="diminueProduit(produit.quantite, index)"> - </button>
                                    <label class="is-pulled-left" style="margin-left:5px; margin-right:5px">  {{produit.quantite}}  </label>
                                    <button class="is-pulled-left button is-success" @click="augmenteProduit(produit.quantite, index)"> + </button>

                                    <select name="liste_fournisseur" style="margin-left:5px">
                                         <option v-for="fournisseur in produit.fournisseurs"> {{fournisseur.nom}} <span hidden> {{fournisseur.id}} </span> </option>
                                    </select>
                                    <div>
                                      Prix <input type="text" style="width:30px" v-on:keyup="miseAJourProduitPrix($event, index)"> .- <br/>
                                      <input id="chkRemise" type="checkbox" @click="visibiliteRemise(produit.remiseBoolean, index)"> Remise
                                      <a v-show="produit.remiseBoolean">
                                        <input type="text" style="width:30px" v-on:keyup="miseAJourRemise($event, index)"> % <br/>
                                        Rabais : {{produit.remisePrix}}.-
                                      </a>
                                      <br/>
                                      Total : {{produit.total}}.-
                                      <button class="button is-info" @click="calculerPrix(produit.remisePourcent, produit.quantite,  produit.prix, produit.remiseBoolean, produit.remisePrix, index)"> Calculer </button>
                                    </div>
                                <button @click="supprimerProduit(index)" class="is-pulled-right button is-danger"> Supprimer </button>
                              </p>
                            </div>
                            <button class="modal-close" @click="$emit('close')"></button>
                          </div>
                        </article>

                          <!-- Bouton + | Selection de produit -->
                        <div class="buttons has-addons is-left" id="boutonAjout">
                            <modal v-show="showModal" @close="showModal = false"></modal>
                            <button @click="showModal = true" class="button is-primary modal-button" style="margin-right:2px"> + </button>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN TRAVAILLE KEVIN/FRANK -->


            </div>

            <div class="field">
              <div class="buttons has-addons is-centered" v-if="!visibiliteActioncommandeEnvoye">
                <button @click.prevent="enregistrer" class="button is-info" style="margin-right:2px">Enregistrer</button>
                <button @click.prevent="envoyer" class="button is-success" style="margin-left:2px;margin-right:2px" v-show="enabledBtnEnvoyercommande">Envoyer</button>
                <button @click.prevent="passerEtapeSuivante" class="button is-success" style="margin-left:2px;margin-right:2px" v-show="enabledBtnPasserEncours">Valider commande</button>
                <button @click.prevent="passerEtapeSuivante" class="button is-success" style="margin-left:2px;margin-right:2px" v-show="enabledBtnEnvoyer" >Valider Offre</button>
                <button @click.prevent="demandePrixFournisseur" class="button is-success" style="margin-left:2px;margin-right:2px" v-show="enabledBtnEnvoyer" >Envoyer au fournisseur</button>
                <button @click.prevent="envoyerClient" class="button is-success" style="margin-left:2px;margin-right:2px" v-show="enabledBtnEnvoyer">Envoyer au Client</button>
                <button class="button is-danger" style="margin-left:2px">Annuler</button>
              </div>
            </div>
            {{ enabledBtnEnvoyercommande }}
            {{ this.commande.status_id == "" }}
          </div>
        </div>
    </div>
</template>


<script>
  import {Store} from './store'

    export default {

        data() {
            return {
                customer: "",
                commande: {
                  id: "",
                  concerne: "",
                  descriptionCommande: "",
                  status_id: ""
                },
                company: "",
                active : false,
                currentUser: "",
                showModal: false,
                produits_choisis: Store.$data.panier  //liée au store
            }
        },

        created() {
            this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : window.location = '/#/login';
                    console.log(this.user);
                })
            .catch(error => console.log(error));
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
              //utilisateur courant
              axios.get('/'+this.$route.params.user)
                  .then(({data}) => this.currentUser = data);
              //user
              axios.get('/'+this.$route.params.user+'/'+this.$route.params.commande)
                  .then(({data}) => this.customer = data);
              //commande
              axios.get('/infoCommande/'+this.$route.params.commande)
                  .then(({data}) => this.commande = data)
                  .catch(function (error) {
                    console.log(error.response);
                  });
              //company
              axios.get('/company/'+this.$route.params.user+'/'+this.$route.params.commande)
                  .then(({data}) => this.company = data);
            }


            /*//pdf
            axios.get('/commande/pdf')
                .then(console.log(""));*/
        },

        methods:{
          //enregistrer modif commande
          enregistrer() {
            var id = this.customer.id;
            //IF offre SINON fournisseur
            if (!this.commande.id){
              axios.post('/insertDemande/'+this.customer.id, {typeSubmit: "Enregistrer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            } else {
              axios.post('/storeDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Enregistrer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            }
          },

          //METHODES POUR L'OFFRE
          augmenteProduit(quantite, index) {
            this.produits_choisis[index].quantite = quantite+1;
          },

          diminueProduit(quantite, index) {
            if (this.produits_choisis[index].quantite == 1) {
              this.produits_choisis[index].quantite = quantite+0;
            } else {
              this.produits_choisis[index].quantite = quantite-1;
            }
          },

          supprimerProduit(index) {
            this.produits_choisis.splice(index, 1);
          },

          visibiliteRemise(remise, index) {
            if (remise == false) {
              this.produits_choisis[index].remiseBoolean = true;
            } else {
              this.produits_choisis[index].remiseBoolean = false;
              this.produits_choisis[index].remisePourcent = 0;
              this.produits_choisis[index].remisePrix = 0;
            }
          },

          miseAJourProduitPrix(e, index) {
            console.log("CHF"+e.target.value);
            this.produits_choisis[index].prix = e.target.value;
          },

          miseAJourRemise(e, index) {
            console.log("%"+e.target.value);
            this.produits_choisis[index].remisePourcent = e.target.value;
          },

          calculerPrix(txtRemisePourcent, quantite, prix, remise, remisePrix, index) { //checker si remise, prix, remise, gain, total
            console.log("remisePourcent"+ txtRemisePourcent+" quantité "+quantite+" prix "+prix +" remise "+remise+" remisePrix "+remisePrix);
            var remiseCalcul = ((quantite*prix) * txtRemisePourcent)/100;
            console.log(remiseCalcul);
            var prixTotal = prix * quantite;
            this.produits_choisis[index].remisePourcent = txtRemisePourcent;
            this.produits_choisis[index].remisePrix = remiseCalcul;
            this.produits_choisis[index].total = prixTotal-remiseCalcul;
          },
          //FIN METHODES POUR OFFRE

          envoyer() {
            var id = this.customer.id;
            if (!this.commande.id){
              axios.post('/insertDemande/'+this.customer.id, {typeSubmit: "Envoyer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            } else {
              axios.post('/storeDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Envoyer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
            }
          },

          passerEtapeSuivante(){
            var id = this.customer.id;
            axios.post('/validerStatut/'+this.commande.id,{commande:this.commande})
              .then(function(response){
                window.location.href='/#/listOrder/'+id;
            });
          },

          demandePrixFournisseur(){
            axios.post('/fournisseurMailDemandePrix')
            .then(function(response){
              console.log('mail Envoyé');
            });
          }

        },

        computed:{
          visibiliteActioncommandeEnvoye(){
            if (this.commande.status_id > 1 && !this.currentUser.employee){
              return true;
            }
            return false;
          },

          enabledBtnEnvoyercommande(){
            if (this.commande.status_id == 1 || this.commande.status_id == ""){
              return true;
            }
            return false;
          },

          enabledBtnEnvoyer(){
            if (this.commande.status_id == 3){
              return true;
            }
            return false;
          },

          enabledBtnPasserEncours(){
            if (this.commande.status_id == 2){
              return true;
            }
            return false;
          },

          enableAjoutProduits() {
            if (this.commande.status_id == 3 && this.currentUser.employee) {
              return true;
            }
            return false;
          }
        },
    }

    /*Fenêtre composant
    Vue.component('modal', {
      template: '#modal-template'
    })
    */
    Vue.component('modal', {
    template:
    `
     <div id="modal" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <div class="box">
          <article class="media"  v-for="(produit, index) in produits" :key="produit.reference">
            <div class="media-left">
              <figure class="image is-64x64">
                <img :src="produit.image" alt="Image">
              </figure>
            </div>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong> {{produit.nom}} </strong> <small class="is-pulled-right"> Réf : {{produit.reference}} </small>
                  <br>
                  {{produit.description}}
                <div class="is-pulled-right">
                  <button class="button is-info" @click="ajoutProduit(produit, produit.reference)"> Seléctionner </button>
                  <button class="button is-danger" @click="$emit('close')"> Fermer </button>
                </div>
                </p>
              </div>
              <button class="modal-close" @click="$emit('close')"></button>
            </div>
          </article>
        </div>
      </div>

    </div>
    `,

    data() {
      return {
        test: 'test',
        produits: ''
      }
    },

    created() {
        //Liste des listeProduits
        axios.get('/produitsOffre')
          .then(({data}) => this.produits = data);
    },

    methods:{
      ajoutProduit(produit, reference) {
        axios.get('/fournisseurList/'+produit.id)
              .then(response => {this.fournisseurs = response.data; console.log(this.fournisseurs); Store.ajoutPanier(produit, reference, this.fournisseurs)});
      },
    }

  })

</script>
