/** base ast node */

export { AstNode };


/** */
class AstNode
{
    constructor() {}

    to_html()
    {
        return `<p>${this.to_string()}</p>`;
    }

    to_string()
    {
        return this.constructor.name;
    }
}
