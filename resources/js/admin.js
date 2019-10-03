import './bootstrap'
import AdminRoutes from './admin/AdminRoutes'
import Flash from './admin/components/Flash'
import Users from './admin/modules/Users.vue'

// Laravel's auth helper into a Vue instance  this.$auth
let authUser = (document.querySelector("meta[name='auth']").getAttribute('content'))
Vue.prototype.$auth = authUser ? JSON.parse(authUser) : '';

const admin = new Vue({
    el: '#admin',
    router: AdminRoutes,

    components: {
        Flash,
        Users
    },

    data() {
        return {
            //
        }
    }
});