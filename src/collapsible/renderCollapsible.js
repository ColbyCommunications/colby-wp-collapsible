/* eslint react/no-danger: 0 */

import React from 'react';
import ReactDOM from 'react-dom';
import Collapsible from 'react-collapsible';

import DownArrow from 'colby-wp-svg/jsx/down-arrow';

import styles from './collapsible.module.scss';

const renderCollapsible = () => {
  Array.prototype.forEach.call(
    document.querySelectorAll('[data-collapsible]'),
    (container) => {
      const trigger = container.getAttribute('data-trigger');
      if (trigger) {
        ReactDOM.render(
          <Collapsible
            className={styles.Collapsible}
            openedClassName={styles.open}
            triggerClassName={styles.trigger}
            triggerOpenedClassName={styles.trigger}
            contentInnerClassName={styles.contentInner}
            transitionTime={300}
            trigger={
              <button>
                <span>
                  {trigger}
                </span>
                <DownArrow />
              </button>
            }
          >
            <div dangerouslySetInnerHTML={{ __html: container.innerHTML }} />
          </Collapsible>,
          container
        );
      }
    }
  );
};

export default renderCollapsible;
