/** articler error class and util functions */

export {
    ArticlerError,
    UnrecognisedMetadataTagError,
    IllegalMetadataError,
    MetadataRepetitionError,
    UnexpectedTokenError,
    NewlineExpectedError,
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
class IllegalMetadataError extends ArticlerError
{
    constructor(tag, lineno)
    {
        super("IllegalMetadataError", `illegal data for tag "${tag}"`, lineno);
    }
}

/** */
class MetadataRepetitionError extends ArticlerError
{
    constructor(tag, lineno)
    {
        super("MetadataRepetitionError", `metadata for "${tag}" is already set`, lineno);
    }
}


/** */
class UnexpectedTokenError extends ArticlerError
{
    constructor(expected, got, lineno)
    {
        super("UnexpectedTokenError", `expected "${expected}" got "${got}"`, lineno);
    }
}


/** */
class NewlineExpectedError extends ArticlerError
{
    constructor(after_what, lineno)
    {
        super("NewlineExpectedError", `newline expected after ${after_what}`, lineno);
    }
}

