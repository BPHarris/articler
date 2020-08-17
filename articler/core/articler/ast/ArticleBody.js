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
        var statements_html = [], statement;

        for (statement of this.statements)
            statements_html.push(statement.to_html());

        return statements_html.join("\n");
    }
}
