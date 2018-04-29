<template>
    <div>
        <div class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <form method="POST">

              <div>
                <h1 class="title" v-show="commande.status_id == 1">Demande - En cours N°{{ this.commande.num_demande }}</h1>
                <h1 class="title" v-show="commande.status_id == 2">Demande - Envoyé N°{{ this.commande.num_demande }}</h1>
                <h1 class="title" v-show="commande.status_id == 3">Offre - En cours N°{{ this.commande.num_offre }}</h1>
                <h1 class="title" v-show="commande.status_id == 4">Offre - Envoyé fournisseur N°{{ this.commande.num_offre }}</h1>
                <h1 class="title" v-show="commande.status_id == 5">Offre - Envoyé client N°{{ this.commande.num_offre }}</h1>
                <h1 class="title" v-show="commande.status_id == 6">Commande - En cours N°{{ this.commande.num_offre }}</h1>
              </div>

              <div class="card" style="margin-bottom:15px; width:100%">
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
                  <input type="file" id="files" ref="files" multiple @change="processFile()">
                </div>
                <div v-for="(file, key) in this.files">
                  <a @click="downloadFile(file)" style="font-size:11px">{{file.name}}</a><span class="deleteFile" @click="removeFile(file,key)"><i class="fas fa-times-circle"></i></span>
                </div>
              </div>
            </form>

            <!-- TRAVAILLE KEVIN/FRANK // Pour tester-->
            <!-- http://192.168.10.10/#/commande/2/4 -->
            <!-- Ajout d'articles -->


            <div class="card" style="margin-bottom:15px; width:100%" v-show="enableAjoutProduits"> <!-- Si la commande est une offre (3) on montre -->
              <header class="card-header">
                  <h2 class="card-header-title"> Articles </h2>
              </header>
              <div class="card-content">
                <div class="content">
                  <div class="field">
                    <div class="columns is-mobile">
                      <div class="column">

                        <!-- Liste produits enregistrés -->
                        <h4> Produits enregistrés : </h4>
                        <article class="media"  v-for="(produit_enregistre, index) in produits_enregistres"> <!--  :key="produit.reference" Utile pour voir si deja dans liste -->
                          <div class="media-left">
                            <figure class="image is-64x64">
                              <img :src="produit_enregistre.image" alt="Image">
                            </figure>
                          </div>
                          <div class="media-content">
                            <div class="content">
                              <p>
                                <strong> {{produit_enregistre.nom}} </strong>
                                <br/>
                                    <button v-if="enabledOffre" class="is-pulled-left button is-danger" @click="diminueProduitEnregistre(produit_enregistre.quantite, index)"> - </button>
                                    <label class="is-pulled-left" style="margin-left:5px; margin-right:5px">  {{produit_enregistre.quantite}}  </label>
                                    <button v-if="enabledOffre" class="is-pulled-left button is-success" @click="augmenteProduitEnregistre(produit_enregistre.quantite, index)"> + </button>

                                    <select v-if="enabledOffre" style="margin-left:5px" v-on:change="miseAJourFournisseurEnregistre($event, index)">
                                         <option> {{produit_enregistre.fournisseurChoisi}} </option>
                                    </select>

                                    <div>
                                      Prix <input :disabled='!enabledOffre' :value="produit_enregistre.prix" type="text" style="width:30px" v-on:keyup="miseAJourProduitPrixEnregistre($event, index)"> .- <br/>
                                      <input :disabled='!enabledOffre' id="chkRemise" type="checkbox" @click="visibiliteRemiseEnregistre(produit_enregistre.remiseBoolean, index)" :checked="produit_enregistre.remiseBoolean"> Remise
                                      <a v-show="produit_enregistre.remiseBoolean">
                                        <input :disabled='!enabledOffre' type="text" style="width:30px" v-on:keyup="miseAJourRemiseEnregistre($event, index)" :value="produit_enregistre.remisePourcent"> % <br/>
                                        Rabais : {{produit_enregistre.remisePrix}}.-
                                      </a>
                                      <br/>
                                      Total : {{produit_enregistre.total}}.-
                                      <button v-if="enabledOffre" class="button is-info" @click="calculerPrixEnregistre(produit_enregistre.remisePourcent, produit_enregistre.quantite,  produit_enregistre.prix, produit_enregistre.remiseBoolean, produit_enregistre.remisePrix, index)"> Calculer </button>
                                    </div>
                                <button v-if="enabledOffre" @click="supprimerProduitEnregistre(index)" class="is-pulled-right button is-danger"> Supprimer </button>
                              </p>
                            </div>
                          </div>
                        </article>
                        
                        <div v-if="enabledOffre">
                          <hr/>
                          <!-- Liste produits choisis -->
                          <h4> Nouveaux produits : </h4>
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
                                      <button class="is-pulled-left button is-danger" @click="diminueNouveauProduit(produit.quantite, index)"> - </button>
                                      <label class="is-pulled-left" style="margin-left:5px; margin-right:5px">  {{produit.quantite}}  </label>
                                      <button class="is-pulled-left button is-success" @click="augmenteNouveauProduit(produit.quantite, index)"> + </button>

                                      <select style="margin-left:5px" v-on:change="miseAJourNouveauFournisseur($event, index)">
                                          <option v-for="fournisseur in produit.fournisseurs" :value="fournisseur.nom"> {{fournisseur.nom}}
                                            <span hidden> {{fournisseur.id}} </span>
                                          </option>
                                      </select>
                                      <div>
                                        Prix <input type="text" style="width:30px" v-on:keyup="miseAJourNouveauProduitPrix($event, index)"> .- <br/>
                                        <input id="chkRemise" type="checkbox" @click="visibiliteNouveauRemise(produit.remiseBoolean, index)"> Remise
                                        <a v-show="produit.remiseBoolean">
                                          <input type="text" style="width:30px" v-on:keyup="miseAJourNouveauRemise($event, index)"> % <br/>
                                          Rabais : {{produit.remisePrix}}.-
                                        </a>
                                        <br/>
                                        Total : {{produit.total}}.-
                                        <button class="button is-info" @click="calculerNouveauPrix(produit.remisePourcent, produit.quantite,  produit.prix, produit.remiseBoolean, produit.remisePrix, index)"> Calculer </button>
                                      </div>
                                  <button @click="supprimerNouveauProduit(index)" class="is-pulled-right button is-danger"> Supprimer </button>
                                </p>
                              </div>
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
              </div>
              <!-- FIN TRAVAILLE KEVIN/FRANK -->


            </div>
            <!--{{this.commande.status_id}}
            <div>Hello</div>-->
            <div class="field">
              <div class="buttons has-addons is-centered" v-if="!visibiliteActioncommandeEnvoye">
                <button @click.prevent="enregistrer" class="button is-info" style="margin-right:2px">Enregistrer</button>
                <button @click.prevent="envoyer" class="button is-success" style="margin-left:2px;margin-right:2px" v-show="enabledBtnEnvoyercommande">Envoyer</button>
                <button @click.prevent="demandePrixFournisseur" class="button is-success" style="margin-left:2px;margin-right:2px" v-if="enabledOffre" >Envoyer au fournisseur</button>
                <button @click.prevent="envoieClient" class="button is-success" style="margin-left:2px;margin-right:2px" v-if="enabledOffre">Envoyer au Client</button>
                <button @click.prevent="passerEtapeSuivante" class="button is-success" style="margin-left:2px;margin-right:2px" :disabled="this.commande.status_id !=5" v-if="enabledOffre" >Valider Offre</button>
                <button @click.prevent="passerEtapeSuivante" class="button is-success" style="margin-left:2px;margin-right:2px" v-show="enabledBtnPasserEncours">Valider commande</button>
                <button @click.prevent="passerEtapeSuivante" class="button is-success" style="margin-left:2px;margin-right:2px" v-if="enabledCommande">Commande reçu</button>

                <button class="button is-danger" style="margin-left:2px">Annuler</button>
              </div>
            </div>
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
                idCreated: "",
                active : false,
                currentUser: "",
                showModal: false,
                produits_choisis: Store.$data.panier,
                produits_enregistres: Store.$data.panierEnregistres,
                produits_recuperes: "",
                filesAdd: '',
                files: ''
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

              //Produits enregistrés dans la commande
              axios.get('/produitsCommande/'+this.$route.params.commande)
                  //.then(({data}) => this.produits_enregistres = data);
                  .then(response => {
                    this.produits_recuperes = response.data;
                    Store.ajoutPanierProduitEnregistrer(this.produits_recuperes)
              });

              //Files
              axios.get('/files/'+this.$route.params.commande)
                  .then(({data}) => this.files = data);
          }
        },

        methods:{
          storeFile() {
            let formData = new FormData();
            for( var i = 0; i < this.filesAdd.length; i++ ){
              let file = this.filesAdd[i];

              formData.append('files[' + i + ']', file);
            }
            if(!this.commande.id){
                console.log(this.idCreated);
                axios.post( '/storeFile/'+this.idCreated,
                  formData,
                  {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                  }
                ).then(function(){
                  console.log('SUCCESS!!');
                })
                .catch(function(){
                  console.log('FAILURE!!');
                });
            } else {
                axios.post( '/storeFile/'+this.commande.id,
                  formData,
                  {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                  }
                ).then(function(){
                  console.log('SUCCESS!!');
                })
                .catch(function(){
                  console.log('FAILURE!!');
                });
            }
            
          },
          //enregistrer modif commande
          enregistrer() {
            var id = this.customer.id;
            var commandId = this.commande.id;
            let self = this;
            //IF offre SINON fournisseur
            if (!this.commande.id){
              axios({
                method: 'post',
                url: '/insertDemande/'+this.customer.id,
                timeout: 8000, // Let's say you want to wait at least 8 seconds
                data: {
                  typeSubmit: "Enregistrer",
                  commande: this.commande,
                  company:this.company,
                  customer:this.customer
                }
              })
              .then(function (response) {
                    console.log(response);
                    self.idCreated = response.data;
                    self.storeFile();
                    location.reload();
                    window.location.href='/#/listOrder/'+id;
              })
              .catch(function (error) {
                  console.log(error);
              });
            } else {
              //Nouveaux produits
              axios.post('/storeDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Enregistrer",commande: this.commande, company:this.company, customer:this.customer, products:this.produits_choisis})
                      .then(function (response) {
                        location.reload();
                        window.location.href='/#/commande/'+id+'/'+commandId;
                      });
              //Produits enregistres
              axios.post('/updateDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Update",commande: this.commande, company:this.company, customer:this.customer, products:this.produits_enregistres})
                    .then(function (response) {
                      location.reload();
                      window.location.href='/#/commande/'+id+'/'+commandId;
                    });
              self.storeFile();         
            }

          },

          //METHODES POUR L'OFFRE
          //Nouveaux Produits
          augmenteNouveauProduit(quantite, index) {
            this.produits_choisis[index].quantite = quantite+1;
          },

          diminueNouveauProduit(quantite, index) {
            if (this.produits_choisis[index].quantite == 1) {
              this.produits_choisis[index].quantite = quantite+0;
            } else {
              this.produits_choisis[index].quantite = quantite-1;
            }
          },

          supprimerNouveauProduit(index) {
            this.produits_choisis.splice(index, 1);
          },

          miseAJourNouveauFournisseur(e, index) {
            var fournisseur = e.target.value;
            this.produits_choisis[index].fournisseurChoisi = fournisseur; //id,nom
            console.log("Fournisseur : "+fournisseur);
          },

          visibiliteNouveauRemise(remise, index) {
            if (remise == false) {
              this.produits_choisis[index].remiseBoolean = true;
            } else {
              this.produits_choisis[index].remiseBoolean = false;
              this.produits_choisis[index].remisePourcent = 0;
              this.produits_choisis[index].remisePrix = 0;
            }
          },

          miseAJourNouveauProduitPrix(e, index) {
            console.log("CHF"+e.target.value);
            this.produits_choisis[index].prix = e.target.value;
          },

          miseAJourNouveauRemise(e, index) {
            console.log("%"+e.target.value);
            this.produits_choisis[index].remisePourcent = e.target.value;
          },

          calculerNouveauPrix(txtRemisePourcent, quantite, prix, remise, remisePrix, index) { //checker si remise, prix, remise, gain, total
            console.log("remisePourcent"+ txtRemisePourcent+" quantité "+quantite+" prix "+prix +" remise "+remise+" remisePrix "+remisePrix);
            var remiseCalcul = ((quantite*prix) * txtRemisePourcent)/100;
            console.log(remiseCalcul);
            var prixTotal = prix * quantite;
            this.produits_choisis[index].remisePourcent = txtRemisePourcent;
            this.produits_choisis[index].remisePrix = remiseCalcul;
            this.produits_choisis[index].total = prixTotal-remiseCalcul;
          },

          //Produits Enregistres
          augmenteProduitEnregistre(quantite, index) {
            this.produits_enregistres[index].quantite = quantite+1;
          },

          diminueProduitEnregistre(quantite, index) {
            if (this.produits_enregistres[index].quantite == 1) {
              this.produits_enregistres[index].quantite = quantite+0;
            } else {
              this.produits_enregistres[index].quantite = quantite-1;
            }
          },

          supprimerProduitEnregistre(index) {
            var idProduit = this.produits_enregistres[index].id;
            console.log(idProduit);
            axios.delete('/supprimerProduit/'+idProduit+"/"+this.commande.id, {typeSubmit: "Envoyer",commande: this.commande, company:this.company, customer:this.customer})
              .then(function (response) {
                //location.reload();
                //window.location.href='/#/commande/'+id+'/'+commandId;
            });
            this.produits_enregistres.splice(index, 1);
          },

          miseAJourFournisseurEnregistre(e, index) {
            //this.produits_enregistres[index].fournisseurChoisi = e.target.value;
            console.log("Fournisseur : "+e.target.value);
          },

          visibiliteRemiseEnregistre(remise, index) {
            if (remise == false) {
              this.produits_enregistres[index].remiseBoolean = true;
            } else {
              this.produits_enregistres[index].remiseBoolean = false;
              this.produits_enregistres[index].remisePourcent = 0;
              this.produits_enregistres[index].remisePrix = 0;
            }
          },

          miseAJourProduitPrixEnregistre(e, index) {
            console.log("CHF"+e.target.value);
            this.produits_enregistres[index].prix = e.target.value;
          },

          miseAJourRemiseEnregistre(e, index) {
            console.log("%"+e.target.value);
            this.produits_enregistres[index].remisePourcent = e.target.value;
          },

          calculerPrixEnregistre(txtRemisePourcent, quantite, prix, remise, remisePrix, index) { //checker si remise, prix, remise, gain, total
            console.log("remisePourcent"+ txtRemisePourcent+" quantité "+quantite+" prix "+prix +" remise "+remise+" remisePrix "+remisePrix);
            var remiseCalcul = ((quantite*prix) * txtRemisePourcent)/100;
            var prixTotal = prix * quantite;
            this.produits_enregistres[index].remisePourcent = txtRemisePourcent;
            this.produits_enregistres[index].remisePrix = remiseCalcul;
            this.produits_enregistres[index].total = prixTotal-remiseCalcul;
          },
          //FIN METHODES POUR OFFRE

          envoyer() {
            var id = this.customer.id;
            let self = this;
            if (!this.commande.id){
              axios({
                method: 'post',
                url: '/insertDemande/'+this.customer.id,
                timeout: 8000, // Let's say you want to wait at least 8 seconds
                data: {
                  typeSubmit: "Envoyer",
                  commande: this.commande,
                  company:this.company,
                  customer:this.customer
                }
              })
              .then(function (response) {
                    console.log(response);
                    self.idCreated = response.data;
                    self.storeFile();
                    location.reload();
                    window.location.href='/#/listOrder/'+id;
              })
              .catch(function (error) {
                  console.log(error);
              });
            } else {
              axios.post('/storeDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Envoyer",commande: this.commande, company:this.company, customer:this.customer})
                      .then(function (response) {
                        window.location.href='/#/listOrder/'+id;
                      });
              self.storeFile();
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
            this.enregistrer();
            axios.post('/fournisseurMailDemandePrix/'+this.commande.id)
            .then(function(response){
              console.log('mail Envoyé');
            });
            var id = this.customer.id;
            axios.post('/validerStatut/'+this.commande.id,{commande:this.commande})
              .then(function(response){
                window.location.href='/#/listOrder/'+id;
            });
          },

          envoieClient(){
            this.enregistrer();
            axios.post('/clientMailOffre/'+this.commande.id)
            .then(function(response){
              console.log('mail Envoyé');
            });
            var id = this.customer.id;
            axios.post('/validerClient/'+this.commande.id,{commande:this.commande})
              .then(function(response){
                window.location.href='/#/listOrder/'+id;
            });
          },

          processFile(event) {
            this.filesAdd = this.$refs.files.files;
          },

          downloadFile(file) {
            console.log(file);
            axios({
              url: '/downloadFile/'+file.id,
              method: 'GET',
              responseType: 'blob', // important
            }).then((response) => {
              const url = window.URL.createObjectURL(new Blob([response.data]));
              const link = document.createElement('a');
              link.href = url;
              link.setAttribute('download', file.name);
              document.body.appendChild(link);
              link.click();
            });
          },

          removeFile(file,key) {
            axios.delete('/removeFile/'+file.id)
              .then(this.files.splice(key, 1 ));
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

          enabledOffre(){
            if (this.commande.status_id >= 3 && this.commande.status_id <= 5){
              return true;
            }
            return false;
          },

          enabledCommande(){
            if (this.commande.status_id >5){
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
            if (this.commande.status_id >= 3 && this.currentUser.employee) {
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
    <div id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Produits</p>
          <button class="delete" aria-label="close" @click="$emit('close')"></button>
        </header>
        <section class="modal-card-body">
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
                  </div>
                  </p>
                </div>
              </div>
            </article>
          </div>
        </section>
        <footer class="modal-card-foot">
          <button class="button is-danger" @click="$emit('close')"> Fermer </button>
        </footer>
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
