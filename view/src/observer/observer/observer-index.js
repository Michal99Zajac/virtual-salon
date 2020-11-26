import { Observer } from './observer.js'

class ObserverIndex {
  constructor(observer) {
    this.observer = observer
    this.initIndex()
  }

  initIndex() {
    this.initStyles()
    this.initComponentsList()
    this.addButtonFunction()
  }

  initStyles() {
    let head = document.getElementsByTagName('head')[0]
    for (let css of this.observer.getCss()) {
      let link = document.createElement('link')
      link.setAttribute('rel', "stylesheet")
      link.setAttribute('href', css)
      head.appendChild(link)
    }
  }

  initComponentsList() {
    let ul = document.getElementById('ob-ul')
    for (let name of this.observer.getCompNames()) {
      let li = document.createElement('li')
      li.setAttribute('class', 'ob-li')
      li.innerText = name
      this.initComponentListEvent(li)
      ul.appendChild(li)
    }
  }

  initComponentListEvent(li) {
    let componentContainer = document.getElementById('ob-container')
    li.addEventListener('click', () => {
      this.observer.setCurrentComponent(li.innerText)
      this.selectListItem(li)
      this.removeCurrentInputs()
      this.createInputs()
      let component = this.observer.getCurrentComponent()
      componentContainer.innerHTML = component.html
    })
  }

  createInputs() {
    let propsContainer = document.getElementById('ob-values-container')
    let fields = this.observer.getCurrentFields()
    for (let field in fields) {
      let label = this.getLabel(field)
      propsContainer.appendChild(label)
      let input = this.getInput(fields, field)
      propsContainer.appendChild(input)
    }
  }

  unselectListItems() {
    let selectedItems = document.getElementsByClassName('ob-selected')
    for (let item of selectedItems) {
      item.setAttribute('class', 'ob-li')
    }
  }

  selectListItem(li) {
    this.unselectListItems()
    li.setAttribute('class', 'ob-selected')
  }

  removeCurrentInputs() {
    let container = document.getElementById('ob-values-container')
    while (container.firstChild) {
      container.removeChild(container.firstChild)
    }
  }

  getLabel(field) {
    let label = document.createElement('label')
    label.innerText = `${field}`
    label.setAttribute('class', 'ob-label')
    label.setAttribute('for', `ob-${field}`)
    return label
  }

  getInput(fields, field) {
    let input = document.createElement('input')
    input.setAttribute('type', fields[field])
    input.setAttribute('class', `ob-${fields[field]}`)
    input.setAttribute('id', `ob-${field}`)
    this.establishInput(input, field)
    return input
  }

  establishInput(input, field) {
    let component = this.observer.getCurrentComponent()
    if (input.type === 'checkbox') {
      input.checked = component[field]
    } else {
      input.value = component[field]
    }
  }

  addButtonFunction() {
    let button = document.getElementById('ob-button')
    button.addEventListener('click', () => {
      this.changeComponent()
      this.refreshComponent()
    })
  }

  changeComponent() {
    let current = this.observer.getCurrentComponent()
    let fields = this.observer.getCurrentFields()
    for (let field in fields) {
      if (fields[field] === 'checkbox') {
        current[field] = document.getElementById(`ob-${field}`).checked
      } else {
        current[field] = document.getElementById(`ob-${field}`).value
      }
    }
  }

  refreshComponent() {
    let container = document.getElementById('ob-container')
    let component = this.observer.getCurrentComponent()
    container.innerHTML = component.html
  }
}

new ObserverIndex(new Observer())
