<?php require_once("php/lib.php"); ?>

<!DOCTYPE html>

<?php require_once("common/head.php"); ?>
<?php require_once("articler-core/articler-integration.html"); ?>

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
        echo "<span class=\"text-controls\">";
            echo fa_icon_button(
                "decrease_editor_font_size();",
                "fas fa-minus slim");
            echo fa_icon_button(
                null,
                "fas fa-font slim");
            echo fa_icon_button(
                "increase_editor_font_size();",
                "fas fa-plus slim");
        echo "</span>";

        // right
        echo fa_icon_button(
            "alert('TODO');",
            "fas fa-download fa-icon-right");
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
            "refresh-viewer");
        echo fa_icon_button(
            "toggle_show_debug()",
            "fas fa-info-circle");
        echo fa_icon_button(
            "toggle_show_metadata()",
            "fas fa-question-circle");
        
        // right
        echo fa_icon_button(
            "alert('TODO');",
            "fas fa-download fa-icon-right");
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
