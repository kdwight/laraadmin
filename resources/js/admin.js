import './bootstrap'
import AdminRoutes from './admin/AdminRoutes'
import Flash from './admin/components/Flash'
import Admin from './admin/Admin.vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

// Laravel's auth helper into a Vue instance  this.$auth
let authUser = (document.querySelector("meta[name='auth']").getAttribute('content'))
Vue.prototype.$auth = authUser ? JSON.parse(authUser) : '';

window.flash = function (message, level = "success") {
    window.events.$emit('flash', { message, level });
};

window.fetchData = function () {
    window.events.$emit('fetchData');
};

const admin = new Vue({
    el: '#admin',
    router: AdminRoutes,

    components: {
        Flash,
        Admin
    },

    data() {
        return {
            // roles: window.Roles
        }
    }
});

// == == == == == == == == == == == == == == == == == ==

// category's author dynamic field
const add_author = document.querySelector('#add_author');
const delete_option = document.querySelector('.delete-option');
$(document).on('click', '.delete-option', function (e) {
    e.preventDefault();
    $(this).parents(".form-group").remove();
});
const html = `
            <div class="form-group">
                <div class="d-flex justify-content-start">
                    <input type="text" name="author[]" placeholder="Author" class="form-control" maxlength="35">
                    &nbsp;
                    <button class="delete-option btn btn-danger"><span class="fas fa-minus"></span></button>
                </div>
            </div>
        `;
if (add_author) {
    add_author.addEventListener('click', function (e) {
        e.preventDefault();
        $("#addField").append(html);
    });
}