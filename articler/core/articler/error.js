/** articler error class and util functions */

/** */
export class ArticlerError
{
    constructor(type, message, lineno, charno)
    {
        this.type = type;
        this.message = message;
        this.lineno = lineno;
        this.charno = charno;
    }

    to_html()
    {
        var html = `
        <div class="articler-error">
            <div class="type">${this.type}</div>
            <div class="position">${this.lineno}:${this.charno}</div>
            <div class="message">${this.message}</div>
        </div>
        `;
        return html;
    }

    toString()
    {
        return `${this.type}: ${this.message}`;
    }
}
