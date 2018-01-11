const removeEmptyParagraphs = container => {
  [...container.querySelectorAll('p')].forEach(p => {
    if (p.innerHTML.trim().length === 0) {
      container.removeChild(p);
    }
  });
};

const ensureTypeAndPressedAttributes = heading => {
  if (!heading.hasAttribute('aria-pressed')) {
    heading.setAttribute('aria-pressed', 'false');
  }

  if (!heading.hasAttribute('type')) {
    heading.setAttribute('type', 'button');
  }
};

const ensureAriaHiddenAttribute = panel => {
  if (!panel.hasAttribute('aria-hidden')) {
    panel.setAttribute('aria-hidden', 'true');
  }
};

const togglePress = heading => {
  heading.setAttribute(
    'aria-pressed',
    heading.getAttribute('aria-pressed') === 'true' ? 'false' : 'true'
  );
};

const toggle = panel => {
  const wasHidden = panel.getAttribute('aria-hidden');
  panel.setAttribute('aria-hidden', wasHidden === 'true' ? 'false' : 'true');

  panel.dispatchEvent(
    new CustomEvent('change', {
      detail: { open: wasHidden === 'true' },
    })
  );
};

export const collapsiblize = ({ heading, panel }) => {
  removeEmptyParagraphs(panel);
  ensureTypeAndPressedAttributes(heading);
  ensureAriaHiddenAttribute(panel);

  heading.addEventListener('click', () => {
    togglePress(heading);
    toggle(panel);
  });
};
