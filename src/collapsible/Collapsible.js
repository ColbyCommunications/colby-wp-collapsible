class Collapsible {
  constructor(props) {
    this.props = props;
    this.open = !props.open;

    this.setHeight = this.setHeight.bind(this);
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
      this.contentHeight = this.props.content.clientHeight;
      this.props.contentContainer.style.height = `${this.contentHeight}px`;
    }

    this.open = !this.open;
  }

  setHeight() {
    if (this.open) {
      this.contentHeight = this.props.content.clientHeight;
      this.props.contentContainer.style.height = `${this.contentHeight}px`;
    }
  }

  run() {
    this.handleClick();
    this.props.trigger.addEventListener('click', this.handleClick.bind(this));

    window.addEventListener('resize', this.setHeight);
    setInterval(this.setHeight, 400);
  }
}

export default Collapsible;
