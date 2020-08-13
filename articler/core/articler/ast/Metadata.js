/** metadata ast node */

import { AstNode } from "./AstNode.js";


/** */
export class Metadata extends AstNode
{
    constructor(metadata_tag_data_pairs)
    {
        super();
        
        this.metadata = {};     // type: Object
        for (const tag_data_pair_array in metadata_tag_data_pairs)
        {
            var tag_data_pair = metadata_tag_data_pairs[tag_data_pair_array];
            this.metadata[tag_data_pair[0]] = tag_data_pair[1];
        }
    }

    get(tag) { return this.metadata[tag]; }

    to_html()
    {
        var html = `<div class="articler-metadata">\n`;
        for (const tag in this.metadata)
            html += `        <div class=${tag}>${this.metadata[tag]}</div>\n`;
        html += `    </div>`;
        return html;
    }
}
