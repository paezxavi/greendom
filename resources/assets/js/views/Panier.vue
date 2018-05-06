<template>
    <div class="container">
        <h2 class="title is-2 has-text-centered">Panier</h2>
        <div v-if="panier.length > 0">
            <table class="table is-narrow" >
                <tr>
                    <th class="panier"> Image </th>
                    <th class="panier"> Produit </th>
                    <th class="panier"> Description </th>
                    <th class="panier"> Prix </th>
                    <th class="panier"> Quantité </th>
                    <th class="panier"> Total </th>
                    <th class="panier"> </th>
                </tr>
                <tr v-for="(produit, index) in panier" :key="produit.id">
                    <td class="panier" ><img class="imagePanier" :src="produit.image" alt="Image"></td>
                    <td class="panier" >{{produit.nom}}</td>
                    <td class="panier" >{{produit.description}}</td>
                    <td class="panier" >CHF {{produit.prix}}.-</td>
                    <td class="panier" >
                        <button class="button is-danger is-small" @click="diminueNouveauProduit(produit.quantite, index)"> - </button>
                        <label style="margin-left:1px; margin-right:1px">  {{produit.quantite}}  </label>
                        <button class="button is-info is-small" @click="augmenteNouveauProduit(produit.quantite, index)"> + </button></td>
                    <td class="panier" >{{ produit.quantite*produit.prix }}.- </td>
                    <td class="panier" >
                        <a class="delete" @click="supprimerNouveauProduit(index)"> X </a>
                    </td>
                </tr>
            </table>
            <div>
                <div class="is-pulled-right">
                    <label> Total hors TVA : {{total}}</label> <br/>
                    <label> TVA au taux de 8%</label> <br/>
                    <strong> Total TVA comprise : {{total}} </strong>
                    <div>
                        <button class="button is-info" @click="validerPanier()"> Valider commande </button>
                    </div>
                </div>
                <div>
                    <br/><br/><br/> <!-- GROSSE MAGOUILLE -->
                    <button class="button is-danger is-pulled-left" @click="vider()"> Vider panier </button>
                </div>
            </div>

        </div>

        <h1 v-else> Panier est vide </h1>
        
 </div>
</template>

<script>
    import {StoreCatalogue} from './storeCatalogue'

    export default {
        data() {
            return {
                panier: StoreCatalogue.$data.panierCatalogue,
                total: StoreCatalogue.totalPanier(),
                company: "",
                user : '',
                commande: {
                  id: "",
                  concerne: "",
                  descriptionCommande: "",
                  status_id: ""
                }
            }
        },   

        created() {
           this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : "window.location = '/#/login'";
                    console.log(this.user);
                })
        },

        methods: {
            augmenteNouveauProduit(quantite, index) {
                this.panier[index].quantite = quantite+1;
                this.total = StoreCatalogue.totalPanier();
            },

            diminueNouveauProduit(quantite, index) {
                if (this.panier[index].quantite == 1) {
                    this.panier[index].quantite = quantite+0;
                } else {
                    this.panier[index].quantite = quantite-1;
                }
                this.total = StoreCatalogue.totalPanier();
            },

            supprimerNouveauProduit(index) {
                this.panier.splice(index, 1);
                this.total = StoreCatalogue.totalPanier();
            },

            vider() {
                console.log("vider");
                StoreCatalogue.viderPanier();
                this.panier = [];
            },

            validerPanier() {
                axios({
                method: 'post',
                url: '/emailPanier/' + this.user.id,
                data: {
                  panier: this.panier,
                  user: this.user,
                }
              })
              .then(function (response) {
                    console.log(response);
              })
            }
        }
    }
</script>