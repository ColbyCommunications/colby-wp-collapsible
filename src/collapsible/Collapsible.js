class Collapsible {
  constructor(props) {
    this.props = props;
    this.open = props.open;
  }

  shouldRun() {
    if (
      [
        this.props.trigger,
        this.props.content,
        this.props.contentContainer,
      ].includes(null)
    ) {
      return false;
    }

    return true;
  }

  handleClick() {
    if (this.open) {
      this.props.container.classList.remove('open');
      this.props.contentContainer.style.height = '0';
    } else {
      this.props.container.classList.add('open');
      this.props.contentContainer.style.height = `${this.contentHeight}px`;
    }

    this.open = !this.open;
  }

  run() {
    this.contentHeight = this.props.content.clientHeight;

    this.props.trigger.addEventListener('click', this.handleClick.bind(this));
  }
}

export default Collapsible;
