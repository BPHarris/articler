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

    $(".editor-body").fadeIn();
    code_mirror = CodeMirror.fromTextArea(
        $(".editor-body textarea").get(0),
        {
            // Theme                : Rating (/10)
            // ayu-dark             : 4
            // ayu-mirage           : 4
            // material-darker      : 7
            // material-ocean       : 2
            // material-palenight   : 5
            // material             : 9
            // nord                 : 9
            "theme": "nord",

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

    document.refresh_viewer();
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
