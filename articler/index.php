<?php require_once("php/lib.php"); ?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>articler</title>
        <meta name="description" content="Articler article creator.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Fonts -->
        <script src="https://kit.fontawesome.com/1bf9e36e13.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;300;400;500;600;700;800;900&display=swap"> 

        <!-- Style Sheets -->
        <link rel="stylesheet" href="style/reset.css">
        <link rel="stylesheet" href="style/style.css">

        <!-- Articler Theme -->
        <link rel="stylesheet" href="style/themes/articler.css">

        <!-- TODO: Favicons -->

        <!-- JavaScript -->
        <script src="js/jquery/jquery-3.5.1.min.js"></script>
        <script src="js/jquery/ui/jquery-ui.min.js"></script>
        <script src="js/common.js"></script>

        <!-- Code Mirror -->
        <script src="js/codemirror/lib/codemirror.js"></script>
        <link rel="stylesheet" href="js/codemirror/lib/codemirror.css">
        <script src="js/codemirror/mode/javascript/javascript.js"></script>

        <!-- Code Mirror Themes -->
        <link rel="stylesheet" href="js/codemirror/theme/nord.css">
        <link rel="stylesheet" href="js/codemirror/theme/material-darker.css">

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
                    $(".viewer-body").html(
                        to_html_debug(code_mirror.getValue()));
                    $(".articler-article").hide();
                    $(".articler-article").fadeIn();

                    if (show_debug) {
                        $(".articler-debug").hide();
                        $(".articler-debug").slideDown();
                    }
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
    </head>

    <body>

        <div class="wrapper">
            <header class="page-header">
                <div class="centred-banner">
                    <div class="centre">A R T I C L E R</div>
                </div>
            </header>
            
            <main class="page-main">
                <div class="editor-viewer-split">
                    <div class="editor">
                        <div class="control-bar">
                            <?php
                            echo fa_icon_button(
                                "",
                                "fas fa-download"
                            );
                            ?>
                        </div>
                        <div class="editor-body">
                            <textarea></textarea>
                        </div>
                    </div>
                    <div class="viewer">
                        <div class="control-bar">
                            <?php
                            // right
                            echo fa_icon_button(
                                "",
                                "fas fa-sync-alt",
                                "refresh-viewer"
                            );
                            echo fa_icon_button(
                                "toggle_show_debug()",
                                "fas fa-info-circle"     // far for empty
                            );
                            echo fa_icon_button(
                                "toggle_show_metadata()",
                                "fas fa-question-circle" // far for empty
                            );
                            
                            // left
                            echo fa_icon_button(
                                "",
                                "fas fa-download"
                            );
                            ?>
                        </div>
                        <div class="viewer-body"></div>
                    </div>
                </div>
            </main>
            
            <footer class="page-footer">
                &copy; Brandon Harris 2020
            </footer>
        </div>

    </body>

</html>