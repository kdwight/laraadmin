import './bootstrap';
import router from './admin/routes'
import store from './admin/store/index'
import Vuetify from 'vuetify'

import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
Vue.component('admin', require('./admin/Admin.vue').default);

window.flash = function (message, color = "success") {
    window.events.$emit('flash', { message, color });
};

const admin = new Vue({
    el: '#admin',
    vuetify: new Vuetify(),
    router,
    store,

    data() {
        return {
            //
        }
    }
});
