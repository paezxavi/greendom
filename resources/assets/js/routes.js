import VueRouter from 'vue-router';

let routes = [
    {

        path:'/login',
        component: require('./views/Login')

    },
    {

        path:'/home',
        component: require('./views/Home')

    },
    {

        path:'/about',
        component: require('./views/About')

    },
    {

        path:'/contact',
        component: require('./views/Contact')

    },
    {

        path:'/listOrder/:user',
        component: require('./views/ListeCommandes')

    },
    {

        path:'/tableauDeBord/:user',
        component: require('./views/TableauDeBord')
    },
    {

        path:'/commande/:user/:commande',
        component: require('./views/Commande')

    },
    {

        path:'/commande/:user',
        component: require('./views/Commande')

    },
    //Page de welcome.. pas nécessaire mais ca tue le temps
    {

        path:'/bonjour/:user',
        component: require('./views/Bonjour')

    },
];

export default new VueRouter({

    /*hashbang: false,

    mode:'history',*/

    routes,

    linkActiveClass: 'is-active'

});
