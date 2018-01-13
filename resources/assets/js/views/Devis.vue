<template>
    <div>
        <!--<section class="hero is-success">
          <div class="hero-body">
            <div class="container">
              <h1 class="title">
                Devis
              </h1>
              <h2 class="subtitle">
                Mandant
              </h2>
            </div>
          </div>
        </section>-->
        <div style="padding-top:40px" class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <div class="field">
              <div class="columns is-mobile">
                <div class="column">
                  <label class="label">Name</label>
                  <div class="control">
                    <input class="input" type="text" placeholder="Text input" :value="nomString">
                  </div>
                </div>
                <div class="column">
                  <label class="label">Forename</label>
                  <div class="control has-icons-left has-icons-right">
                    <input class="input is-success" type="text" placeholder="Text input" :value="prenomString">
                    <span class="icon is-small is-left">
                      <i class="fas fa-user"></i>
                    </span>
                    <span class="icon is-small is-right">
                      <i class="fas fa-check"></i>
                    </span>
                  </div>
                  <p class="help is-success">This username is available</p>
                </div>
              </div>
            </div>

            <div class="field">
              <label class="label">Adresse</label>
              <div class="control">
                <input class="input" type="text" placeholder="Text input" :value="adresseString">
              </div>
            </div>


            <div class="field">
              <div class="columns is-mobile">
                <div class="column">
                  <label class="label">Email</label>
                  <div class="control has-icons-left has-icons-right">
                    <input class="input is-danger" type="email" placeholder="Email input" :value="emailString">
                    <span class="icon is-small is-left">
                      <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                  </div>
                  <p class="help is-danger">This email is invalid</p>
                </div>
                <div class="column">
                  <label class="label">Contact</label>
                  <div class="control">
                    <input class="input" type="text" placeholder="Text input" :value="contactString">
                  </div>
                </div>
              </div>
            </div>

            <div class="field">
              <div class="control">
                <label class="checkbox">
                  <input type="checkbox">
                  Concerne la société pour laquelle je travaille
                </label>
              </div>
            </div>

            <div class="field">
              <div class="file">
                <label class="file-label">
                  <input class="file-input" type="file" name="resume">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Choose a file…
                    </span>
                  </span>
                </label>
              </div>
            </div>

            <div class="field">
              <label class="label">Message</label>
              <div class="control">
                <textarea class="textarea" placeholder="Textarea" :value="descriptionString"></textarea>
              </div>
            </div>

            <div class="field">
              <div class="buttons has-addons is-centered">
                  <a class="button is-success" style="margin-right:2px">Submit</a>
                  <a class="button is-danger" style="margin-left:2px">Cancel</a>
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
                customer: [],
                commande: []
            }
        },

        mounted() {
            axios.get('/'+this.$route.params.user)
                .then(({data}) => this.customer = data);
            axios.get('/'+this.$route.params.user+'/'+this.$route.params.commande)
                .then(({data}) => this.commande = data);
        },

        computed:{
          descriptionString(){
            return `${this.commande.descriptionDevis}`
          },

          adresseString(){
            return `${this.customer.adresse}`
          },

          contactString(){
            return `${this.customer.contact}`
          },

          emailString(){
            return `${this.customer.email}`
          },

          nomString(){
            return `${this.customer.name}`
          },

          prenomString(){
            return `${this.customer.forename}`
          },

        }
    }
</script>
