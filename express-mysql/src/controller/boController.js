const bcrypt        = require('bcrypt');
const boModels      = require('../models/boModels.js');
const md5           = require('md5');
const tokenUserModles = require('../models/tokenUserModels.js');

const getData = (req, res) => {
    res.status(403).json({
        message: '403 Forbidden'
    });
}

const loginUser = async (req, res) => {
    const { email, password } = req.body;

    // Panggil Data User
    const dataUser = await boModels.dataUser(email);

    if (dataUser.length === 0) {
        return res.status(401).json({ message: 'Email tidak ditemukan' });
    }

    const user = dataUser[0]; // ambil user pertama dari hasil query

    // Cek password yang dikirim user dengan yang di-hash di DB
    const isMatch = await bcrypt.compare(password, user.users_password);
    if (!isMatch) {
        return res.status(401).json({ message: 'Password salah' });
    }

    try {
        const timestamp = new Date().getTime();
        const hashMd5 = md5(`${timestamp}-${user.users_email}`);
        try {
            const allowedFields = ['users_token'];
            // Olah data yang mau di update dan ambil dari body yang mau dikirim
            const updateData = {
                users_token: hashMd5
            }
            // Perhatikan terkait nama tabel dan id table
            await tokenUserModles.updateToken(updateData, user.id_users, 'users','id_users', allowedFields);

            res.json({
                message: 'Aksess login success',
                data: {
                    id:user.id_users,
                    email:user.users_email,
                    level:user.users_level,
                    token: hashMd5
                },
            });
        } catch (error) {
            res.status(500).json({
                message: 'Update Token gagal',
                serverMessage: error.message || error
            })
        }
    } catch (error) {
        res.status(500).json({
            message: 'Server Database Error',
            serverMessage: error.message || error
        })
    }
}

module.exports = {
    loginUser,
    getData
}