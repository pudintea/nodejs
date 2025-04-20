const express = require('express')
const routes = express.Router()
//REQ Controller Users
const contBo = require('../controller/contBo')

routes.get('/', contBo.get)

// Prosess LoginNya
routes.post('/', contBo.login)

module.exports = routes