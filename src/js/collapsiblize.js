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
  panel.setAttribute(
    'aria-hidden',
    panel.getAttribute('aria-hidden') === 'true' ? 'false' : 'true'
  );
};

export const collapsiblize = ({heading, panel}) => {
  removeEmptyParagraphs(panel);
  ensureTypeAndPressedAttributes(heading);
  ensureAriaHiddenAttribute(panel);

  heading.addEventListener('click', () => {
    togglePress(heading);
    toggle(panel);
  });
};
