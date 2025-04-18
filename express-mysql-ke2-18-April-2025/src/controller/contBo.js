const modBo     = require('../models/modBo')
const bcrypt    = require('bcrypt') // Untuk Enkripsi Password
const md5       = require('md5');

const get = (req, res) => {
    res.status(404).json({
        message: 'Not Found!'
    })
}

const login = async (req, res) => {
    const { email, password } = req.body;
    // Panggil Data User
    const [dataUser] = await modBo.get(email);
    if (dataUser.length === 0) {
        return res.status(404).json({ message: 'Email not found!' });
    }
    const user = dataUser[0]; // ambil user pertama dari hasil query

    // Cek password yang dikirim user dengan yang di-hash di DB
    const isMatch = await bcrypt.compare(password, user.users_password);
    if (!isMatch) {
        return res.status(401).json({ message: 'Password salah' });
    }

    // Buat Token dengan md5
    const timestamp = new Date().getTime();
    const hashMd5 = md5(`${timestamp}-${user.users_email}`);

    try {
        await modBo.updateToken(user.id_users, hashMd5);
        res.json({
            message: 'Login success',
            data: {
                id: user.id_users,
                nama : user.users_nama,
                email: user.users_email,
                level: user.users_level,
                token: hashMd5
            }
        })
    } catch (error) {
        res.status(500).json({
            message: 'Server Database Error',
            serverMessage: error.message || error
        })
    }
}

module.exports = {
    get,
    login
}
