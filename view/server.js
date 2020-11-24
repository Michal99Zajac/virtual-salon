const express = require('express')
const path = require('path')
const fs = require('fs')

const PORT = 8080
const HOST = 'localhost'

const app = express()

app.use('/public', express.static(__dirname + "/**/*"))
console.log(__dirname)
app.get('/', (req, res) => {
  fs.readFile(__dirname+'/index.html', 'utf8', (err, text) => {
    res.send(text)
  })
})

app.listen(PORT, HOST)
console.log(`Running on http://${HOST}:${PORT}`)
