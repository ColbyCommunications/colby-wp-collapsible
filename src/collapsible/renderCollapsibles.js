import Collapsible from './Collapsible';

const maybeRun = (container) => {
  const collapsible = new Collapsible({
    container,
    trigger: container.querySelector('[data-trigger]') || null,
    content: container.querySelector('.collapsibleContent') || null,
    contentContainer:
      container.querySelector('.collapsibleContentContainer') || null,
    open: !!['1', 'true'].includes(container.getAttribute('data-open')),
  });

  if (collapsible.shouldRun()) {
    collapsible.run();
  }
};

const renderCollapsibles = () => {
  Array.prototype.forEach.call(
    document.querySelectorAll('[data-collapsible]'),
    maybeRun
  );
};

export default renderCollapsibles;
