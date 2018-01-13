import VueRouter from 'vue-router';

let routes = [
    {

        path:'/',
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
    /*
      C'est ici qu'il faut rajouter la nouvelle page pour le tableau de bord
    */
    {

        path:'/devis/:user/:commande',
        component: require('./views/Devis')

    },
];

export default new VueRouter({

    routes,

    linkActiveClass: 'is-active'

});
