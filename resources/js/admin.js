import './bootstrap'
import AdminRoutes from './admin/AdminRoutes'
import Flash from './admin/components/Flash'
import Users from './admin/modules/Users.vue'

// Larave's auth helper into a Vue instance  this.$auth
Vue.prototype.$auth = JSON.parse(document.querySelector("meta[name='auth']").getAttribute('content'));

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