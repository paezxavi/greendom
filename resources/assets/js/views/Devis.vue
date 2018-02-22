<template>
    <div>
        <div style="padding-top:40px" class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <form method="PUT" @submit.prevent="enregistrer">
              <h1 class="title">Devis N°{{ this.commande.num_devis }}</h1>

              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Nom</label>
                    <div class="control">
                      <input class="input" type="text" placeholder="Text input" v-model="customer.name">
                    </div>
                  </div>
                  <div class="column">
                    <label class="label">Prenom</label>
                    <div class="control has-icons-left has-icons-right">
                      <input class="input is-success" type="text" placeholder="Text input" v-model="customer.forename">
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
                  <input class="input" type="text" placeholder="Text input" v-model="customer.adresse">
                </div>
              </div>


              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                      <input class="input is-danger" type="email" placeholder="Email input" v-model="customer.email">
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
                      <input class="input" type="text" placeholder="Text input" v-model="customer.contact">
                    </div>
                  </div>
                </div>
              </div>

              <div class="field" v-if="customer.company_id != null">
                <div class="control">
                  <label class="checkbox">
                    <input type="checkbox" @click="active = !active">
                    Concerne la société pour laquelle je travaille
                  </label>
                </div>
              </div>

              <div class="field" v-show="active">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Société</label>
                    <div class="control">
                      <input class="input" type="text" placeholder="Text input" v-model="company.nom">
                    </div>
                  </div>
                  <div class="column">
                    <label class="label">Adresse</label>
                    <div class="control has-icons-left has-icons-right">
                      <input class="input is-success" type="text" placeholder="Text input" v-model="company.adresse">
                      <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                      </span>
                      <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                      </span>
                    </div>
                    <p class="help is-success">This username is available</p>
                  </div>
                  <div class="column">
                    <label class="label">Email</label>
                    <div class="control">
                      <input class="input" type="text" placeholder="Text input" v-model="company.email">
                    </div>
                  </div>
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
                        Choose a File…
                      </span>
                    </span>
                  </label>
                </div>
              </div>

              <div class="field">
                <label class="label">Message</label>
                <div class="control">
                  <textarea class="textarea" placeholder="Textarea" v-model="commande.descriptionDevis"></textarea>
                </div>
              </div>

              <div class="field">
                <div class="buttons has-addons is-centered">
                    <button type="submit" class="button is-success" style="margin-right:2px">Enregistrer</button>
                    <button class="button is-danger" style="margin-left:2px">Annuler</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</template>


<script>
    export default {

        data() {
            return {
                customer: "",
                commande: "",
                company: "",
                active : false
            }
        },

        created() {
            //user
            axios.get('/'+this.$route.params.user)
                .then(({data}) => this.customer = data);
            //commande
            axios.get('/'+this.$route.params.user+'/'+this.$route.params.commande)
                .then(({data}) => this.commande = data);
            //company
            axios.get('/company/'+this.$route.params.user)
                .then(({data}) => this.company = data);
            //pdf
            axios.get('/devis/pdf')
                .then(console.log(""));
        },

        methods:{
          //enregistrer modif devis
          enregistrer() {
            var id = this.customer.id;
            axios.put('/storeDevis/'+this.customer.id+"/"+this.commande.id, {commande: this.commande, company:this.company, customer:this.customer})
                    .then(function (response) {
                      window.location.href='#/devis/'+id;
                     })
                     .catch(function (error) {
                        if (error.response && error.response.status === 400) {
                            this.errors.setMessages(error.response.data.messages);
                        }
                     }.bind(this));
          }
        }
    }
</script>
