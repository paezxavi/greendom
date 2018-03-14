<template>
    <div class="container">
      <h2 class="title is-2 has-text-centered">Tableau des commandes</h2>
      <section>
        <!--<b-field grouped group-multiline>
            <b-select v-model="defaultSortDirection">
              <option value="asc">Default sort direction: ASC</option>
              <option value="desc">Default sort direction: DESC</option>
            </b-select>
            <b-select v-model="perPage" :disabled="!isPaginated">
              <option value="5">5 per page</option>
              <option value="10">10 per page</option>
              <option value="15">15 per page</option>
              <option value="20">20 per page</option>
            </b-select>
            <div class="control">
              <button class="button" @click="currentPage = 2" :disabled="!isPaginated">Set page to 2</button>
            </div>
            <div class="control is-flex">
              <b-switch v-model="isPaginated">Paginated</b-switch>
            </div>
            <div class="control is-flex">
              <b-switch v-model="isPaginationSimple" :disabled="!isPaginated">Simple pagination</b-switch>
            </div>
        </b-field>-->
        <b-table
            :data="arrayCommande"
            :paginated="isPaginated"
            :per-page="perPage"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :default-sort-direction="defaultSortDirection"
            default-sort="dateDebut"
            detailed
            detail-key="id"
            @details-open="(row, index) => $toast.open(`Expanded ${row.users.name}`)">

            <template slot-scope="props">
                <b-table-column field="dateDebut" label="Date début" sortable>
                    {{ new Date(props.row.dateDebut).toLocaleDateString() }}
                </b-table-column>

                <b-table-column field="update_at" label="Dernière modification" sortable>
                    {{ props.row.update_at }}
                </b-table-column>

                <b-table-column v-if="currentUser.employee" field="nomClient" label="Nom du client" sortable>
                    {{ props.row.users.name }} {{ props.row.users.forename }}
                </b-table-column>

                <b-table-column field="concerne" label="Concerne" sortable>
                    {{ props.row.concerne }}
                </b-table-column>

                <b-table-column field="status.nom" label="Statut" sortable>
                    {{ props.row.status.nom }}
                </b-table-column>
            </template>
            <template slot="detail" slot-scope="props">
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>{{ props.row.users.name }} {{ props.row.users.forename }}</strong>
                            <br>
                            <small>@Concerne: {{ props.row.concerne }}</small>
                            <br>
                            {{ props.row.descriptionDevis }}
                        </p>
                    </div>
                </div>
            </article>
        </template>
        </b-table>
      </section>
    </div>
</template>


<script>
    import moment from 'moment';
    //import LoggedMixin from '/home/vagrant/greendom/resources/assets/js/views/LoggedMixin.js';
    
    export default {
        data() {
            return {
                arrayCommande: [],
                isPaginated: true,
                isPaginationSimple: false,
                defaultSortDirection: 'asc',
                currentPage: 1,
                perPage: 5,
                //defaultOpenedDetails: [1],
                currentUser: "",
                user: false
            }
        },
        
        //mixins:[LoggedMixin],


        created() {
            this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : window.location = '/#/login';
                    console.log(this.user);
                })                    
            .catch(error => console.log(error));
            axios.get('/'+this.$route.params.user)
                .then(({data}) => this.currentUser = data);
            axios.get('/commandeList/'+this.$route.params.user)
                .then(({data}) => this.arrayCommande = data);
        },


        methods: {
          dateDebutDevis(devis){
            return moment(devis.dateDebut).format('DD/MM/YYYY');
          }
        }
    }
</script>
