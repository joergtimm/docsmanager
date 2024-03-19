import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="clipboard"
export default class extends Controller {

    static targets = ['trigger', 'input']
    static values = {
        options: {
            contenttype: String,
            html: Boolean,
        },
    };

    connect()
    {
        this.clipboard = new CopyClipboard(this.triggerTarget, this.inputTarget, {
            contentType: this.optionsValue.contenttype,
            htmlEntities: this.optionsValue.html,
            onCopy: () => {
                console.log('Copied to clipboard');
            }
        });
    }

    copy()
    {
        this.clipboard.copy();
    }

}
