import './bootstrap'
import AdminRoutes from './admin/AdminRoutes'
import Flash from './admin/components/Flash'
import Pages from './admin/modules/Pages.vue'
import Users from './admin/modules/Users.vue'

// Laravel's auth helper into a Vue instance  this.$auth
let authUser = (document.querySelector("meta[name='auth']").getAttribute('content'))
Vue.prototype.$auth = authUser ? JSON.parse(authUser) : '';

window.fetchData = function () {
    window.events.$emit('fetchData');
};

const admin = new Vue({
    el: '#admin',
    router: AdminRoutes,

    components: {
        Flash,
        Pages,
        Users
    },

    data() {
        return {
            // roles: window.Roles
        }
    }
});