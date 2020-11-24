export class Button {
  constructor(content) {
    this.content = content
    this.disable = false
  }

  get html() {
    if (!this.disable) {
      return `
      <div class="button">
        <button>${this.content}</button>
      </div>
      `
    } else {
      return `
      <div class="button">
        <button disabled>${this.content}</button>
      </div>
      `
    }
  }
}