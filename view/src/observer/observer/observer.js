import { components } from './observer-components.js'

export class Observer {
  constructor() {
    this.components = components
    this.current = Object.keys(this.components)[0]
  }

  getCompNames() {
    return Object.keys(this.components)
  }

  getComponent(name) {
    return this.components[name]['component']
  }

  getFields(name) {
    return this.components[name]['fields']
  }

  getCss() {
    let css = []
    for (let component in this.components) {
      css.push(components[component]['css'])
    }
    return css
  }

  getCurrentComponent() {
    return this.components[this.current]['component']
  }

  setCurrentComponent(nextComponent) {
    this.current = nextComponent
  }

  getCurrentFields() {
    return this.components[this.current]['fields']
  }
}
