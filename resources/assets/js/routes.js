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
    {
      path:'/compte',
      component: require('./views/Compte')
    },
    {

        path:'/listProviders',
        component: require('./views/ListeFournisseurs')

    },
    {

        path:'/providerInfo',
        component: require('./views/InfoFournisseur')

    },
    {

        path:'/listProducts',
        component: require('./views/ListeProduits')

    },
    {

        path:'/productInfo',
        component: require('./views/InfoProduit')

    },
    {

        path:'/listeCustomers',
        component: require('./views/ListeClients')

    },
    {

        path:'/newCustomer',
        component: require('./views/SignUp')

    },
    {

        path:'/customerInfo',
        component: require('./views/InfoClient')

    },
    {

        path:'/companyInfo',
        component: require('./views/InfoCompagnie')

    },
    {

        path:'/listCompanies',
        component: require('./views/ListeSociete')

    },
];

export default new VueRouter({

    /*hashbang: false,

    mode:'history',*/

    routes,

    linkActiveClass: 'is-active'

});
