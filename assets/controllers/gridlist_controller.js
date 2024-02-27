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
   * Initialize the application by setting up the necessary localStorage values and connecting to the server.
   *
   * @returns {void}
   */
    initial()
    {
        if (!('viewMode' in localStorage)) {
            localStorage.setItem('viewMode', this.viewModeValue)
        }
        if (!('listItems' in localStorage)) {
            localStorage.setItem('listItems', this.listItemsValue)
        }
        if (!('gridItems' in localStorage)) {
            localStorage.setItem('gridItems', this.gridItemsValue)
        }
        this.connect()
    }

  /**
   * Sets the view mode and updates the active button based on the stored data from localStorage.
   *
   * @returns {void}
   */
    connect()
    {
        // this.viewModeValue = localStorage.getItem('viewMode')
        // this.listItemsValue = localStorage.getItem('listItems')
        // this.gridItemsValue = localStorage.getItem('gridItems')

        this.toggle();

        if (this.viewModeValue === 'grid') {
            this.gridbtnTarget.classList.remove('active')
            this.listbtnTarget.classList.add('active')
        }
        if (this.viewModeValue === 'list') {
            this.gridbtnTarget.classList.add('active')
            this.listbtnTarget.classList.remove('active')
        }
    }

  /**
   * Toggles the view mode between list and grid.
   *
   * It updates the view mode value, adds or removes the 'active' class on the corresponding buttons,
   * and stores the new view mode value in the local storage.
   *
   * @return {void}
   */
    toggle()
    {
        if (this.viewModeValue === 'list') {
            this.viewModeValue = 'grid'
            this.gridbtnTarget.classList.add('active')
            this.listbtnTarget.classList.remove('active')
            localStorage.setItem('viewMode', 'grid')
        } else {
            this.viewModeValue = 'list'
            this.gridbtnTarget.classList.remove('active')
            this.listbtnTarget.classList.add('active')
            localStorage.setItem('viewMode', 'list')
        }
    }
}
