import './bootstrap'
import AdminRoutes from './admin/AdminRoutes'
import Flash from './admin/components/Flash'

const admin = new Vue({
    el: '#admin',
    router: AdminRoutes,

    components: {
        Flash
    },

    data() {
        return {
            //
        }
    }
});