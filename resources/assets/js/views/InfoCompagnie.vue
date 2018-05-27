<template>
      <div class="container">
        <div class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <div class="has-text-centered">
              <h3 class="title has-text-grey">{{title}}</h3>
              <br/>
            </div>
            <div class="box">
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Nom*</label>
                    <div class="control">
                      <input type="text" name="name" id="name" class="input" value="" v-model="company.name">
                    </div>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Adresse</label>
                <div class="control">
                  <input type="text" name="address" id="address" class="input"  value="" v-model="company.address">
                </div>
              </div>
                <div class="field">
                  <label class="label">Email</label>
                  <div class="control">
                    <input type="email" name="email" id="email" class="input"  value="" v-model="company.email">
                  </div>
                </div>
                <div class="column">
                  <p class="has-text-grey">* champs obligatoires</p>
                </div>
                <div class="columns is-mobile">
                  <div class="column">
                    <button class="button is-block is-success is-large is-fullwidth" v-if="title=='Modification société'" v-on:click="updateCompany()">Valider</button>
                    <button class="button is-block is-success is-large is-fullwidth" v-else="title=='Nouvelle société'" v-on:click="createCompany()">Créer</button>
                  </div>
                  <div class="column">
                    <button class="button is-block is-danger is-large is-fullwidth" v-on:click="cancel()">Annuler</button>
                  </div>
              </div>
              <div id="company" v-model="company"></div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>

    export default {

        data() {
            return {
                title: sessionStorage.getItem('titleComp'),
                company: {
                  id:"",
                  name: "",
                  address: "",
                  email: "",
                }
            }
        },
        /**
         * Fait une requête pour avoir les informations du fournisseur qui a pour id l'id passé en paramètre dans sessionStorage.getItem('idProv')
         * Charge la page avec les informations récupérées
         * Efface la variable 'idPov' de sessionStorage
         */
        created() {
            let self = this;
            if(self.title == 'Modification société'){
              self.company.id = sessionStorage.getItem('idComp');
              axios.get('/company/', {params: {id: self.company.id}} )
                .then(response=>{self.company = response.data;})
                .catch(function (error) {console.log(error);});
              sessionStorage.removeItem('idComp');
            }
        },
        /**
         *
         */
        methods: {
            updateCompany(){
              const self = this;
              if(self.company.name.trim() != ""){
                if(self.company.email == null){self.company.email = "";}
                if (self.company.address == null){self.company.address = "";}
                axios.put('/company/', {id: self.company.id,name: self.company.name.trim(),address: self.company.address.trim(),
                                         email: self.company.email.trim()})
                  .then(response=>{
                    if (response.status == 200){
                    alert("La société a bien été modifiée !");
                    self.$router.push('ListCompanies');
                  }else{alert("Le système n\' a pas réussi à enregistrer les modifications.");}
                  })
                  .catch(function (error) {
                    console.log(error);
                    {alert("Le système n\' a pas réussi à enregistrer les modifications.");}
                  })
              }else{alert("Merci de remplir tous les champs obligatoires (*) !");}
            },

            /**
             *
             */
            createCompany(){
              const self = this;
              if (self.company.name.trim() == ""){
                alert("Merci de remplir tous les champs obligatoires (*) !");
              }else{
                axios.post('/createCompany', {name: self.company.name.trim(),address: self.company.address.trim(),email: self.company.email.trim()})
                  .then(response=>{
                    if (response.status == 200){
                      alert("La société a bien été créée !");
                      self.$router.push('listCompanies');
                    }else{alert("Le système n\' a pas réussi à enregistrer la société. \r\nMerci de vérifier vos données et de cliquer sur valider.")}
                  })
                  .catch(function (error) {
                    console.log(error);
                    alert("Le système n\' a pas réussi à enregistrer  la société. \r\nMerci de vérifier vos données et de cliquer sur valider.");
                  })
              }
            },

            /**
             * Redirige sur la page Liste fournisseur
             */
            cancel(){
              const self = this;
              self.$router.push('listCompanies');
            }
        }
      }
</script>
