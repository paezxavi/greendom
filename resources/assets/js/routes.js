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
        component: require('./views/TableauDeBord')

    },
    {

        path:'/devis/:user/:commande',
        component: require('./views/Devis')

    },
    {

        path:'/devis/:user',
        component: require('./views/Devis')

    },
];

export default new VueRouter({

    /*hashbang: false,

    mode:'history',*/

    routes,

    linkActiveClass: 'is-active'

});
