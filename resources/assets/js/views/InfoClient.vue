<template>
      <div class="container">
        <div class="columns is-mobile">
          <div class="column is-three-fifths is-offset-one-fifth">
            <div class="has-text-centered">
              <h3 class="title has-text-grey">Modification client</h3>
              <br/>
            </div>
            <div class="box">
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Nom*</label>
                    <div class="control">
                      <input type="text" name="name" id="name" class="input" value="" v-model="customer.name">
                    </div>
                  </div>
                  <div class="column">
                    <label class="label">Prénom*</label>
                    <div class="control">
                      <input type="text" name="forename" id="address" class="forename"  value="" v-model="customer.forename">
                    </div>
                </div>
              </div>
              <div class="field">
                <label class="label">Adresse*</label>
                <div class="control">
                  <input type="text" name="address" id="address" class="input"  value="" v-model="customer.address">
                </div>
              </div>
              <div class="field">
                <div class="columns is-mobile">
                  <div class="column">
                    <label class="label">Téléphone*</label>
                    <input type="tel" name="phone" id="phone" class="input"  value="" v-model="customer.phone">
                  </div>
                  <div class="column">
                    <label class="label">Compte Skype</label>
                    <div class="control">
                      <input type="text" name="skype" id="skype" class="input"  value="" v-model="customer.contact">
                    </div>
                  </div>
                </div>
              </div>
                <div class="field">
                  <label class="label">Email*</label>
                  <div class="control">
                    <input type="email" name="email" id="email" class="input"  value="" v-model="customer.email">
                  </div>
                </div>
                <div class="column">
                  <p class="has-text-grey">* champs obligatoires</p>
                </div>
                <div class="columns is-mobile">
                  <div class="column">
                    <button class="button is-block is-success is-large is-fullwidth" v-on:click="updateCustomer()">Valider</button>
                  </div>
                  <div class="column">
                    <button class="button is-block is-danger is-large is-fullwidth" v-on:click="cancel()">Annuler</button>
                  </div>
              </div>
              <div id="customer" v-model="customer"></div>
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
                customer: {
                  id:"",
                  name: "",
                  forename: "",
                  address: "",
                  phone: "",
                  contact: "",
                  email: "",
                }
            }
        },
        /**
         * Fait une requête pour avoir les informations du user qui a pour id l'id passé en paramètre dans sessionStorage.getItem('idCU')
         * Charge la page avec les informations récupérées
         * Efface la variable 'idCu' de sessionStorage
         */
        created() {
            let self = this;
              self.customer.id = sessionStorage.getItem('idCu');
              axios.get('/customer/', {params: {id: self.customer.id}} )
                .then(response=>{self.customer = response.data;})
                .catch(function (error) {console.log(error);});
              sessionStorage.removeItem('idCu');
        },
        /**
         *
         */
        methods: {
            updateCustomer(){
              const self = this;
              if(self.customer.email.trim() != "" || self.customer.name.trim() != "" || self.customer.forename.trim() != ""
                  || self.customer.address.trim() != "" || elf.customer.phone.trim() != ""){
                if (self.customer.contact == null){self.customer.contact = "";}
                axios.put('/customer/', {id: self.customer.id,name: self.customer.name.trim(),forename: self.customer.forename.trim(),address: self.customer.address.trim(),
                                         phone: self.customer.phone.trim(),skype: self.customer.contact.trim(),email: self.customer.email.trim()})
                  .then(response=>{
                    if (response.status == 200){
                    alert("Le client a bien été modifié !");
                    self.$router.push('listeCustomers');
                  }else{alert("Le système n\' a pas réussi à enregistrer les modifications.");}
                  })
                  .catch(function (error) {
                    console.log(error);
                    {alert("Le système n\' a pas réussi à enregistrer les modifications.");}
                  })
              }else{alert("Merci de remplir tous les champs obligatoires (*) !");}
            },

            /**
             * Redirige sur la page Liste clients
             */
            cancel(){
              const self = this;
              self.$router.push('listeCustomers');
            }
        }
      }
</script>
