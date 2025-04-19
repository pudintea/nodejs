const modBo     = require('../models/modBo')
const bcrypt    = require('bcrypt') // Untuk Enkripsi Password
const md5       = require('md5');
const jwt       = require('jsonwebtoken');

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

    const expireToken = 60 * 60 * 1; // angka 1 Jika 1 jam, ganti jadi angka 2 jika 2 jam
    const tokenJWT = jwt.sign({
        id: user.id_users,
        nama : user.users_nama,
        email: user.users_email,
        level: user.users_level,
        token: hashMd5
      }, process.env.JWT_SECRET, { expiresIn: expireToken });

    try {
        await modBo.updateToken(user.id_users, hashMd5);
        res.json({
            status: 'success',
            message: 'Login success',
            token: tokenJWT
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
// ------------ Pudintea