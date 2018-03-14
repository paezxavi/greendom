<template>
    <div class="container">
        <div v-if="user">
            
            <transition name="slide-fade"> 
                <p style="font-size:10vw" class="test" v-if="show">
                    Bonjour Mr.{{ this.user.name }}
                </p>
            </transition>
        </div>
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
                show: true
            }
        },   

        created() {
            this.checkIfLogged()
            .then(response => {
                    this.user = response ? response : window.location = '/#/login';
            })                    
            .catch(error => console.log(error));
        },

        mounted() {
            var timer = 3;
            var inter = window.setInterval(() => {
                this.show = false;
                if (timer == 0){
                    clearInterval(inter);
                    this.$router.push('/tableauDeBord/'+this.$route.params.user);
                } else {
                    timer--;
                }
                console.log(timer);
            },1000);
        },
    }
</script>
