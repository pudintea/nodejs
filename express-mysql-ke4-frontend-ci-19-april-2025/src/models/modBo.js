// Panggil Config DB MySql
const dbPool = require('../config/confDbMysql')
const namaTb = 'users'

const get = (email) => {
    const sqlQuery = `SELECT * FROM \`${namaTb}\` WHERE users_email = ?`;
    return dbPool.execute(sqlQuery, [email]);
}

const updateToken = (id, token) => {
    const sqlQuery = `UPDATE ?? SET users_token = ? WHERE id_users = ?`;
    return dbPool.query(sqlQuery, [namaTb, token, id]);
};

module.exports = {
    get,
    updateToken
}
