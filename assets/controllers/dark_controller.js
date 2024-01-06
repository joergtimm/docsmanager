import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {


    initialize()
    {
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    }

    connect()
    {
        localStorage.setItem("color-theme", "dark");

        /*
        this.darkerTarget.addEventListener("change", () => {
            if (this.darkerTarget.checked) {
                this.element.setAttribute("data-theme", "dark");
                localStorage.setItem("color-theme", "dark");
            } else {
                this.element.removeAttribute("data-theme");
                localStorage.removeItem("darkSwitch");
            }
        });
         */
    }
}