const express = require('express');
const bo = express.Router();
const boController = require('../controller/boController');

// POST
bo.get('/', boController.getData);
bo.post('/', boController.loginUser);

module.exports = bo;