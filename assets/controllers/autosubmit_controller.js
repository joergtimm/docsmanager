import { Controller } from "@hotwired/stimulus"
import debounce from 'debounce'

// Globale Konstante, die den Tag-Namen beinhaltet
const FORM_TAG_NAME = 'form';

// Connects to data-controller="autosubmit"
export default class extends Controller {
    initialize()
    {
        this.debouncedSubmit = debounce(this.debouncedSubmit.bind(this), 700)
    }

    submit(e)
    {
        this.element.requestSubmit()
    }

    debouncedSubmit()
    {
        this.submit()
    }

    checkFormPresence()
    {
        // Überprüfen, ob der Controller direkt am <form> Element hängt
        if (this.element.tagName.toLowerCase() === FORM_TAG_NAME) {
            console.log("Controller ist direkt am <form>-Tag angebracht.");
            this.debouncedSubmit = debounce(this.debouncedSubmit.bind(this), 700)
        }
        // Überprüfen, ob ein <form> Element als Kind vorhanden ist
        else if (this.element.querySelector(FORM_TAG_NAME)) {
            console.log("Ein <form>-Element ist als Kind vorhanden.");
            this.debouncedSubmit = debounce(this.element.querySelector(FORM_TAG_NAME).debouncedSubmit.bind(this), 700)
        } else {
            console.log("Kein <form> direkt oder als Kind gefunden.");
            // Logik für den Fall, dass kein <form> gefunden wird
        }
    }
}
