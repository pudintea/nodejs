const mysql = require('mysql')

const db = mysql.createConnection({
    host:"localhost",
    user: "root",
    password: "",
    database: "db_sidak_ypia"
})

// Buat dia jadi modul
module.exports = db