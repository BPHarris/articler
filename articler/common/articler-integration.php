<!-- Interface to articler module -->
<script type="module">
    import {to_html_debug} from "./core/articler.js";

    // HACK: Allow refresh_viewer to be executed anywhere
    document.refresh_viewer = function () {
        // Fade out old HTML
        $(".articler-article").fadeOut();
        
        // Load new HTML and fade in
        // NOTE: delay by fadeout time * $(...).length
        // This will delay the fade in animation until the fade out is
        // done, but only if there was a fade out
        // $(...).length = 0 when no fade out, = 1 otherwise
        setTimeout(() => {
            var as_html = to_html_debug(code_mirror.getValue());
            console.log(as_html);
            
            $(".viewer-body").html(as_html);
            $(".articler-article").hide();
            $(".articler-article").fadeIn();

            // Refresh (and animate) debug display, if open
            if (show_debug) {
                $(".articler-debug").hide();
                $(".articler-debug").slideDown();
            }
            // Refresh (and animate) metatdata display, if open
            if (show_metadata) {
                $(".articler-metadata").hide();
                $(".articler-metadata").slideDown();
            }
        }, 500 * $(".articler-article").length);
    };

    $("#refresh-viewer").get(0).onclick = function () {
        document.refresh_viewer();
    }
</script>