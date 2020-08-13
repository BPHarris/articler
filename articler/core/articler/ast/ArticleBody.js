/** article body ast node */

import { AstNode } from "./AstNode.js";


/** */
export class ArticleBody extends AstNode
{
    constructor(tmp)
    {
        super();

        this.tmp = tmp;
    }

    to_html()
    {
        return this.tmp;
    }
}
