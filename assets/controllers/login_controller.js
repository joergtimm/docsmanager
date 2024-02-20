import { Controller } from "@hotwired/stimulus"



export default class extends Controller {
    static targets = ['emailin', 'passwordin']

    connect()
    {
        console.log('login');
        this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/login_controller.js';
        this.fillValues();
    }

    fillValues()
    {
        this.emailinTarget.value = 'admin@example.com';
        this.passwordinTarget.value = '+SuperPassword123';
    }
}
