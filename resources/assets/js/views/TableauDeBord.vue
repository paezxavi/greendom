<template>
    <div class="container">
        <h2 class="title is-2 has-text-centered">Tableau de bord</h2>
        <section>
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
                <template slot-scope="props" v-if="props.row.status.id == 1">
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
                <template slot="detail" slot-scope="props" v-if="props.row.status.id == 1">
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
                user: false,
            }
        },

        created() {
            this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : this.$router.push('/login');
                    if (!this.user.employee){
                        this.$router.push('/home');
                    }
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
