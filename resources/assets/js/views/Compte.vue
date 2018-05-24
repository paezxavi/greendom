<template>
      <div class="container">
        <div class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <div class="has-text-centered">
              <h3 class="title has-text-grey">Mes informations</h3>
              <br/>
            </div>
            <div class="box">
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Nom</label>
                    <div class="control">
                      <input type="text" name="username" id="username" class="input" value="" v-model="username" v-on:keyup="miseAJourNom($event)">
                    </div>
                  </div>
                  <div class="column">
                    <label class="label">Prénom</label>
                    <div class="control">
                      <input type="text" name="forename" id="forename" class="input" value="" v-model="forename" v-on:keyup="miseAJourPrenom($event)">
                    </div>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Adresse</label>
                <div class="control">
                  <input type="text" name="address" id="address" class="input"  value="" v-model="address" v-on:keyup="miseAJourAddresse($event)">
                </div>
              </div>
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Téléphone</label>
                    <input type="tel" name="phone" id="phone" class="input"  value="" v-model="phone" v-on:keyup="miseAJourPhone($event)">
                  </div>
                  <div class="column">
                    <label class="label">Compte Skype</label>
                    <div class="control">
                      <input type="text" name="contact" id="contact" class="input"  value="" v-model="contact" v-on:keyup="miseAJourContact($event)">
                    </div>
                  </div>
                </div>
              </div>
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input type="email" name="email" id="email" class="input"  value="" v-model="email" v-on:keyup="miseAJourEmail($event)">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Société</label>
                  <div class="control">
                    <input type="text" name="company" id="company" class="input"  value="" v-model="company" disabled>
                  </div>
                </div>
                <div class="field">
                  <label class="label">Nouveau mot de passe*</label>
                  <div class="control">
                    <input type="password" name="pwd" id="pwd" class="input"  value="" v-model="password" v-on:keyup="miseAJourPassword($event)">
                </div>
                <font color="red" v-show="showError">Les mots de passes sont différents !</font>
                </div>
                 <div class="field">
                  <label class="label">Entrez à nouveau le mot de passe*</label>
                  <div class="control">
                    <input type="password" name="pwd2" id="pwd2" class="input"  value="" v-model="password2" v-on:keyup="miseAJourPassword2($event)">
                </div>
                </div>
              </div>
              <div class="column">
                <button class="button is-block is-info is-large is-fullwidth" v-on:click="updateUser()">Mettre à jour</button>
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
                currentUser: "",
                userId: "",
                username: "",
                forename: "",
                address: "",
                phone: "",
                contact: "",
                email: "",
                company: "",
                password: "",
                password2: "",
                showError: false
            }
        },

        created() {
            this.checkIfLogged()
            .then(response => {
                    this.currentUser = response;
                    this.username = this.currentUser.name;
                    this.forename = this.currentUser.forename;
                    this.address = this.currentUser.address;
                    this.phone = this.currentUser.phone;
                    this.contact = this.currentUser.contact;
                    this.email = this.currentUser.email;
                    this.userId = this.currentUser.id;

                    //company
                    axios.get('/company/'+this.userId)
                        .then(response => {
                            this.company = response.data.nom;
                    });        

                })
            .catch(error => console.log(error));
         },

        methods: {

            miseAJourNom(e) {
                this.username = e.target.value;
            },

            miseAJourPrenom(e) {
                this.forename = e.target.value;
            },

            miseAJourAddresse(e) {
                this.address = e.target.value;
            },

            miseAJourPhone(e) {
                this.phone = e.target.value;
            },

            miseAJourContact(e) {
                this.contact = e.target.value;
            },

            miseAJourEmail(e) {
                this.email = e.target.value;
            },

            miseAJourPassword(e) {
                this.password = e.target.value;
            },

            miseAJourPassword2(e) {
                this.password2 = e.target.value;
            },

            updateUser() {
                if (this.password == this.password2) {
                    this.showError = false;
                    axios.post('/updateUser/'+this.userId, {username:this.username, forename:this.forename, address:this.address, phone:this.phone, contact:this.contact, email:this.email, password:this.password})
                    .then(function (response) {
                        //location.reload();
                        //window.location.href='/#/commande/'+id+'/'+commandId; NON
                    });
                    alert('Vos données ont été mises à jour.');
                    location.reload();
                } else {
                    this.showError = true;
                }
                      
            }
        }
  }
</script>
