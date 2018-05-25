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
                      <input type="text" name="name" id="name" class="input" value="" v-model="provider.name">
                    </div>
                  </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Adresse*</label>
                <div class="control">
                  <input type="text" name="address" id="address" class="input"  value="" v-model="provider.address">
                </div>
              </div>
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Téléphone</label>
                    <input type="tel" name="phone" id="phone" class="input"  value="" v-model="provider.phone">
                  </div>
                  <div class="column">
                    <label class="label">Compte Skype</label>
                    <div class="control">
                      <input type="text" name="skype" id="skype" class="input"  value="" v-model="provider.skype">
                    </div>
                  </div>
                </div>
              </div>
                <div class="field">
                  <label class="label">Email*</label>
                  <div class="control">
                    <input type="email" name="email" id="email" class="input"  value="" v-model="provider.email">
                  </div>
                </div>
                <div class="field">
                  <label class="label">IBAN</label>
                  <div class="control">
                    <input type="text" name="iban" id="iban" class="input"  value="" v-model="provider.iban">
                  </div>
                </div>
                <div class="column">
                  <p class="has-text-grey">* champs obligatoires</p>
                </div>
                <div class="columns is-mobile">
                  <div class="column">
                    <button class="button is-block is-success is-large is-fullwidth" v-if="title=='Modification fournisseur'" v-on:click="updateProvider()">Valider</button>
                    <button class="button is-block is-success is-large is-fullwidth" v-else="title=='Nouveau fournisseur'" v-on:click="createProvider()">Créer</button>
                  </div>
                  <div class="column">
                    <button class="button is-block is-danger is-large is-fullwidth" v-on:click="cancel()">Annuler</button>
                  </div>
              </div>
              <div id="provider" v-model="provider"></div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>

    export default {

        data() {
            return {
                title: sessionStorage.getItem('title'),
                provider: {
                  id:"",
                  name: "",
                  address: "",
                  phone: "",
                  skype: "",
                  email: "",
                  iban: "",
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
            self.title = sessionStorage.getItem('title');
            if(self.title == 'Modification fournisseur'){
              self.provider.id = sessionStorage.getItem('idProv');
              axios.get('/provider/', {params: {id: self.provider.id}} )
                .then(response=>{self.provider = response.data;})
                .catch(function (error) {console.log(error);});
              sessionStorage.removeItem('idProv');
            }
        },
        /**
         *
         */
        methods: {
            updateProvider(){
              const self = this;
              if(self.provider.email.trim() != "" || self.provider.name.trim() != "" || self.provider.address.trim() != ""){
                if(self.provider.phone == null){self.provider.phone = "";}
                if (self.provider.skype == null){self.provider.skype = "";}
                if (self.provider.iban == null){self.provider.iban = "";}
                axios.put('/provider/', {id: self.provider.id,name: self.provider.name.trim(),address: self.provider.address.trim(),
                                         phone: self.provider.phone.trim(),skype: self.provider.skype.trim(),email: self.provider.email.trim(),
                                         iban: self.provider.iban.trim()})
                  .then(response=>{
                    if (response.status == 200){
                    alert("Le fournisseur a bien été modifié !");
                    self.$router.push('listProviders');
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
            createProvider(){
              const self = this;
              if (self.provider.name.trim() == "" || self.provider.address.trim() == "" || self.provider.email.trim() == ""){
                alert("Merci de remplir tous les champs obligatoires (*) !");
              }else{
                axios.post('/provider', {name: self.provider.name.trim(),address: self.provider.address.trim(),phone: self.provider.phone.trim(),
                                         skype: self.provider.skype.trim(),email: self.provider.email.trim(),iban: self.provider.iban.trim()})
                  .then(response=>{
                    if (response.status == 200){
                      alert("Le fournisseur a bien été créé !");
                      self.$router.push('listProviders');
                    }else{alert("Le système n\' a pas réussi à enregistrer le fournisseur. \r\nMerci de vérifier vos données et de cliquer sur valider.")}
                  })
                  .catch(function (error) {
                    console.log(error);
                    alert("Le système n\' a pas réussi à enregistrer le fournisseur. \r\nMerci de vérifier vos données et de cliquer sur valider.");
                  })
              }
            },

            /**
             * Redirige sur la page Liste fournisseur
             */
            cancel(){
              const self = this;
              self.$router.push('listProviders');
            }
        }
      }
</script>
