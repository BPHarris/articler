/** articler error class and util functions */

export {
    ArticlerError,
    UnexpectedTokenError,
    UnrecognisedMetadataTagError,
};


/** */
class ArticlerError
{
    constructor(type, message, lineno)
    {
        this.type = type;
        this.message = message;
        this.lineno = lineno;
    }

    to_html()
    {
        var html =
`<div class="articler-article">
    <div class="articler-debug"></div>
    <div class="articler-error">
        <div class="type">${this.type}:${this.lineno}</div>
        <div class="message">${this.message}</div>
    </div>
</div>`;
        return html;
    }

    toString()
    {
        return `${this.type}: ${this.message}`;
    }
}


/** */
class UnrecognisedMetadataTagError extends ArticlerError
{
    constructor(allowed_tags, lineno)
    {
        super("UnrecognisedMetadataTagError", `expected one of ${allowed_tags}`, lineno);
    }
}


/** */
class UnexpectedTokenError extends ArticlerError
{
    constructor(expected, got, lineno)
    {
        super("UnexpectedTokenError", `expected ${expected} got ${got}`, lineno);
    }
}

