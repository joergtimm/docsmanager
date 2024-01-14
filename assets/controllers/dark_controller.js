import { Controller } from '@hotwired/stimulus'

/* stimulusFetch: 'lazy' */
export default class extends Controller {

  static targets = ['darkicon', 'lighticon']


    connect()
    {
      // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
              this.element.classList.remove('dark')
              localStorage.setItem('color-theme', 'light')
              this.darkiconTarget.classList.remove('hidden')
              this.lighticonTarget.classList.add('hidden')
            } else {
              this.element.classList.add('dark')
              localStorage.setItem('color-theme', 'dark')
              this.darkiconTarget.classList.add('hidden')
              this.lighticonTarget.classList.remove('hidden')
            }

            // if NOT set via local storage previously
        } else {
            if (this.element.classList.contains('dark')) {
              this.element.classList.remove('dark')
              localStorage.setItem('color-theme', 'light')
            } else {
              this.element.classList.add('dark')
              localStorage.setItem('color-theme', 'dark')
            }
        }
    }

    toggle()
    {
        // toggle icons inside button
      this.darkiconTarget.classList.toggle('hidden')
      this.lighticonTarget.classList.toggle('hidden')

        if (this.element.classList.contains('dark')) {
          this.element.classList.remove('dark')
          localStorage.setItem('color-theme', 'light')
        } else {
          this.element.classList.add('dark')
          localStorage.setItem('color-theme', 'dark')
        }
    }
}