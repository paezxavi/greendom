<template>
      <div class="container">
        <div class="columns is-mobile">
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
              <div id="companyId" v-model="companyId"></div>
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
            return {
                username: "",
                forename: "",
                address: "",
                phone: "",
                contact: "",
                email: "",
                company: "",
                pwd: "",
                companyId: ""
            }
        },

        methods: {
          /** Enregistrement dans la base de données du nouvel utilisateur si les champs obligatoires sont remplis (non obligatoire : Skype, company)
              Si le champs contact "représente un compte skype" est vide alors le user aura cette valeur à nulle.
              Sinon la valeur de cet attribut sera celle entrée dans le champs.
              Si le champs company "représente une société pour qui le user travaille" est vide alors le user aura cette valeur à nulle.
              Sinon appelle findCompanyId()
              Timeout 1 seconde pour que les requêtes axios de findCompanyId() et createCompany() aient terminées et que companyId est la bonne valeur à la création du user
              Enregistre le user dans la BDD avec ou sans id compagnie suivant les conditions ci-dessus (companie name != 0 ?)
              Si l'enregistrement s'est bien passé message au user et redirection sur page login
              Sinon message d'erreur au user demandant de vérifier les données et refaire valider
              Le user est créé dans la bdd avec employé = false, raison de sécurité, l'administrateur peut promouvoir un user en employé avec une ligne de commande
          */
          createUser() {
            const self = this;
            companyId.value = "";
            if (username.value.trim() =="" || forename.value.trim() =="" || address.value.trim() =="" || phone.value.trim() =="" || email.value.trim() =="" || pwd.value.trim() ==""){
              alert("Merci de remplir tous les champs obligatoires (*) !");
            }else{
              if (company.value.trim().length > 0){self.findCompanyId();}
              setTimeout(function () {
                axios.post('/createUser', {name: username.value.trim(), forename: forename.value.trim(), address: address.value.trim(), phone: phone.value.trim(), skype: contact.value.trim(), email: email.value.trim(), companyId: companyId.value, pwd: pwd.value.trim()})
                  .then(response=>{
                    if (response.status == 200){
                      alert("Votre compte a bien été créé !");
                      self.$router.push('login');
                    }else{alert("Le système n\' a pas réussi à enregistrer votre compte. \r\nMerci de vérifier vos données et de cliquer sur valider.")}
                  })
                  .catch(function (error) {
                    console.log(error);
                    alert("Le système n\' a pas réussi à enregistrer votre compte. \r\nMerci de vérifier vos données et de cliquer sur valider.");
                  });
                }, 2000);
            }
          },
          /** Trouve l'id de la compagnie qui a pour nom "company.value"
              Si elle existe l'id est récupéré dans companyId.value
              Sinon appelle createCompany()
          */
          findCompanyId(){
            company.value = company.value.trim();
            axios.get('/findCompanyId/', {params: {name: this.company}})
              .then(response=>{
                if (response.data.length > 0) {
                  companyId.value = response.data[0].id;
                }else{this.createCompany();}
              })
              .catch(function (error) {console.log(error);}
            );
          },
          /** Enregistrement dans la base de données de la nouvelle compagnie dont le nom est passé en paramètre de la requête axios "company.value"
              Attributs de la Company : address + email = null
          */
          createCompany(){
            axios.post('/createCompany', {name: company.value})
              .then(response=>{
                if (response.status == 200){companyId.value = response.data;}
              })
              .catch(function (error) {console.log(error);});
          }
    }
  }
</script>
