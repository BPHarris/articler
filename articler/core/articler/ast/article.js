/** Articler -- Article AST node. */

import AstNode from "./AstNode.js";


/** */
export default class Article extends AstNode
{
    constructor(metadata, article_body)
    {
        super();

        this.metadata = metadata;               // type: Metadata
        this.article_body = article_body;       // type: ArticleBody
    }

    to_html()
    {
        var html =
`<div class="articler-article" id="${this.metadata.get("id")}">
    <div class="articler-debug"></div>
    ${this.metadata.to_html()}
    <div class="articler-title">${this.metadata.get("title")}</div>
    ${this.article_body.to_html()}
</div>`;

        return html;
    }
}
