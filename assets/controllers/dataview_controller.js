import { Controller } from '@hotwired/stimulus'

/**
 * Controller class that extends the base controller.
 * Manages the view mode and local storage for the grid and list buttons.
 */
export default class extends Controller {
    static targets = ['gridbtn', 'listbtn']
    static values = {
        viewMode: String,
        listItems: Number,
        gridItems: Number,
    }

  /**
   * Sets the view mode and updates the active button based on the stored data from localStorage.
   *
   * @returns {void}
   */
    connect()
    {
        this.viewModeValue = localStorage.getItem('viewMode')
        this.listItemsValue = localStorage.getItem('listItems')
        this.gridItemsValue = localStorage.getItem('gridItems')

        if (this.viewModeValue === 'grid') {
            this.gridbtnTarget.classList.remove('active')
            this.listbtnTarget.classList.add('active')
        }
        if (this.viewModeValue === 'list') {
            this.gridbtnTarget.classList.add('active')
            this.listbtnTarget.classList.remove('active')
        }
    }

}
