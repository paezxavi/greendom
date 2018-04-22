<template>
    <div>
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Connexion</h3>

                <p class="subtitle has-text-grey">Identifiez-vous</p>
                <div class="box">
                    <form method="POST">
                        <div class="field">
                            <div class="control">
                              <label class="label">Email</label>
                            <input class="input is-large" type="email" placeholder="exemple@greendom.ch" autofocus="" v-model="currentLogger.email">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                              <label class="label">Mot de passe</label>
                            <input class="input is-large" type="password" placeholder="xxxxx" v-model="currentLogger.mdp">
                            </div>
                        </div>
                        <div class="field">
                            <label class="checkbox">
                            <input type="checkbox">
                            Se souvenir de moi
                            </label>
                        </div>
                        <hr>
                        <button @click.prevent="logger" class="button is-block is-info is-large is-fullwidth is-success">Se connecter</button>
                    </form>
                </div>
                <p class="has-text-grey">
                    <router-link to="/signUp"><a>S'inscrire</a></router-link>&nbsp;·&nbsp;
                    <a href="../">Mot de passe oublié</a> &nbsp;·&nbsp;
                    <a href="../">Besoin d'aide ?</a>
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
