window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
window.Vuex = require('vuex').default;
window.axios = require('axios');
window.events = new Vue();

Vue.use(VueRouter)
Vue.use(Vuex);

// window.axios.defaults.baseURL = '/susejparty';
window.axios.defaults.timeout = 300000; //miliseconds -> 5minutes
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
