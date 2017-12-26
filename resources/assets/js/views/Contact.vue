<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">The Contact Page</div>
                    <div v-for="customer in customers">
                        <div class="panel-body">
                            <div>
                                {{customer.prenom}} {{customer.nom}} {{customer.login}}
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
                customers: []
            }
        },

        created() {
            axios.get('/customers')
                .then(({data}) => this.customers = data);
        }
    }
</script>
