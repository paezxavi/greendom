<template>
    <div class="container">
        <h2 class="title is-2 has-text-centered">Panier</h2>
        <div v-if="panier.length > 0">
            <table class="panier" width="400px">
                <tr>
                    <th class="panier" width="50px"> Image </th>
                    <th class="panier" width="50px"> Produit </th>
                    <th class="panier" width="100px"> Description </th>
                    <th class="panier" width="50px"> Prix </th>
                    <th class="panier" width="100px"> Quantité </th>
                    <th class="panier" width="50px"> Total </th>
                    <th class="panier" width="10px"> </th>
                </tr>
                <tr v-for="(produit, index) in panier" :key="produit.id">
                    <td class="panier" ><img :src="produit.image" alt="Image"></td>
                    <td class="panier" >{{produit.nom}}s</td>
                    <td class="panier" >{{produit.description}}</td>
                    <td class="panier" >CHF {{produit.prix}}.-</td>
                    <td class="panier" >
                        <button class="button is-danger is-small" @click="diminueNouveauProduit(produit.quantite, index)"> - </button>
                        <label style="margin-left:1px; margin-right:1px">  {{produit.quantite}}  </label>
                        <button class="button is-info is-small" @click="augmenteNouveauProduit(produit.quantite, index)"> + </button></td>
                    <td class="panier" >{{ produit.quantite*produit.prix }}.- </td>
                    <td class="panier" >
                        <button class="button is-danger" @click="supprimerNouveauProduit(index)"> X </button>
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
            /*
            this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : console.log('');
                })                    
            .catch(error => console.log(error));

            //Company de l'utilisateur
            axios.get('/company/'+this.$route.params.user)
                  .then(({data}) => this.company = data);
            */
        },

        mounted() {
            
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
                /*
                    axios({
                        method: 'post',
                        url: '/insertDemande/'+this.user.id,
                        timeout: 8000, // Let's say you want to wait at least 8 seconds
                        data: {
                            typeSubmit: "Enregistrer",
                            commande: this.commande,
                            company: this.company,
                            customer: this.user
                        }
                    })
                    .then(function (response) {
                            console.log(response);
                            self.idCreated = response.data;
                            self.storeFile();
                            location.reload();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    //Nouveaux produits
                    axios.post('/storeDemande/'+this.customer.id+"/"+this.commande.id, {typeSubmit: "Enregistrer",commande: this.commande, company:this.company, customer:this.user, products:this.panier})
                        .then(function (response) {
                    });
                    */

            }
        }
    }
</script>