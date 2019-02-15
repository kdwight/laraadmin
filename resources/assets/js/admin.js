// delete button with confirmation
$(".confirmDelete").on("submit", function () {
    return confirm("Do you want to delete this item?");
});

// turns static table into datatable
$("#table").DataTable();

// turns datatable into sortable datatable
$("#tablecontents").sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function () {
        sendOrderToServer();
    }
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
    height: 400,
    plugins: [
        "link image hr anchor pagebreak",
        "searchreplace wordcount code fullscreen",
        "insertdatetime nonbreaking contextmenu",
        "paste textcolor colorpicker textpattern"
    ],
    toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
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