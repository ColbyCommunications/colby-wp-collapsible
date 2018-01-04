import {collapsiblize} from './collapsiblize';

window.addEventListener('load', () => {
  [...document.querySelectorAll('[data-collapsible]')].forEach(container => {
    const heading = container.querySelector('.collapsible-heading');
    const panel = container.querySelector('.collapsible-panel');

    if (heading && panel) {
      collapsiblize({heading, panel});
    }
  });
});
