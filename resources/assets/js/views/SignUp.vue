<template>
      <div class="container">
        <div style="padding-top:40px" class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <div class="has-text-centered">
              <h3 class="title has-text-grey">Create your personal account</h3>
              <br/>
            </div>
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Name</label>
                    <div class="control">
                      <input type="text" name="username" id="username" class="input" value="" v-model="username">
                    </div>
                  </div>
                  <div class="column">
                    <label class="label">Forename</label>
                    <div class="control has-icons-left has-icons-right">
                      <input type="text" name="forename" id="forename" class="input" value="" v-model="forename">
                    </div>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Address</label>
                <div class="control">
                  <input type="text" name="address" id="address" class="input"  value="" v-model="address">
                </div>
              </div>
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Phone</label>
                    <input type="tel" name="phone" id="phone" class="input"  value="" v-model="phone">
                  </div>
                  <div class="column">
                    <label class="label">Skype Name</label>
                    <div class="control has-icons-left has-icons-right">
                      <input type="text" name="contact" id="contact" class="input"  value="" v-model="contact">
                    </div>
                  </div>
                </div>
              </div>
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input type="email" name="email" id="email" class="input"  value="" v-model="email">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Company</label>
                  <div class="control">
                    <input type="text" name="company" id="company" class="input"  value="" v-model="company">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Password</label>
                  <div class="control">
                    <input type="password" name="pwd" id="pwd" class="input"  value="" v-model="pwd">
                </div>
              </div>
              <p class="has-text-centered">
                <router-link to="/login"><a>Login</a></router-link>
              </p>
              <div class="column">
                <button class="button is-block is-info is-large is-fullwidth" v-on:click="save()">Save</button>
              </div>
          </div>
        </div>
      </div>
</template>

<script>

    export default {

        methods: {
          /** enregistrement dans la base de données du nouvel utilisateur si les champs obligatoires sont remplis
            (non obligatoire : Skype, company)
            pour le moment l'utilisateur est créé dans la bdd avec employé=>false + compnany id => null
          */
          save: function() {
            if (username.value =="" || forename.value=="" || address.value=="" || phone.value=="" || email.value=="" || pwd.value==""){
              window.alert("Merci de remplir tous les champs sauf company si vous en avez pas");
            }else{
              axios.post('/saveUser', {name: username.value, forename: forename.value, address: address.value, phone: phone.value, skype: contact.value, email: email.value, company: company.value, pwd: pwd.value})
                  .then(response=>{
                  //  console.log('saved successfully' + " name : " +  username.value + " pre: " + forename.value + " phone: " + phone.value + " Skype: " + contact.value + " address: " + address.value +" email: " + email.value + " pwd: " + pwd.value);
                    console.log(response);
                    window.alert("Votre compte a bien été créé !");
                    this.$router.push('login');
                  })
                  .catch(function (error) {console.log(error);});
            }
          }
      }
    }
</script>
