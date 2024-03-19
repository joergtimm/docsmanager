import { Controller } from "@hotwired/stimulus"


export default class extends Controller {
    static values = {
        url: String,
    };
    static targets = ["dialog", "content", "button"];

    initialize()
    {
        this.addScript('https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js');
    }

    connect()
    {
        this.buttonTarget.addEventListener("click", this.open.bind(this));
        console.log('hier isser');
    }

    async open()
    {
        this.dialogTarget.classList.remove('hidden');
    }

    close()
    {
        this.dialogTarget.classList.add('hidden');
    }
    topdf()
    {

        const element = this.contentTarget.contentWindow.document.body;
        const options = {
            margin: 1,
            filename: 'downloaded.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }

        };

        const worker = html2pdf();

        worker.set(options).from(element).save();

    }

    addScript(url)
    {
        var script = document.createElement('script');
        script.type = 'application/javascript';
        script.src = url;
        document.head.appendChild(script);
    }

}
