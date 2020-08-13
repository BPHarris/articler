/** metadata ast node */

import { AstNode } from "./AstNode.js";

import {
    IllegalMetadataError, MetadataRepetitionError
} from "../error.js";


/** */
export class Metadata extends AstNode
{
    static allowed_metadata_tags = [
        "id", "title", "author", "date", "note",
        "thumbnailcaption", "thumbnailtext", "thumbnail",
        "fa-icon", "fa-icontarget"
    ];

    static repeatable_tags = ["note", "fa-icon", "fa-icontarget"];

    constructor(metadata_tag_data_pairs)
    {
        super();
        
        this.metadata = [];     // type: Array[{tag : string, data : string}]
        for (const i in metadata_tag_data_pairs)
            this.metadata.push({
                "tag"  : metadata_tag_data_pairs[i][0],
                "data" : metadata_tag_data_pairs[i][1]
            });
    }

    /** 
     * // NOTE: assumes tag not in repeatable_tags
     * @return the metadata corresponding to the given tag or null
     */
    get(tag)
    {
        for (const pair of this.metadata)
            if (pair.tag === tag)
                return pair.data;
        return null;
    }

    /** @return true if legal, ArticlerError is illegal */
    is_legal(lineno)
    {
        var seen = [];

        for (const pair of this.metadata)
        {
            if (seen.includes(pair.tag)
                    && !Metadata.repeatable_tags.includes(pair.tag))
                return new MetadataRepetitionError(pair.tag, lineno);
            seen.push(pair.tag);

            if (pair.tag === "id" && !pair.data.match(/^[a-z-]*$/i))
                return new IllegalMetadataError(pair.tag, lineno);
        }

        return true;
    }

    /** */
    to_html()
    {
        var i = "        ";
        var tag_html = "";
        for (const pair of this.metadata)
        {
            tag_html += i + `<div class="metadata">\n`;
            tag_html += i + `    <div class="tag">${pair.tag}</div>\n`;
            tag_html += i + `    <div class="sep">:</div>\n`;
            tag_html += i + `    <div class="data">${pair.data}</div>\n`;
            tag_html += i + `</div>\n`;
        }
        return `<div class="articler-metadata">\n${tag_html}    </div>`;
    }
}
