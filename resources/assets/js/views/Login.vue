<template>
    <div>
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Login</h3>

                <p class="subtitle has-text-grey">Veuillez procéder au login.</p>
                <div class="box">
                    <form method="POST">
                        <div class="field">
                            <div class="control">
                            <input class="input is-large" type="email" placeholder="Email" autofocus="" v-model="currentLogger.email">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                            <input class="input is-large" type="password" placeholder="Mot de passe" v-model="currentLogger.mdp">
                            </div>
                        </div>
                        <div class="field">
                            <label class="checkbox">
                            <input type="checkbox">
                            Remember me
                            </label>
                        </div>
                        <hr>
                        <button @click.prevent="logger" class="button is-block is-info is-large is-fullwidth">Login</button>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="../">Sign Up</a> &nbsp;·&nbsp;
                    <a href="../">Forgot Password</a> &nbsp;·&nbsp;
                    <a href="../">Need Help?</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>

    //import LoggedMixin from '/home/vagrant/greendom/resources/assets/js/views/LoggedMixin.js';

    export default {
        //mixins:[LoggedMixin],

        data() {
            return {
                currentLogger: {
                    email: "",
                    mdp: ""
                },
                user: false
            }
        },

        created() {
            this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : false;
                    console.log(this.user);
                })                    
            .catch(error => console.log(error));

        },

        methods: {
            logger() {
                axios.post('/login/'+this.currentLogger.email, {currentLogger:this.currentLogger})
                    .then(function (response) {
                        location.reload();
                        window.location = response.data.redirect;
                    });
            }
            
        }


    }
</script>
