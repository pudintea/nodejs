const dbPool    = require('../config/database');

const dataUser = async (email) => {
    const sqlQuery = `SELECT * FROM users WHERE users_email = ?`;
    const [rows] = await dbPool.execute(sqlQuery,[email]);
    return rows;
}

module.exports = {
    dataUser,
}