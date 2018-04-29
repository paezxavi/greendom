<template>
    <div class="container">
        <div class="page-inner">
            <div class="inner-content"> 
                <div data-v-1244b4c1="" class="columns is-multiline">
                    <div data-v-1244b4c1="" class="column is-4"  v-for="produit in this.produits">
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
                                            <p data-v-1244b4c1="" class="title" style="font-size:20px">{{produit.reference}}</p>
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
</template>

<script>
    export default {
        data() {
            return {
                active: false,
                produits: "",
                color: ['is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger']

            }
        },

        created() {
            axios.get('/produitsOffre')
                  .then(({data}) => this.produits = data);
        },

        methods: {
        }
    }
</script>
