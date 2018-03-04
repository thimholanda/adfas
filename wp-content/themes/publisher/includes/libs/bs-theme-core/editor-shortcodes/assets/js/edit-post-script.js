jQuery(function ($) {
    var $document = jQuery(document);

    $document.on('tinymce-editor-init', function () {

        $document.on("change", ".affect-editor-on-change :input", function () {
            var input_match = this.name.match(/\[([^\]]+)\]$/);
            if (!input_match)
                return false;
            var input_name = input_match[ 1 ];

            jQuery("#content_ifr").contents().find("body").attr("data-" + input_name, this.value);
        }).find(".affect-editor-on-change")
                 .find(':checked,:selected')
                 .change();
    });
});