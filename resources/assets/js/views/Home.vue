<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Home Page</div>

                    <div v-for="product in products">
                        <div class="panel-body">
                            <div>
                                {{product.prixVente}} {{product.nom}}
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
                products: []
            }
        },

        created() {
            axios.get('/products')
                .then(({data}) => this.products = data);

        }
    }
</script>
