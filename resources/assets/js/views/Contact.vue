<template>
    <div class="contactStyle">
        <div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Votre nom</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="control is-expanded has-icons-left">
                            <input class="input" type="text" placeholder="Nom">
                            <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control is-expanded has-icons-left has-icons-right">
                            <input class="input is-success" type="email" placeholder="Email">
                            <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                            </span>
                            <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                            </span>
                        </p>
                    </div>
                </div>
                </div>

                <div class="field is-horizontal">
                <div class="field-label"></div>
                <div class="field-body">
                    <div class="field is-expanded">
                    <div class="field has-addons">
                        <p class="control">
                        <a class="button is-static">
                            +41
                        </a>
                        </p>
                        <p class="control is-expanded">
                        <input class="input" type="tel" placeholder="Votre numéro de téléphone">
                        </p>
                    </div>
                    <p class="help">N'entrez pas le premier zéro</p>
                    </div>
                </div>
                </div>

                <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Déjà membre?</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                    <div class="control">
                        <label class="radio">
                        <input type="radio" name="member">
                        Oui
                        </label>
                        <label class="radio">
                        <input type="radio" name="member">
                        Non
                        </label>
                    </div>
                    </div>
                </div>
                </div>

                <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Concerne</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="Objet">
                        </div>
                    </div>
                </div>
                </div>

                <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Question</label>
                </div>
                <div class="field-body">
                    <div class="field">
                    <div class="control">
                        <textarea class="textarea" placeholder="Expliquez nous comment vous aider"></textarea>
                    </div>
                    </div>
                </div>
                </div>

                <div class="field is-horizontal">
                <div class="field-label">
                    <!-- Left empty for spacing -->
                </div>
                <div class="field-body">
                    <div class="field">
                    <div class="control">
                        <button @click="envoyer" class="button is-primary">
                            Envoyer
                        </button>
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
                customer: []
            }
        },

        created() {
        },

        methods:{
            envoyer(){
                window.location.href='/#/home';
            }

        }
    }
</script>
