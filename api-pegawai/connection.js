const mysql = require('mysql')

const db = mysql.createConnection({
    host:"localhost",
    user: "root",
    password: "",
    database: "db_pegawai"
})

db.connect(function(err){
    if (err) throw err;
    console.log("Database Is Connected Sucsessfuly !")
})
// Buat dia jadi modul
module.exports = db
