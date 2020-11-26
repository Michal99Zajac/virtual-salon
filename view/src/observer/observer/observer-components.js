import { Button } from '../../components/button/button.js'
import { Header } from '../../components/header/header.js'

export let components = {
  'header': {
    component: new Header('init Header'),
    fields: {
      content: 'text'
    },
    css: '../../components/header/css/header.css'
  },
  'button': {
    component: new Button('Button', "(() => {alert('Hallo')})"),
    fields: {
      content: 'text',
      disable: 'checkbox'
    },
    css: '../../components/button/css/button.css'
  }
}
