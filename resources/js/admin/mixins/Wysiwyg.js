export default {
    data() {
        return {
            plugins: [
                "link image hr anchor pagebreak",
                "searchreplace wordcount code fullscreen",
                "insertdatetime nonbreaking contextmenu",
                "paste textcolor colorpicker textpattern lists advlist"
            ],
            toolbars:
                "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code"
        };
    },

    methods: {
        file_browser_callback(field_name, url, type, win) {
            let x =
                window.innerWidth ||
                document.documentElement.clientWidth ||
                document.getElementsByTagName("body")[0].clientWidth;
            let y =
                window.innerHeight ||
                document.documentElement.clientHeight ||
                document.getElementsByTagName("body")[0].clientHeight;

            let cmsURL = "/laravel-filemanager?field_name=" + field_name;

            if (type == "image") {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            this.$refs.tinymce.editor.windowManager.open({
                file: cmsURL,
                title: "Filemanager",
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    }
};