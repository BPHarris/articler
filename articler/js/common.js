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
<!-- Cheats below -->
# Heading One
Sample Text
Even more sample text
![test](https://example.com/image.png)

# Another Heading
## With a subheading!
Lorem Ipsum

# A Heading Again
Where are we heading though?
`;

var code_mirror;

var show_debug = false;
var show_metadata = false;

// Units in px
var code_size        = 16;
const code_size_step = 1;
const min_code_size  = 10;
const max_code_size  = 26;


$(function () {
    // Get initial code font size (remove "px")
    code_size = Number($(".editor-body").css("font-size").slice(0, -2));

    // Set default article text
    $(".editor-body textarea").html(text);

    // Set code editor
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
            "tabSize": 4,
            "indentWithTabs": false,
            
            // line
            "lineWrapping": true,
            "lineNumbers": true,
            "viewportMargin": Infinity,

            "autofocus": true,

            // spelling/grammar
            "spellcheck": true,
            "autocorrect": true,
            "autocapitalize": true,
        }
    );

    // Load article HTML to viewer
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


const min = function(a, b) { return (a < b ? a : b); }
const max = function(a, b) { return (a > b ? a : b); }
const clamp = function(minimum, value, maximum) {
    return max(minimum, min(value, maximum));
}


/** */
function increase_editor_font_size() {
    console.log(code_size, code_size + code_size_step);
    code_size = clamp(
        min_code_size, code_size + code_size_step, max_code_size);
    console.log(code_size);
    $(".editor-body").css("font-size", `${code_size}px`);
}


/** */
function decrease_editor_font_size() {
    console.log(code_size);
    code_size = clamp(
        min_code_size, code_size - code_size_step, max_code_size);
    console.log(code_size);
    $(".editor-body").css("font-size", `${code_size}px`);
}
