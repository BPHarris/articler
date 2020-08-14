/** Articler -- ArticleBody AST node. */

import AstNode from "./AstNode.js";


/** */
export default class ArticleBody extends AstNode
{
    constructor(statements)
    {
        super();
        this.statements = statements;
    }

    to_html()
    {
        return this.statements.join("\n    ");
    }
}
