<template>
    <div class="container">
        <div class="page-inner">
            <div class="inner-content"> 
                <div data-v-1244b4c1="" class="columns">
                    <div class="column is-4" style="border:1.5px solid #D3D3D3!important;border-radius:16px">
                        <h1 class="title" style="text-align:center">Filtres</h1>
                        <h3 class="subtitle is-3">Prix max</h3>
                        <vue-slider v-model="valuePrix" v-bind="optionsPrix" @click.native="applyFilter()"></vue-slider>
                        <a class="button is-light" @click="reinitPrix()">Réinitialiser</a>
                        <h3 class="subtitle is-3">Watts max</h3>
                        <vue-slider v-model="valueWatts" v-bind="optionsWatts" @click.native="applyFilter()"></vue-slider>
                        <a class="button is-light" @click="reinitWatts()">Réinitialiser</a>
                        <br/>
                        <br/>
                        <a class="button is-light" @click="prixCroissant()">Trier par prix croissant</a>
                        <a class="button is-light" @click="prixDecroissant()">Trier par prix décroissant</a>
                        <a class="button is-light" @click="reinitProduit()">Réinitialiser liste</a>

                    </div>
                    <div class="column is-8" style="overflow-y: auto;height:600px">
                        <div class="columns is-multiline">
                            <div data-v-1244b4c1="" class="column is-4"  v-for="produit in this.produitsTrie">
                                <a data-v-1244b4c1="" target="_blank" class="opacityCatalogue"> <!--Il faudra mettre un href sur un produit-->
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

    export default {
        components: {
            vueSlider
        },
        data() {
            return {
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
            axios({
                method: 'get',
                url: '/produitsOffre',
                timeout: 8000, // Let's say you want to wait at least 8 seconds
              })
              .then(function (response) {
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
            applyFilter() {
                this.produitsTrie = [];
                this.produits.map( (p) => {
                    if((p.prixVente <= this.valuePrix) & (p.feature <= this.valueWatts)){
                        this.produitsTrie.push(p);
                    }
                })
            },

            getPrixMax() {
                let maxP = 0;
                this.produits.map( (p) => {
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
                this.produits.map( (p) => {
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

            reinitProduit(){
                this.produitsTrie = this.produits;
                function compare(a, b) {
                if (a.nom < b.nom)
                    return -1;
                if (a.nom > b.nom)
                    return 1;
                return 0;
                }

                return this.produitsTrie.sort(compare);
            }

        },
    }
</script>
