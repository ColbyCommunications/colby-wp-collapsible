import { collapsiblize } from './collapsiblize';

class Collapsibles {
  static init() {
    if (!Collapsibles.hasStarted) {
      Collapsibles.run();
    }
  }

  static run() {
    Collapsibles.hasStarted = true;
    window.addEventListener('load', () => {
      [...document.querySelectorAll('[data-collapsible]')].forEach(
        container => {
          const heading = container.querySelector('.collapsible-heading');
          const panel = container.querySelector('.collapsible-panel');

          if (heading && panel) {
            collapsiblize({ heading, panel });
          }
        }
      );
    });
  }
}

export default Collapsibles;
