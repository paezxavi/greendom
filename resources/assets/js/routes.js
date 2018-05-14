import VueRouter from 'vue-router';

let routes = [
    {

        path:'/signUp',
        component: require('./views/SignUp')

    },
    {

        path:'/login',
        component: require('./views/Login')

    },
    {

        path:'/home',
        component: require('./views/Home')

    },
    /*{

        path:'/about',
        component: require('./views/About')

    },*/
    {

        path:'/contact',
        component: require('./views/Contact')

    },
    {

        path:'/listOrder/:user',
        component: require('./views/ListeCommandes')

    },
    /*{

        path:'/tableauDeBord/:user',
        component: require('./views/TableauDeBord')
    },*/
    {

        path:'/commande/:user/:commande',
        component: require('./views/Commande')

    },
    {

        path:'/commande/:user',
        component: require('./views/Commande')

    },
    {

        path:'/panier',
        component: require('./views/Panier')

    },
];

export default new VueRouter({

    /*hashbang: false,

    mode:'history',*/

    routes,

    linkActiveClass: 'is-active'

});
