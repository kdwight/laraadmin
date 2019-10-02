window.Vue = require('vue');
window.VueRouter = require('vue-router').default;

Vue.use(VueRouter)

window.events = new Vue();
window.flash = function (message, level = "success") {
    window.events.$emit('flash', { message, level });
};

window.axios = require('axios');
// window.axios.defaults.baseURL = '/stagingURI';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
