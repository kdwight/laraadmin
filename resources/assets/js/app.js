import './bootstrap';
// import './NoPay';
import Vue from 'vue';

window.events = new Vue();
window.flash = function (message) {
    window.events.$emit('flash', message);
};

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('page-form', require('./components/PageForm.vue').default);

const app = new Vue({
    el: '#app'
});
