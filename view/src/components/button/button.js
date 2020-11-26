export class Button {
  constructor(content, func) {
    this.content = content
    this.func = func
    this.disable = false
  }

  get html() {
    return `
    <div class="host">
      <button onclick="${this.func}()" ${this.disable ? 'disabled' : ''}>${this.content}</button>
    </div>
    `
  }
}
