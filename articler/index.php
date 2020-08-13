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
    </head>

    <body>
<?
//https://webdesign.tutsplus.com/tutorials/how-to-build-a-full-screen-responsive-page-with-flexbox--cms-32086
?>
<script>
var text = `
@id = my-article
@note = the id muse be a valid html id
@title = Title of Article
@author = Me!
@date = Today
@note = does not insert today's date :(
@thumbnail = https://example.com/image.png
@thumbnailtext = This is the text to go on the thumbnail

<!-- allows html style comments (only after metadata) -->
the rest of the article
`;
var output;
</script>

<script type="module">
    import {to_html_debug} from "./core/articler.js";

    output = to_html_debug(text);
    console.log(output);
</script>


        <div class="wrapper">
            <header class="page-header">
                <div class="centred-banner">
                    <div class="centre">A R T I C L E R</div>
                </div>
            </header>
            
            <main class="page-main">
                <div class="editor-viewer-split">
                    <div class="editor">
                        EDITOR
                    </div>
                    <div class="viewer">
                        <script>
                            $(function () {$(".viewer").html(output);});
                        </script>
                    </div>
                </div>
            </main>
            
            <footer class="page-footer">
                <div class="centred-banner">
                    <div class="allow-middle-centre">
                        <div class="middle-centre">
                            &copy; Brandon Harris 2020
                        </div>
                    </div>
                    <div class="centre">
                        <?php
                            echo fa_icon_button(
                                "https://bpharris.uk",
                                "fas fa-2x fa-user");
                            echo fa_icon_button(
                                "https://github.com/bpharris/articler/",
                                "fab fa-2x fa-github-square");
                        ?>
                    </div>
                </div>
            </footer>
        </div>

    </body>

</html>