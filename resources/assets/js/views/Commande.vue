<template>
    <div>
        <div class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <form method="POST">

              <div>
                <h1 class="title" v-show="commande.status_id == 1">Demande - En cours N°{{ this.commande.num_demande }}</h1>
                <h1 class="title" v-show="commande.status_id == 2">Demande - Envoyée N°{{ this.commande.num_demande }}</h1>
                <h1 class="title" v-show="commande.status_id == 3">Offre - En cours N°{{ this.commande.num_offre }}</h1>
                <h1 class="title" v-show="commande.status_id == 4">Offre - Envoyée fournisseur N°{{ this.commande.num_offre }}</h1>
                <h1 class="title" v-show="commande.status_id == 5">Offre - Envoyée client N°{{ this.commande.num_offre }}</h1>
                <h1 class="title" v-show="commande.status_id == 6">Commande - En cours N°{{ this.commande.num_commande }}</h1>
                <h1 class="title" v-show="commande.status_id == 7">Commande - Reçue N°{{ this.commande.num_commande }}</h1>
                <h1 class="title" v-show="commande.status_id == 8">Commande - Terminée N°{{ this.commande.num_commande }}</h1>
                <h1 class="title" v-show="commande.status_id == 9">Décommander</h1>
              </div>

              <div class="card donneesPers">
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
                      <label class="label">Adresse : {{ customer.address }}</label>
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
                          <label class="label">Société : {{ company.name }}</label>

                          <label class="label">Adresse : {{ company.address }}</label>

                          <label class="label">Email : {{ company.email }}</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="field">
                <label class="label">Concerne</label>
                <div class="control">
                  <input class="input" type="text" placeholder="Objet" v-model="commande.concerne" :disabled="(this.commande.status_id > 1 && !this.currentUser.employee) || this.commande.status_id > 5">
                </div>
                <label class="label">Message</label>
                <div class="control">
                  <textarea class="textarea" placeholder="Décrivez ici votre cas ..." v-model="commande.descriptionCommande" :disabled="(this.commande.status_id > 1 && !this.currentUser.employee) || this.commande.status_id > 5"></textarea>
                </div>
              </div>

              <div class="field">
                <div class="field">
                  <input v-show="!disabledInput" type="file" id="files" ref="files" multiple @change="processFile()">
                </div>
                <div v-for="(file, key) in this.files">
                  <a @click="downloadFile(file)" style="font-size:11px">{{file.name}}</a><span v-if="!checkId() && !checkUserFile()" class="deleteFile" @click="removeFile(file,key)"><i class="fas fa-times-circle"></i></span>
                </div>
              </div>
            </form>

            <!-- TRAVAILLE KEVIN/FRANK // Pour tester-->
            <!-- http://192.168.10.10/#/commande/2/4 -->
            <!-- Ajout d'articles -->


            <div class="card articleBox" v-show="enableAjoutProduits"> <!-- Si la commande est une offre (3) on montre -->
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
                                <div>
                                  <div>
                                    <label class="is-pulled-left"> Quantité : </label>
                                    <button v-if="enabledOffre" v-show="disabledClient" class="is-pulled-left button is-danger is-small" @click="diminueProduitEnregistre(produit_enregistre.quantite, index)"> - </button>
                                    <label class="is-pulled-left" style="margin-left:5px; margin-right:5px">  {{produit_enregistre.quantite}}  </label>
                                    <button v-if="enabledOffre" v-show="disabledClient" class="is-pulled-left button is-success is-small" @click="augmenteProduitEnregistre(produit_enregistre.quantite, index)"> + </button>
                                    <span class="is-pulled-right" v-show="disabledClient">
                                        <label v-if="enabledOffre" style="margin-left:5px"> Fournisseur : {{produit_enregistre.fournisseurChoisi}}</label>
                                    </span>
                                    <br/>
                                </div>
                                <br/>
                                    <div v-show="disabledClient">
                                      <label class="is-pulled-left"> Prix : </label>
                                      <input class="is-pulled-left" :disabled='!enabledOffre' :value="produit_enregistre.prix" type="text" style="width:30px" v-on:keyup="miseAJourProduitPrixEnregistre($event, index)"> .- <br/>
                                      <span>
                                        <input :disabled='!enabledOffre' id="chkRemise" type="checkbox" @click="visibiliteRemiseEnregistre(produit_enregistre.remiseBoolean, index)" :checked="produit_enregistre.remiseBoolean">
                                        <label> Remise </label>
                                      </span>
                                      <span v-show="produit_enregistre.remiseBoolean">
                                        <input :disabled='!enabledOffre' type="text" style="width:30px" v-on:keyup="miseAJourRemiseEnregistre($event, index)" :value="produit_enregistre.remisePourcent"> % <br/>
                                        <small> Rabais : {{produit_enregistre.remisePrix}}.- </small>
                                      </span>
                                      <br/>
                                      <strong> Total : {{produit_enregistre.total}}.- </strong>
                                      <div>
                                        <button v-if="enabledOffre" class="button is-info" @click="calculerPrixEnregistre(produit_enregistre.remisePourcent, produit_enregistre.quantite,  produit_enregistre.prix, produit_enregistre.remiseBoolean, produit_enregistre.remisePrix, index)"> Calculer </button>
                                        <button v-if="enabledOffre" @click="supprimerProduitEnregistre(produit_enregistre, index)" class="is-pulled-right button is-danger"> Supprimer </button>
                                      </div>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </article>
                        
                        <div v-if="enabledOffre" v-show="disabledClient">
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
                                  <div>
                                    <div>
                                        <label class="is-pulled-left"> Quantité : </label>
                                        <button class="is-pulled-left button is-danger is-small" style="margin-left:3px" @click="diminueNouveauProduit(produit.quantite, index)"> - </button>
                                        <label class="is-pulled-left" style="margin-left:5px; margin-right:5px">  {{produit.quantite}}  </label>
                                        <button class="is-pulled-left button is-success  is-small" @click="augmenteNouveauProduit(produit.quantite, index)"> + </button>
                                        <span class="is-pulled-right">
                                          <label> Fournisseur : </label>
                                          <select style="margin-left:5px" v-on:change="miseAJourNouveauFournisseur($event, index)">
                                              <option v-for="fournisseur in produit.fournisseurs" :value="fournisseur.nom"> {{fournisseur.nom}}
                                              </option>
                                          </select>
                                        </span>
                                        <br/>
                                    </div>
                                    <br/>
                                    <div>
                                      <label class="is-pulled-left"> Prix : </label>
                                      <input  class="is-pulled-left" type="text" style="width:50px" v-on:keyup="miseAJourNouveauProduitPrix($event, index)"> .- <br/>
                                      <span>
                                        <input id="chkRemise" type="checkbox" @click="visibiliteNouveauRemise(produit.remiseBoolean, index)">
                                        <label> Remise </label>
                                      </span>
                                      <span v-show="produit.remiseBoolean">
                                        <input type="text" style="width:30px" v-on:keyup="miseAJourNouveauRemise($event, index)"> % <br/>
                                        <small> Rabais : {{produit.remisePrix}}.- </small>
                                      </span>

                                      <br/>
                                      <strong> Total : {{produit.total}}.- </strong>
                                      <div>
                                        <button class="button is-info is-pulled-left" @click="calculerNouveauPrix(produit.remisePourcent, produit.quantite,  produit.prix, produit.remiseBoolean, produit.remisePrix, index)"> Calculer </button>
                                        <button @click="supprimerNouveauProduit(index, produit)" class="is-pulled-right button is-danger"> Supprimer </button>
                                      </div>
                                    </p>
                                  </div>
                                </div>
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
            <div class="field" v-if="this.commande.status_id != 8 && this.commande.status_id != 9">
              <div class="buttons has-addons is-centered" v-if="!visibiliteActioncommandeEnvoye">
                <button @click.prevent="enregistrer" class="button is-info" style="margin-right:2px" v-if="this.commande.status_id <= 5">Enregistrer</button>
                <button @click.prevent="envoyer" class="button is-success buttonCommande" v-show="enabledBtnEnvoyercommande">Envoyer</button>
                <button @click.prevent="demandePrixFournisseur" class="button is-success buttonCommande" v-if="enabledOffre" >Envoyer au fournisseur</button>
                <button @click.prevent="envoieClient" class="button is-success buttonCommande" v-if="enabledOffre">Envoyer au Client</button>
                <button @click.prevent="mailCommande" class="button is-success buttonCommande" :disabled="this.commande.status_id !=5" v-if="enabledOffre" >Valider Offre</button>
                <button @click.prevent="passerEtapeSuivante" class="button is-success buttonCommande" v-show="enabledBtnPasserEncours">Valider commande</button>
                <button @click.prevent="mailCommandeRecue" class="button is-success buttonCommande" :disabled="this.commande.status_id == 7" v-if="enabledCommande">Commande reçue</button>
                <button @click.prevent="passerEtapeSuivante" class="button is-success buttonCommande" :disabled="this.commande.status_id != 7" v-if="enabledCommande">Commande terminée</button>
                <button @click.prevent="abandonnerCommande" class="button is-danger buttonCommande" style="margin-left:2px" v-if="this.commande.id != '' ">Décommander</button>
                <button @click.prevent="backTo" class="button is-danger" style="margin-left:2px">Annuler</button>
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
                files: '',
                tva: "",
                total: '',
                
            }
        },

        created() {
            this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : window.location = '/#/login';
                    //console.log(this.user);
                })
            .catch(error => console.log(error));
            if (!this.$route.params.commande){
              //utilisateur courant
              axios.get('/'+this.$route.params.user)
                  .then(({data}) => this.currentUser = data);
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
          checkId() {
            return this.commande.status_id >= 6 && this.commande.status_id <= 8;
          },

          checkUserFile(){
            return this.commande.status_id > 1 && this.currentUser.employee == false;
          },

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
            this.total = Store.total();
            this.tva = Math.round((this.total*7.7)/100);
            console.log("tva"+this.tva);  
            var id = this.customer.id;
            var curUs = this.currentUser.id;
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
                    window.location.href='/#/listOrder/'+curUs;
              })
              .catch(function (error) {
                  console.log(error);
              });
            } else {
              //Nouveaux produits
              axios.post('/storeDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Enregistrer",commande: this.commande, company:this.company, customer:this.customer, products:this.produits_choisis})
                      .then(function (response) {
                        location.reload();
                        ////window.location.href='/#/commande/'+curUs+'/'+commandId;
                      });
              //Produits enregistres
              axios.post('/updateDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Update",commande: this.commande, company:this.company, customer:this.customer, products:this.produits_enregistres})
                    .then(function (response) {
                      location.reload();
                      ////window.location.href='/#/commande/'+curUs+'/'+commandId;
                    });
              self.storeFile();         
            }
          },

          backTo() {
            var id = this.currentUser.id;
            window.location.href='/#/listOrder/'+id;
          },

          abandonnerCommande() { 
            axios({
              method: 'put',
              url: '/abandonner/'+this.commande.id,
            })
            .then(function (response) {
                  console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
            var id = this.currentUser.id;
            window.location.href='/#/listOrder/'+id;
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

          supprimerNouveauProduit(index, produit) {
            this.produits_choisis.splice(index, 1);
            Store.ajoutProduitSupprime(produit);
          },

          miseAJourNouveauFournisseur(e, index) {
            var fournisseur = e.target.value;
            this.produits_choisis[index].fournisseurChoisi = fournisseur; //id,nom
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
            this.produits_choisis[index].prix = e.target.value;
          },

          miseAJourNouveauRemise(e, index) {
            this.produits_choisis[index].remisePourcent = e.target.value;
          },

          calculerNouveauPrix(txtRemisePourcent, quantite, prix, remise, remisePrix, index) { //checker si remise, prix, remise, gain, total
            //console.log("remisePourcent"+ txtRemisePourcent+" quantité "+quantite+" prix "+prix +" remise "+remise+" remisePrix "+remisePrix);
            var remiseCalcul = ((quantite*prix) * txtRemisePourcent)/100;
            //console.log(remiseCalcul);
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

          supprimerProduitEnregistre(produit, index) {
            var idProduit = this.produits_enregistres[index].id;
            console.log(idProduit);
            axios.delete('/supprimerProduit/'+idProduit+"/"+this.commande.id, {typeSubmit: "Envoyer",commande: this.commande, company:this.company, customer:this.customer})
              .then(function (response) {
                //location.reload();
                //window.location.href='/#/commande/'+id+'/'+commandId;
            });
            this.produits_enregistres.splice(index, 1);
            Store.ajoutProduitEnregistreSupprime(produit);
          },

          miseAJourFournisseurEnregistre(e, index) {
            this.produits_enregistres[index].fournisseurChoisi = e.target.value;
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
            //console.log("CHF"+e.target.value);
            this.produits_enregistres[index].prix = e.target.value;
          },

          miseAJourRemiseEnregistre(e, index) {
            //console.log("%"+e.target.value);
            this.produits_enregistres[index].remisePourcent = e.target.value;
          },

          calculerPrixEnregistre(txtRemisePourcent, quantite, prix, remise, remisePrix, index) { //checker si remise, prix, remise, gain, total
            //console.log("remisePourcent"+ txtRemisePourcent+" quantité "+quantite+" prix "+prix +" remise "+remise+" remisePrix "+remisePrix);
            var remiseCalcul = ((quantite*prix) * txtRemisePourcent)/100;
            var prixTotal = prix * quantite;
            this.produits_enregistres[index].remisePourcent = txtRemisePourcent;
            this.produits_enregistres[index].remisePrix = remiseCalcul;
            this.produits_enregistres[index].total = prixTotal-remiseCalcul;
          },
          //FIN METHODES POUR OFFRE

          envoyer() {
            this.total = Store.total();
            this.tva = Math.round((this.total*7.7)/100);
            var id = this.currentUser.id;
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
                    //console.log(response);
                    self.idCreated = response.data;
                    self.storeFile();
                    window.location.href='/#/listOrder/'+self.currentUser.id;
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

          passerEtapeSuivante() {
            var id = this.currentUser.id;
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
              Store.viderPanier();
            });
            var id = this.currentUser.id;
            if(this.commande.status_id < 4) {
              axios.post('/validerStatut/'+this.commande.id,{commande:this.commande})
                .then(function(response){
                  window.location.href='/#/listOrder/'+id;
              });
            }
            window.location.href='/#/listOrder/'+id;
            console.log('/#/listOrder/'+id);
          },

          mailCommande(){
            this.enregistrer();
            axios.post('/mailCommande/'+this.commande.id)
            .then(function(response){
              console.log('mail Envoyé');
            });
            var id = this.currentUser.id;
            axios.post('/validerStatut/'+this.commande.id,{commande:this.commande})
              .then(function(response){
                window.location.href='/#/listOrder/'+id;
            });
          },

          mailCommandeRecue() {
            axios.post('/mailCommandeRecue/'+this.customer.id+'/'+this.commande.id)
            .then(function(response){
              console.log('mail Envoyé');
            });
            var id = this.currentUser.id;
            if(this.commande.status_id < 7) {
              axios.post('/validerStatut/'+this.commande.id,{commande:this.commande})
                .then(function(response){
                  window.location.href='/#/listOrder/'+id;
              });
            }
          },

          envoieClient(){
            this.enregistrer();
            console.log(this.customer);
            axios({
                    method: 'post',
                    url: '/clientMailOffre/'+this.customer.id+'/'+this.commande.id,
                    data: {
                        total: this.total,
                        tva: this.tva,
                    }
            })
            //post('/clientMailOffre/'+this.customer.id+'/'+this.commande.id)
            .then(function(response){
              console.log('mail Envoyé');
              Store.viderPanier();
            });
            var id = this.currentUser.id;
            if(this.commande.status_id < 5) {
              axios.post('/validerClient/'+this.commande.id,{commande:this.commande})
                .then(function(response){
                  window.location.href='/#/listOrder/'+id;
              });
            }
            window.location.href='/#/listOrder/'+id;
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
            if (this.commande.status_id >= 3) {
              return true;
            }
            return false;
          },

          disabledInput(){
            if(this.commande.status_id < 2){
              return false;
            } else {
              return true;
            }
          },

          disabledClient(){
            if(this.currentUser.employee == false){
              return false;
            } else {
              return true;
            }
          },
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
        <div>
          <h3 class="subtitle is-3">Rechercher :</h3>
          <input id="textFiltre" type="text" v-on:keyup="miseAJourFiltre($event)">
          <button class="is-light marginCatalog" @click="reinit()">Réinitialiser</button>
        </div>
          <hr/>
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
        produits: '',
        produitsFixe: ''
      }
    },

    created() {
        //Liste des listeProduits
        axios.get('/produitsOffre')
          .then(response => {
            this.produits = response.data;
            this.produitsFixe = response.data; //Liste complète des produits
            Store.listeProduits(this.produits)
          });
    },

    methods: {
      ajoutProduit(produit, reference) {
        axios.get('/fournisseurList/'+produit.id)
          .then(response => {
            this.fournisseurs = response.data;
            Store.ajoutPanier(produit, reference, this.fournisseurs)
          });
      },

      reinit() {
          $("#textFiltre").val(""); 
          this.produits = this.produitsFixe;
          Store.listeProduits(this.produits);
          console.log(this.produits);
      },

      miseAJourFiltre(e) {
        var filtre2 = e.target.value;
        var filtre = filtre2.toLowerCase();
        var listeTempo = this.produits.filter(function(item) {
          var nom = item.nom.toLowerCase();
          var reference = item.reference.toLowerCase();
          var categorie = item.categorie.toLowerCase();
          var description = item.description.toLowerCase();
          var refSupplier = item.refSupplier.toLowerCase();
            if (nom.match(filtre)) {
              return true;
            } else if (reference.match(filtre)) {
              return true;
            } else if (categorie.match(filtre)) {
              return true;
            } else if (description.match(filtre)) {
              return true;
            } else if (refSupplier.match(filtre)) {
              return true; 
            } 
        });
        this.produits = listeTempo;
      }

    }
  })

</script>
