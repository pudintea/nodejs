const express = require('express')
const routes = express.Router()
//REQ Controller Users
const contUsers = require('../controller/contUsers')

routes.get('/', contUsers.getAllUser)

routes.get('/:id', contUsers.getUser)

routes.post('/', contUsers.simpanUser)

routes.patch('/:id', contUsers.updateUser)

routes.delete('/:id', contUsers.deteleUser)

module.exports = routes