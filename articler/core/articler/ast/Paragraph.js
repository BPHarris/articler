/** Articler -- Paragraph AST node. */

import AstNode from "./AstNode.js";


/** */
export default class Paragraph extends AstNode
{
    constructor(text)
    {
        super();
        this.text = text;
    }

    to_html()
    {
        return `<p>${this.text}</p>`;
    }
}
