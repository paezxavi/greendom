<template>
      <div class="container">
        <div style="padding-top:40px" class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <div class="has-text-centered">
              <h3 class="title has-text-grey">Créer votre espace client</h3>
              <br/>
            </div>
            <div class="box">
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Nom*</label>
                    <div class="control">
                      <input type="text" name="username" id="username" class="input" value="" v-model="username">
                    </div>
                  </div>
                  <div class="column">
                    <label class="label">Prénom*</label>
                    <div class="control">
                      <input type="text" name="forename" id="forename" class="input" value="" v-model="forename">
                    </div>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Adresse*</label>
                <div class="control">
                  <input type="text" name="address" id="address" class="input"  value="" v-model="address">
                </div>
              </div>
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Téléphone*</label>
                    <input type="tel" name="phone" id="phone" class="input"  value="" v-model="phone">
                  </div>
                  <div class="column">
                    <label class="label">Compte Skype</label>
                    <div class="control">
                      <input type="text" name="contact" id="contact" class="input"  value="" v-model="contact">
                    </div>
                  </div>
                </div>
              </div>
                <div class="field">
                  <label class="label">Email*</label>
                  <div class="control">
                    <input type="email" name="email" id="email" class="input"  value="" v-model="email">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Société</label>
                  <div class="control">
                    <input type="text" name="company" id="company" class="input"  value="" v-model="company">
                  </div>
                </div>
                <div class="field">
                  <label class="label">Mot de passe*</label>
                  <div class="control">
                    <input type="password" name="pwd" id="pwd" class="input"  value="" v-model="pwd">
                </div>
              </div>
              <div class="column">
                <p class="has-text-grey">* champs obligatoires</p>
              </div>
              <div class="column">
                <button class="button is-block is-info is-large is-fullwidth" v-on:click="createUser()">Valider</button>
              </div>
            </div>
              <p class="has-text-centered">
                <router-link to="/login"><a>Se connecter</a></router-link>
              </p>
          </div>
        </div>
      </div>
</template>

<script>

    export default {

        data() {
          companyId: ""
            return {
                username: "",
                forename: "",
                address: "",
                phone: "",
                contact: "",
                email: "",
                company: "",
                pwd: ""
            }
        },

        methods: {
          /** enregistrement dans la base de données du nouvel utilisateur si les champs obligatoires sont remplis (non obligatoire : Skype, company)
              Si le champs contact "représente un compte skype" est vide alors le user aura cette valeur à nulle.
              Sinon la valeur de cet attribut sera celle entrée dans le champs.
              Si le champs company "représente une société pour qui le user travaille" est vide alors le user aura cette valeur à nulle.
              Sinon
                Si la longeur du nom est < que 2 alors message au user
                Sinon
                  //findCompany :
                  Trouve l'id de la compagnie qui a pour nom "company.value"
                  Si elle existe l'id est récupéré dans companyId.value
                  Sinon //createCompany:
                  Enregistrement dans la base de données de la nouvelle compagnie dont le nom est passé en paramètre "company.value"
                  Pour le moment address + email = null
              Enregistre le user dans la BDD avec ou sans id compagnie suivant les conditions ci-dessus (companie name != 0 ?)
          !!!!!  pour le moment l'utilisateur est créé dans la bdd avec employé=>false !!!!!
          */
          createUser() {
            var compId = this.companyId;
            if (username.value.trim() =="" || forename.value.trim() =="" || address.value.trim() =="" || phone.value.trim() =="" || email.value.trim() =="" || pwd.value.trim() ==""){
              alert("Merci de remplir tous les champs obligatoires (*) !");
            }else{
              if (company.value.trim().length > 0){this.findCompanyId();}
              //timer attente axio findCompanyId + createCompany sî besoin
              console.log("comp avant timer : " + this.companyId);
              setTimeout(function () {
                console.log("comp avant create user : " + this.companyId);
                axios.post('/createUser', {name: username.value.trim(), forename: forename.value.trim(), address: address.value.trim(), phone: phone.value.trim(), skype: contact.value.trim(), email: email.value.trim(), companyId: compId, pwd: pwd.value.trim()})
                  .then(response=>{
                    if (response.status == 200){
                      alert("Votre compte a bien été créé !");
                      //this.$router.push('login');
                    }else{alert("Le système n\' a pas réussi à enregistrer votre compte. \r\n Merci de vérifier vos données et de cliquer sur valider.")}
                  })
                  .catch(function (error) {console.log(error);});
                  console.log("J'ai créé le user");
                }, 3000);
            }
          },
          findCompanyId(){
            console.log("find companyID");
            company.value = company.value.trim();
            console.log("company trim : " + company.value);
            axios.get('/findCompanyId/', {params: {name: this.company}})
              .then(response=>{
                if (response.data.length > 0) {
                  this.companyId = response.data[0].id;
                  //console.log("find OK - resp.data[0] : " + response.data[0].id);
                  console.log("comp après find : " + this.companyId);
                }else{this.createCompany();}
              })
              .catch(function (error) {console.log(error);}
            );
          },
          createCompany(){
            axios.post('/createCompany', {name: company.value})
              .then(response=>{
                if (response.status == 200){this.companyId = response.data;}
              })
              .catch(function (error) {console.log(error);});
              console.log("create compagny ok");
              console.log("comp après create comp : " +this.companyId);
          }
    }
  }
</script>
