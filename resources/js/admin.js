import './bootstrap';
import Vue from 'vue'
import VueRouter from 'vue-router'

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
import UserEdit from './admin/pages/UserEdit'
import Roles from './admin/pages/Roles'
import UsersTable from './admin/components/UsersTable'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin/users',
            name: 'users.index',
            component: UsersTable,
            props: {
                fetchUrl: "/admin/users",
                columns: ['username', 'type']
            }
        },
        {
            path: '/admin/users/:id/edit',
            name: 'users.edit',
            component: UserEdit
        },
        {
            path: '/admin/roles',
            name: 'user.roles',
            component: Roles,
        },
    ],
});

const admin = new Vue({
    el: '#admin',
    components: {
        Flash,
        Users
    },
    router
});
