require('./bootstrap');

window.Vue = require('vue');

Vue.component('flash', require('./components/Flash.vue'));

const app = new Vue({
    el: '#app'
});
