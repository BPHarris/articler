/** */

import "./util.js";

/* AST Nodes */
import { Article } from "./ast/article.js";
import { Metadata } from "./ast/Metadata.js";
import { ArticleBody } from "./ast/ArticleBody.js";

/* Errors */
import {
    ArticlerError,
    UnrecognisedMetadataTagError,
    UnexpectedTokenError,
    NewlineExpectedError,
} from "./error.js";


export default parse_article;


/**
 * article ::= metadata article_body
 * 
 * @return [Article | ArticlerError]
 */
function parse_article(article)
{
    var metadata, article_body;

    // NOTE: does this fix line endings?
    article = article.replace(/(?:\r\n|\r|\n)/g, "\n");
    
    [metadata, article] = parse_metadata(article);
    if (metadata instanceof ArticlerError)
        return metadata

    // TODO: [article_body, article] = parse_article_body(article);
    article_body = new ArticleBody(article);

    // TODO: if (article.length) Error() -- i.e. article_body had leftovers

    return new Article(metadata, article_body);
}


/**
 * metadata ::= (metadata_line | NEWLINE)*
 * 
 * @return [Metadata | ArticlerError, article''] article metadata
 */
function parse_metadata(article)
{
    var metadata_line, metadata_lines = [];

    article = article.skip_whitespace();
    
    while (article.starts_with("@"))
    {
        [metadata_line, article] = parse_metadata_line(article);

        if (metadata_line instanceof ArticlerError)
            return [metadata_line, article];

        metadata_lines.push(metadata_line);
        article = article.skip_whitespace();
    }

    var metadata = new Metadata(metadata_lines), error;
    if ((error = metadata.is_legal()) instanceof ArticlerError)
        return [error, article];
    return [metadata, article];
}


/**
 * metadata_line ::= '@' metadata_tag '=' line
 * 
 * @return [Array[metadata_tag, line] | ArticlerError, article'']
 */
function parse_metadata_line(article)
{
    var metadata_tag, line;

    article = article.consume("@");
    
    article = article.skip_whitespace(" ");
    
    [metadata_tag, article] = article.read_option(
        Metadata.allowed_metadata_tags);
    if (!metadata_tag)
        return [new UnrecognisedMetadataTagError(
                Metadata.allowed_metadata_tags, article.read_to("=")[0]),
                article];
    
    article = article.skip_whitespace(" ");
    
    if (!article.starts_with("="))
        return [new UnexpectedTokenError("=", article[0]), article];
    article = article.consume("=");

    article = article.skip_whitespace(" ");

    [line, article] = article.read_line();

    return [[metadata_tag, line], article];
}
