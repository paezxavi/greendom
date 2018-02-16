import VueRouter from 'vue-router';

let routes = [
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

        path:'/devis/:user',
        component: require('./views/TableauDeBord')

    },
    {

        path:'/devis/:user/:commande',
        component: require('./views/Devis')

    },
];

export default new VueRouter({

    routes,

    linkActiveClass: 'is-active'

});
