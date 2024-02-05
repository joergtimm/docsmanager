import { Controller } from '@hotwired/stimulus';
import Dropzone from "dropzone";


Dropzone.autoDiscover = false;

export default class extends Controller {
    static targets = ['input', 'galerie'];


    connect()
    {
        const myDropzone = new Dropzone(this.inputTarget);

        myDropzone.on("addedfile", function (file) {

            file.previewElement.addEventListener("click", function () {
                myDropzone.removeFile(file);
            });

        });

        Dropzone.options.myDropzone = {
            acceptedFiles: "image/*,application/pdf",
            dictDefaultMessage: 'ziehen sie hier die Dateien hinein zum uploaden'
        }

        myDropzone.on("sending", function ( file, xhr, formData) {
            // Will send the filesize along with the file as POST data.

            formData.append("filesize", file.size);
            if (file.exifData) {
                formData.append("exifData", file.exifData); // EXIF-Daten den Formulardaten hinzufügen
            }

        });

        myDropzone.on('queuecomplete', () => {
            console.log('queuecomplete');

        })

        myDropzone.on('success', (file, responseText) => {
            var mylist = this.galerieTarget;
            mylist.insertAdjacentHTML('beforebegin', responseText);
            setTimeout(() => {
                myDropzone.removeFile(file);
            }, 3000);


        })
    }


    disconnect()
    {
        this.element.remove();
    }
}