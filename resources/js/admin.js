import './bootstrap';

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

window.events = new Vue();

window.flash = function (message, level = "success") {
    window.events.$emit('flash', { message, level });
};

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
    }
});
