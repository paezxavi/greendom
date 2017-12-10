<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">The About Page</div>

                    <div v-for="commande in commandes">
                        <div class="panel-body">
                            <div>
                                {{commande.desc}} {{commande.statut}} {{commande.product_id}}
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
                commandes: []
            }
        },

        created() {
            axios.get('/commandes')
                .then(({data}) => this.commandes = data);
        }
    }
</script>
