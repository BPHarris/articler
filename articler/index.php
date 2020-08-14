<?php require_once("php/lib.php"); ?>

<!DOCTYPE html>

<?php require_once("common/head.php"); ?>
<?php require_once("common/articler-integration.php"); ?>

<body>
<div class="wrapper">
    
<?php require_once("common/header.php"); ?>

<main class="page-main">
<div class="editor-viewer-split">
    
<!-- Editor -->
<div class="editor">
    <div class="control-bar">
        <?php
        // left
        echo fa_icon_button(
            "alert('TODO');",
            "fas fa-minus"
        );
        echo fa_icon_button(
            null,
            "fas fa-font"
        );
        echo fa_icon_button(
            "alert('TODO');",
            "fas fa-plus"
        );

        // right
        echo fa_icon_button(
            "alert('TODO');",
            "fas fa-download fa-icon-right"
        );
        ?>
    </div>
    <div class="editor-body">
        <textarea></textarea>
    </div>
</div>

<!-- Viewer -->
<div class="viewer">
    <div class="control-bar">
        <?php
        // left
        echo fa_icon_button(
            "alert('Error: Override in JS.');",
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
        
        // right
        echo fa_icon_button(
            "alert('TODO');",
            "fas fa-download fa-icon-right"
        );
        ?>
    </div>
    <div class="viewer-body"></div>
</div>

</div>
</main>

<?php require_once("common/footer.php"); ?>

</div>
</body>

</html>
