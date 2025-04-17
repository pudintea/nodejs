const usersModels   = require('../models/usersmodels');
const bcrypt        = require('bcrypt');

// BUAT USER BARU
const createUsers = async (req, res) => {
    const {body} = req;

    // jika data kosong, nama (or) email kode 400
    if (!body.nama || !body.email){
        return res.status(400).json({
            message: 'Data yang anda kirim, kosong'
        })
    }

    // Hash Bcrypt
    const saltRounds = 10;
    const hashedPassword = await bcrypt.hash(body.password, saltRounds);

    try {
        // Data yang akan dimasukan berupa array
        const inputData = {
            users_nama: body.nama,
            users_email: body.email,
            users_password: hashedPassword,
            users_level: body.level,
            users_active: 1,
            users_token: ''
        };

        await usersModels.saveUser(inputData,'users');
        res.status(201).json({
            message: 'Create User Success',
            data:body,
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server Database Error',
            serverMessage: error.message || error
        })
    }
}

// TAMPILKAN SEMUA USER
const getAllUsers = async (req, res) => {
    try {
        const [data] = await usersModels.getAllUser('users');
        res.json({
            message: 'Get All User Success',
            data:data
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server Database Error',
            serverMessage: error.message || error
        })
    }
}

// TAMPILKAN SATU USER
const getUsers = async (req, res) => {
    const { idUser } = req.params;

    try {
        const [data] = await usersModels.getUser('users', idUser, 'id_users');
        res.json({
            message: 'Get User Success',
            data:data
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server Database Error',
            serverMessage: error.message || error
        })
    }
}

// PATCH - CONTROLLER UPDATE USER
const updateUser = async (req, res) => {
    const { idUser } = req.params;
    const { body } = req;

    // Tentukan field yang boleh diupdate dari sisi controller
    const allowedFields = ['users_nama', 'users_email', 'users_password'];
    try {
        // Olah data yang mau di update dan ambil dari body yang mau dikirim
        const updateData = {
            users_nama: body.nama,
            users_email: body.email,
            users_password: body.password
        }
        // Perhatikan terkait nama tabel dan id table
        await usersModels.updateUser(updateData, idUser, 'users','id_users', allowedFields);
        res.json({
            message: 'Update Patch User Success',
            data: {
                id: idUser,
                ...body
            }
        });
    } catch (error) {
        res.status(500).json({
            message: 'Server Database Error',
            serverMessage: error.message || error
        });
    }
};


// HAPUS USER
const deleteUser = async (req, res) => {
    const {idUser} = req.params;

    try {
        await usersModels.deleteUser(idUser,'users', 'id_users');
        res.json({
            message: 'Delete User Success'
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server Database Error',
            serverMessage: error.message || error
        });
    }
    
}

module.exports = {
    getAllUsers,
    getUsers,
    createUsers,
    updateUser,
    deleteUser
}
