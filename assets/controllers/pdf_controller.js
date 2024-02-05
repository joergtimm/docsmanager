import { Controller } from "@hotwired/stimulus"
import WebViewer from '@pdftron/pdfjs-express-viewer';


export default class extends Controller {
    static values = {
        url: String,
    };



    connect () {
        WebViewer(
          {
            initialDoc: this.urlValue
          },
          this.element
        )
    }

}
