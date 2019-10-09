var editor_id = "";

var dialogConfig = {
    title: 'Embed Instagram',

    body: {
        type: 'panel',
        items: [
            {
                type: 'input',
                name: 'instagram',
                label: 'enter embed code from instagram'
            }
        ]
    },

    buttons: [
        {
            type: 'cancel',
            name: 'closeButton',
            text: 'Cancel'
        },
        {
            type: 'submit',
            name: 'submitButton',
            text: 'Submit',
            primary: true
        }
    ],

    initialData: {
        instagram: '',
    },

    onSubmit: function (api) {
        var data = api.getData();

        var embedCode = data.instagram;
        var script = embedCode.match(/<script.*<\/script>/)[0];
        var scriptSrc = script.match(/".*\.js/)[0].split("\"")[1];

        // <script async defer src="//www.instagram.com/embed.js"></script>
        var sc = document.createElement("script");
        sc.setAttribute("src", scriptSrc);
        sc.setAttribute("type", "text/javascript");

        var iframe = document.getElementById(editor_id + "_ifr");
        var iframeHead = iframe.contentWindow.document.getElementsByTagName('head')[0];

        tinyMCE.activeEditor.insertContent(data.instagram);
        iframeHead.appendChild(sc);
        setTimeout(function () {
            iframe.contentWindow.instgrm.Embeds.process();
        }, 1000)

        api.close();
    }
};

export default {
    data() {
        return {
            plugins: [
                'advlist autolink anchor code codesample',
                'lists link imagesearchreplace visualblocks fullscreen',
                'insertdatetime media table paste  help wordcount',
                "hr pagebreak visualchars nonbreaking  textpattern",
                'fullpage importcss template toc imagetools noneditable quickbars'
            ],
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | fullscreen | insertfile image media template link anchor codesample code | instagram',
        };
    },

    methods: {
        tinymceInit() {
            return {
                plugins: this.plugins,
                toolbar: this.toolbar,
                menubar: true,
                image_advtab: true,
                toolbar_drawer: 'sliding',
                image_caption: true,

                setup: function (editor) {
                    editor.on('init', function (args) {
                        editor_id = args.target.id;
                    });

                    editor.ui.registry.addButton('instagram', {
                        text: 'Instagram',
                        onAction: function () {
                            editor.windowManager.open(dialogConfig)
                        }
                    });
                },

                file_picker_callback(callback, value, meta) {
                    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                    let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

                    tinymce.activeEditor.windowManager.openUrl({
                        url: '/file-manager/tinymce5',
                        title: 'Laravel File manager',
                        width: x * 0.8,
                        height: y * 0.8,
                        onMessage: (api, message) => {
                            callback(message.content, { text: message.text })
                        }
                    })
                }
            }
        },
    }
};