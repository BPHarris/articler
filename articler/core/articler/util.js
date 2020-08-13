/** Articler Parser Util Functions */

String.prototype.starts_with = String.prototype.startsWith;
String.prototype.ends_with = String.prototype.endsWith;
String.prototype.index_of = String.prototype.indexOf;


/** @return [string] returns this with target removed from the start */
String.prototype.consume = function (target) {
    if (!this.starts_with(target))
        return this;
    return this.slice(target.length);
};

/** @return [string] returns this without preceeding whitespace. */
String.prototype.skip_whitespace = String.prototype.trimStart;


/** */
String.prototype.read_option = function (options) {
    for (const option of options)
        if (this.starts_with(option))
            return [option, this.consume(option)];
    return ["", this];
}


/** @return [before, after]  */
String.prototype.read_to = function (target) {
    var index = this.index_of(target);
    if (index === -1)
        return [this, ""]
    return [this.slice(0, index), this.slice(index + target.length)];
}


/** @return [line, article] @see read_to */
String.prototype.read_line = function () { return this.read_to("\n"); }