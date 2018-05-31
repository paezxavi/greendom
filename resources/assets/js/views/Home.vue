<template>
    <div class="container">

        <div id="popUp" style="display: none; font-size:20px;"  class="popup">
            <div id="textPopup" class="textPopup">
                Produit ajouté au panier
            </div>
        </div>

        <div class="page-inner">
            <div class="inner-content"> 
                <div data-v-1244b4c1="" class="columns">
                    <div class="column is-3 filter">
                        <h1 class="title" style="text-align:center">Filtres</h1>
                        <br/>
                        <h3 class="subtitle is-3">Rechercher :</h3>
                        <input id="textFiltre" type="text" v-on:keyup="miseAJourFiltre($event)">
                        <hr/>
                        <h3 class="subtitle is-3">Prix max</h3>
                        <vue-slider v-model="valuePrix" v-bind="optionsPrix" @click.native="applyFilter()"></vue-slider>
                        <a class="button is-light marginCatalog" @click="reinitPrix()">Réinitialiser</a>
                        <hr/>
                        <h3 class="subtitle is-3">Watts max</h3>
                        <vue-slider v-model="valueWatts" v-bind="optionsWatts" @click.native="applyFilter()"></vue-slider>
                        <a class="button is-light marginCatalog" @click="reinitWatts()">Réinitialiser</a>
                        <br/>
                        <hr/>
                        <a class="button is-light marginCatalog" @click="prixCroissant()">Trier par prix croissant</a>
                        <a class="button is-light marginCatalog" @click="prixDecroissant()">Trier par prix décroissant</a>
                        <hr/>
                        <a class="button is-light marginCatalog" @click="reinitProduit()">Réinitialiser liste</a>
                    </div>
                    <div class="column is-9 catalogSize">
                        <div class="spinner" v-if="showSpinner">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                        <div class="columns is-multiline">
                            <div data-v-1244b4c1="" class="column is-4" v-for="(produit, index) in this.produitsTrie" style="width:25%">
                                <modalProduit v-show="showModal" @close="showModal = false"></modalProduit>
                                <a @click="afficherProduit(index);showModal = true" data-v-1244b4c1="" target="_blank" class="opacityCatalogue">
                                    <article data-v-1244b4c1="" class="message" :class="color[0]"> <!-- :class="color[Math.floor(Math.random() * color.length)]">-->
                                        <div data-v-1244b4c1="" class="message-header has-text-centered">
                                            <h1 data-v-1244b4c1="" class="is-3 title has-text-centered">{{produit.nom}}</h1>
                                            <div>
                                            <img data-v-1244b4c1="" v-bind:src="produit.image" class="is-circle">
                                            </div>
                                        </div>
                                        <div data-v-1244b4c1="" class="message-body">
                                            <nav data-v-1244b4c1="" style="width:100%;" class="level">
                                                <div data-v-1244b4c1="" class="level-item has-text-centered">
                                                    <p data-v-1244b4c1="" class="head" style="font-size:20px"><i class="fas fa-dollar-sign"></i></p>
                                                    <p data-v-1244b4c1="" class="title" style="font-size:20px">{{produit.prixVente}}</p>
                                                </div>
                                                <div data-v-1244b4c1="" class="level-item has-text-centered">
                                                    <p data-v-1244b4c1="" class="head" style="font-size:20px"><i class="fas fa-bolt"></i></p>
                                                    <p data-v-1244b4c1="" class="title" style="font-size:20px">{{produit.feature}} Ws</p>
                                                </div>
                                            </nav>
                                        </div>
                                    </article>
                                </a>
                                <div data-v-1244b4c1="" class="message-footer has-text-centered" :class="color[0]">
                                    <button class="button is-success is-centered" style="width:-webkit-fill-available" @click="ajoutPanier(produit, index)">Ajouter au panier</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vueSlider from 'vue-slider-component';
    import {StoreCatalogue} from './storeCatalogue'

    export default {
        components: {
            vueSlider
        },
        data() {
            return {
                filterText: "",
                filterList: [],
                showSpinner:true,
                showModal: false,
                currentUser: false,
                user: '',
                valuePrix:0,
                produits: [],
                produitsTrie: [],
                maxPrixCat: 0,
                optionsPrix:{
                    max: 100,
                    width: "100%",
                    tooltip: false,
                    disabled: false,
                    piecewise: true,
                    piecewiseLabel: true,
                    interval: 50,
                    piecewiseStyle: {
                    "backgroundColor": "#ccc",
                    "visibility": "visible",
                    "width": "12px",
                    "height": "12px"
                    },
                    piecewiseActiveStyle: {
                    "backgroundColor": "#3498db"
                    },
                    labelActiveStyle: {
                    "color": "#3498db"
                    },
                },
                valueWatts: 0,
                maxWattsCat: 0,
                optionsWatts:{
                    max: 100,
                    width: "100%",
                    tooltip: false,
                    disabled: false,
                    piecewise: true,
                    piecewiseLabel: true,
                    interval: 50,
                    piecewiseStyle: {
                    "backgroundColor": "#ccc",
                    "visibility": "visible",
                    "width": "12px",
                    "height": "12px"
                    },
                    piecewiseActiveStyle: {
                    "backgroundColor": "#3498db"
                    },
                    labelActiveStyle: {
                    "color": "#3498db"
                    },
                },
                color: ['is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger']

            }
        },

        created() {
            let self = this;
            this.checkIfLogged()
            .then(response => {
                    console.log(this.user);
                    this.user = response ? this.currentUser=true : this.currentUser = false;
                    ;
                })
            .catch(error => console.log(error));
            axios({
                method: 'get',
                url: '/produitsOffre',
                timeout: 8000, // Let's say you want to wait at least 8 seconds
              })
              .then(function (response) {
                    self.showSpinner = false;
                    self.loader = "";
                    self.produits = response.data;
                    self.produitsTrie = response.data;
                    self.getPrixMax();
                    self.getWattsMax();
              })
              .catch(function (error) {
                  console.log(error);
              });
        },

        methods: {
            ajoutPanier(produit, index) {
                if (this.currentUser) {
                    StoreCatalogue.ajoutPanierCatalogue(produit);
                    //Popup apparaît et disparaît
                    $("#popUp").show(); 
                    setTimeout(function() {
                        $("#popUp").hide();
                    }, 500);

                } else {
                    window.location = '/#/login';
                }
            },

            pasConnecte() {
                if (this.currentUser==false) {
                    return false;
                }
                return true;
            },

            afficherProduit(index) {
                var produit = this.produits[index];
                StoreCatalogue.produitAffiche(produit);
            },

            applyFilter() {
                this.produitsTrie = [];
                this.produits.map( (p) => {
                    if((p.prixVente <= this.valuePrix) & (p.feature <= this.valueWatts)){
                        this.produitsTrie.push(p);
                    }
                })
                if (this.filterText != "") {
                    console.log(this.filterText);
                    var filtre = this.filterText;
                    this.filterList = this.produitsTrie.filter(function(item) {
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
                    this.produitsTrie = this.filterList;
                }
            },

            getPrixMax() {
                let maxP = 0;
                this.produits.map((p) => {
                    if(p.prixVente > maxP){
                        maxP = p.prixVente;
                    }
                })
                this.maxPrixCat = maxP;
                this.optionsPrix.max = maxP;
                this.valuePrix = maxP;
            },

            reinitPrix() {
                this.valuePrix = this.maxPrixCat;
                this.applyFilter();
            },

            getWattsMax() {
                let maxW = 0;
                this.produits.map((p) => {
                    if(p.feature > maxW){
                        maxW = p.feature;
                    }
                })
                this.maxWattsCat = maxW;
                this.optionsWatts.max = maxW;
                this.valueWatts = maxW;
            },

            reinitWatts() {
                this.valueWatts = this.maxWattsCat;
                this.applyFilter();
            },

            prixCroissant() {
                function compare(a, b) {
                    if (a.prixVente < b.prixVente)
                        return -1;
                    if (a.prixVente > b.prixVente)
                        return 1;
                    return 0;
                }
                return this.produitsTrie.sort(compare);
            },

            prixDecroissant() {
                function compare(a, b) {
                    if (a.prixVente > b.prixVente)
                        return -1;
                    if (a.prixVente < b.prixVente)
                        return 1;
                    return 0;
                }
                return this.produitsTrie.sort(compare);
            },

            reinitProduit() {
                this.produitsTrie = this.produits;
                function compare(a, b) {
                    if (a.nom < b.nom)
                        return -1;
                    if (a.nom > b.nom)
                        return 1;
                    return 0;
                }
                $('#textFiltre').val("");
            },
            
            miseAJourFiltre(e) {
                var filtre = e.target.value;
                this.filterText = filtre.toLowerCase();
                this.applyFilter();         
            },
            
        },
    }
    
    /*Fenêtre composant
    Vue.component('modal', {
      template: '#modal-template'
    })
    */
    Vue.component('modalProduit', {
    template:
    `
    <div id="modal-ter" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Produit</p>
          <button class="delete" aria-label="close" @click="$emit('close')"></button>
        </header>
        <section class="modal-card-body">
          <div class="box">
            <article class="media"  v-for="(produit, index) in produits">
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
                    <button class="button is-info" @click="ajoutPanier(produit, index)"> Ajouter au panier </button>
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
        produits: StoreCatalogue.$data.produitCourant,
      }
    },

    created() {
        console.log(this.produitSelectionne);
    },

    methods: {
        ajoutPanier(produit, index) {
            console.log(produit);
            var produit = this.produits[index];
            StoreCatalogue.ajoutPanierCatalogue(produit);
        },
    }

  })
</script>
