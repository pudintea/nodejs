// Panggil Models CRUD
const modCRUD = require('../models/modCRUD')
const bcrypt  = require('bcrypt') // Untuk Enkripsi Password


const getAllUser = async (req, res) => {
    try {
        const [data] = await modCRUD.getAll('users');
        res.json({
            status:'success',
            message: 'GET all user success',
            data:data
        })
    } catch (error) {
        res.status(500).json({
            status:'error',
            message: 'Server Database Error',
            serverMessage: error.message || error
        })
    }
    
}

const getUser = async (req, res) => {
    const {id} = req.params

    // Cek ID yang dimasukan ada atau tidak di database
    const [rows] = await modCRUD.cek('users', id, 'id_users');
    if (rows.length === 0) {
        return res.status(404).json({ message: 'ID tidak ditemukan!' });
    }

    try {
        const [data] = await modCRUD.get('users', id, 'id_users');
        res.json({
            status:'success',
            message: 'GET user success',
            data:data
        })
    } catch (error) {
        res.status(500).json({
            status:'error',
            message: 'Server Database Error',
            serverMessage: error.message || error
        })
    }
}

const simpanUser = async (req, res) => {
    const {body} = req;

        // jika data kosong, nama (or) email kode 400
        if (!body.nama || !body.email || !body.password){
            return res.status(400).json({
                message: 'Data yang anda kirim, kosong'
            })
        }
    
        // Hash Bcrypt
        const saltRounds = 10;
        const hashedPassword = await bcrypt.hash(body.password, saltRounds);

        // Data yang akan dimasukan berupa array
        const inputData = {
            users_nama: body.nama,
            users_email: body.email,
            users_password: hashedPassword,
            users_level: body.level,
            users_active: 1,
            users_token: ''
        };

        try {
            // Simpan Data
            await modCRUD.save(inputData,'users');
            res.status(201).json({
                status:'success',
                message: 'Create User Success',
                data:body,
            })
        } catch (error) {
            res.status(500).json({
                status:'error',
                message: 'Server Database Error',
                serverMessage: error.message || error
            })
        }
}

const updateUser = async (req, res) => {
    const {id} = req.params
    const {body} = req;

    // Cek ID yang dimasukan ada atau tidak di database
    const [rows] = await modCRUD.cek('users', id, 'id_users');
    if (rows.length === 0) {
        return res.status(404).json({ message: 'ID tidak ditemukan!' });
    }

    // Tentukan field yang boleh diupdate dari sisi controller
    const allowedFields = ['users_nama', 'users_email', 'users_password'];

    // Olah data yang mau di update dan ambil dari body yang mau dikirim
    const updateData = {
        users_nama: body.nama
        // users_email: body.email,
        // users_password: body.password
    }

    try {
        // Prosess Update, Perhatikan terkait nama tabel dan id table
        await modCRUD.update(updateData, id, 'users','id_users', allowedFields);
        res.json({
            status:'success',
            message: 'Update User Success',
            data: {
                id: id,
                ...body
            }
        });
    } catch (error) {
        res.status(500).json({
            status:'error',
            message: 'Server Database Error',
            serverMessage: error.message || error
        });
    }
}

const deteleUser = async (req, res) => {
    const {id} = req.params

    // Cek ID yang dimasukan ada atau tidak di database
    const [rows] = await modCRUD.cek('users', id, 'id_users');
    if (rows.length === 0) {
        return res.status(404).json({ message: 'ID tidak ditemukan!' });
    }

    try {
        await modCRUD.hapus(id,'users', 'id_users');
        res.json({
            status:'success',
            message: 'Hapus user success'
        })
    } catch (error) {
        res.status(500).json({
            status:'error',
            message: 'Server Database Error',
            serverMessage: error.message || error
        });
    }
}

module.exports = {
    getAllUser,
    getUser,
    simpanUser,
    updateUser,
    deteleUser
}

