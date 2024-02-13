import './bootstrap.js';
import './styles/app.css';
import 'flowbite';
import { shouldPerformTransition, performTransition } from "turbo-view-transitions";


/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */




/*
Turbo.session.drive = false;
*/
let skipNextRenderTransition = false;
document.addEventListener('turbo:before-render', (event) => {
    if (shouldPerformTransition() && !skipNextRenderTransition) {
        event.preventDefault();

        performTransition(document.body, event.detail.newBody, async() => {
            await event.detail.resume();
        });
    }
});

document.addEventListener('turbo:load', () => {
    // View Transitions don't play nicely with Turbo cache
    // if (shouldPerformTransition()) Turbo.cache.exemptPageFromCache();
});

document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById('updateProductButton').click();
});

document.addEventListener('turbo:before-frame-render', (event) => {
    if (shouldPerformTransition() && !event.target.hasAttribute('data-skip-transition')) {
        event.preventDefault();

        // workaround for data-turbo-action="advance", which triggers
        // turbo:before-render (and we want THAT to not try to transition)
        skipNextRenderTransition = true;
        setTimeout(() => {
            skipNextRenderTransition = false;
        }, 100);

        performTransition(event.target, event.detail.newFrame, async() => {
            await event.detail.resume();
        }).then(() => {
            e(event.target, { activeAttr: 'data-active' });
          });
    }
});










