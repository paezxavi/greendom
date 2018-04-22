<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">A propos de nous</div>

                    <div v-for="commande in commandes">
                        <div class="panel-body">
                            <div>
                                {{commande.desc}} {{commande.statut}} {{commande.product_id}}
                            </div>
                        </div>
                    </div>
                    <div v-for="provider in providers">
                        <div class="panel-body">
                            <div>
                                {{provider.nom}} {{provider.adresse}} {{provider.iban}} {{provider.skype}} {{provider.email}}
                            </div>
                        </div>
                    </div>
                    <div v-for="customer in customers">
                        <div class="panel-body">
                            <div>
                                {{customer.name}} {{customer.email}} {{customer.contact}}
                            </div>
                        </div>
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
                commandes: [],
                providers: [],
                customers: []
            }
        },

        created() {
            axios.get('/commandes')
                .then(({data}) => this.commandes = data);
            axios.get('/providers')
                .then(({data}) => this.providers = data);
            axios.get('/customers')
                .then(({data}) => this.customers = data);
        }
    }
</script>
