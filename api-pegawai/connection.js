const mysql = require('mysql')

const db = mysql.createConnection({
    host:"localhost",
    user: "root",
    password: "",
    database: "db_pegawai"
})

// Buat dia jadi modul
module.exports = db
