import { Controller } from '@hotwired/stimulus'

// Connects to data-controller="autosubmit"
export default class extends Controller {
  connect () {
    this.element.classList.add('invisible')
  }

  close () {
    this.element.classList.add('invisible')
  }
}
