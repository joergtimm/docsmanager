import { Controller } from "@hotwired/stimulus"



export default class extends Controller {
    static targets = ['emailin', 'passwordin']

    connect()
    {
        this.fillValues();
    }

    fillValues()
    {
        this.emailinTarget.value = 'admin@example.com';
        this.passwordinTarget.value = '+SuperPassword123';
    }
}
