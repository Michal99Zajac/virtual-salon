export class Header {
  constructor(content) {
    this.content = content
  }

  get html() {
    return `
    <div class="header">
      <h1>${this.content}</h1>
    </div>
    `
  }
}
