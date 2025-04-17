const express = require('express');
const router = express.Router();
const userController = require('./../controller/users.js');

// POST
router.post('/', userController.createUsers);

//GET All
router.get('/', userController.getAllUsers);

// Get Satu Data
router.get('/:idUser', userController.getUsers);

// UPDATE
router.patch('/:idUser', userController.updateUser);

// DELETE
router.delete('/:idUser', userController.deleteUser);

module.exports = router;