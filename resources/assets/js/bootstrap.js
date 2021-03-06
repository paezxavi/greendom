import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import Buefy from 'buefy';
import 'buefy/lib/buefy.css';
import LoggedMixin from '/home/vagrant/greendom/resources/assets/js/views/LoggedMixin.js';
import VueGoodTable from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css';


window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(Buefy);
Vue.mixin(LoggedMixin);
Vue.use(VueGoodTable);

window.axios = axios;
window.axios.defaults.headers.common = {

    'X-Requested-With': 'XMLHttpRequest'

};

//C'est ici qu'on référence
