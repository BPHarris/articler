/** articler common js functions */

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

var code_mirror;

var show_debug = false;
var show_metadata = false;


$(function () {
    $(".editor-body textarea").html(text);

    code_mirror = CodeMirror.fromTextArea(
        $(".editor-body textarea").get(0),
        {
            "theme": "material-darker",

            // indents
            "indentUnit": 4,
            "smartIndent": true,
            "tabSize": 4,
            "indentWithTabs": false,
            
            // line
            "lineWrapping": true,
            "lineNumbers": true,

            "autofocus": true,

            // spelling/grammar
            "spellcheck": true,
            "autocorrect": true,
            "autocapitalize": true,
        }
    );
});


/**  */
function toggle_show_debug() {
    if (show_debug = !show_debug)
        return $(".articler-debug").slideDown();
    return $(".articler-debug").slideUp();
}


/**  */
function toggle_show_metadata() {
    if (show_metadata = !show_metadata)
        return $(".articler-metadata").slideDown();
    return $(".articler-metadata").slideUp();
}


// /** */
// function update_viewer() {
//     $(".viewer-body").html(to_html_debug(code_mirror.getValue()));
// }
