import './bootstrap'
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

window.events = new Vue();
window.flash = function (message, level = "success") {
    window.events.$emit('flash', { message, level });
};

import Flash from './admin/components/Flash'
import Status from './admin/components/Status'

const app = new Vue({
    el: '#admin',
    components: {
        Flash,
        Status
    }
});

// == == == == == == == == == == == == == == == == == ==

// delete button with confirmation
$(".confirmDelete").on("submit", function () {
    return confirm("Do you want to delete this item?");
});

// turns static table into datatable
$("#table").DataTable({
    language: {
        paginate: {
            next: '<i class="fas fa-angle-right"></i>',
            previous: '<i class="fas fa-angle-left"></i>'
        }
    },

    columnDefs: [{
        targets: [-1, -2],
        searchable: false,
        orderable: false
    }]
});

const userColumns = [
    { data: "username" },
    { data: "type" },
    { data: "status" },
    { data: "action" },
];

const activityColumns = [
    { data: "description" },
    { data: "created_at" },
];

$('#ajax-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: $('#ajax-table').data('url'),
        dataType: "json",
        type: "POST",
        data: { _token: window.token.content }
    },

    language: {
        loadingRecords: '&nbsp;',
        processing: '<img src="/img/preloader.svg">',
        paginate: {
            next: '<i class="fas fa-angle-right"></i>',
            previous: '<i class="fas fa-angle-left"></i>'
        }
    },

    columns: eval($('#ajax-table').data('headers')),

    aoColumnDefs: [
        {
            bSortable: false,
            aTargets: [1, -1]
        }
    ],
});

// copies title field input into slug field while typing and turns whitespaces to dash
const title_field = document.getElementById('title');
const slug_field = document.getElementById('slug');
function onchange() {
    slug_field.value = title_field.value.replace(/\s+/g, '-').toLowerCase();
}
if (title_field) {
    title_field.addEventListener('keyup', onchange);
}

// turns textarea into wysiwyg with laravel file manager
const editor_config = {
    path_absolute: "/",
    selector: ".description",
    plugins: ["advlist autolink lists link image charmap preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking contextmenu directionality",
        "paste textcolor colorpicker textpattern"],
    toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
    relative_urls: false,
    file_browser_callback: function (field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no"
        });
    }
};
tinymce.init(editor_config);