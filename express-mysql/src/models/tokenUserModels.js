const dbPool    = require('../config/database');

// MODELS UPDATE TOKEN
const updateToken = (updateData, idUser, tbNama, namaIdTb, allowedFields = []) => {
    // Kalau allowedFields dikasih, filter berdasarkan itu
    const inputData = Object.entries(updateData)
        .filter(([key]) => allowedFields.length === 0 || allowedFields.includes(key))
        .reduce((obj, [key, value]) => {
            obj[key] = value;
            return obj;
        }, {});

    if (Object.keys(inputData).length === 0) {
        return Promise.reject(new Error('Tidak ada field valid untuk di-update.'));
    }

    // Buat query SET dan values-nya
    const setClause = Object.keys(inputData).map(key => `${key} = ?`).join(', ');
    const values = [...Object.values(inputData), idUser];

    const sqlQuery = `UPDATE ${tbNama} SET ${setClause} WHERE ${namaIdTb} = ?`;

    return dbPool.execute(sqlQuery, values);
};

module.exports = {
    updateToken,
}