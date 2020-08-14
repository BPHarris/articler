/** Articler -- Heading AST node. */

import AstNode from "./AstNode.js";


/** */
export default class Heading extends AstNode
{
    constructor(level, heading)
    {
        super();

        this.level = level;
        this.heading = heading;
    }

    to_html()
    {
        var hn = "h" + String(this.level);
        return `<${hn}>${this.heading}</${hn}>`;
    }
}
