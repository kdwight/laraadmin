import './bootstrap';
// import './NoPay';
import Vue from 'vue';

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);

window.events = new Vue();
window.flash = function (message) {
    window.events.$emit('flash', message);
};

Vue.component('topbar', require('./layouts/Topbar.vue').default);
Vue.component('sidebar', require('./layouts/Sidebar.vue').default);

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('page-form', require('./components/PageForm.vue').default);
Vue.component('page', require('./components/Page.vue').default);
Vue.component('change-password', require('./components/ChangePassword.vue').default);

const app = new Vue({
    el: '#app'
});
