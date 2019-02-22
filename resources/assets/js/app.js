import './bootstrap';
// import './NoPay';
import Vue from 'vue';

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);

/* import Datatable from 'vue2-datatable-component'
Vue.use(Datatable); */

window.events = new Vue();
window.flash = function (message) {
    window.events.$emit('flash', message);
};

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('page-form', require('./components/PageForm.vue').default);
Vue.component('page', require('./components/Page.vue').default);

const app = new Vue({
    el: '#app'
});
