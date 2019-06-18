import './bootstrap';
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './admin/router';

Vue.use(VueRouter)

window.events = new Vue();

// flash message event
window.flash = function (message, level = "success") {
    window.events.$emit('flash', { message, level });
};
// reload table event
window.fetchData = function () {
    window.events.$emit('fetchData');
};

import Flash from './admin/components/Flash'
import Users from './admin/pages/Users'

const admin = new Vue({
    el: '#admin',
    components: {
        Flash,
        Users
    },

    router: new VueRouter(routes)
});
