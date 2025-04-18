const dbPool = require('../config/confDbMysql')

const getAll = (tbNama) => {
    const sqlQuery = `SELECT * FROM \`${tbNama}\``;
    return dbPool.execute(sqlQuery);
}

const get = (tbNama, idTb, namaIdTb) => {
    const sqlQuery = `SELECT * FROM \`${tbNama}\` WHERE \`${namaIdTb}\` = ?`;
    return dbPool.execute(sqlQuery, [idTb]);
}

const save = (inputData, tbNama) => {
    const fields = Object.keys(inputData).join(', ');
    const placeholders = Object.keys(inputData).map(() => '?').join(', ');
    const sqlQuery = `INSERT INTO ${tbNama} (${fields}) VALUES (${placeholders})`;
    const values = Object.values(inputData);

    return dbPool.execute(sqlQuery, values);
}

const cek = (tbNama, idTb, namaIdTb) => {
    const sqlQuery = `SELECT \`${namaIdTb}\` FROM \`${tbNama}\` WHERE \`${namaIdTb}\` = ?`;
    return dbPool.execute(sqlQuery, [idTb]);
}

const update = (updateData, idUser, tbNama, namaIdTb, allowedFields = []) => {
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

const hapus = (idUser, tbNama, namaIdTb) => {
    const sqlQuery = `DELETE FROM \`${tbNama}\` WHERE \`${namaIdTb}\` = ?`;
    return dbPool.execute(sqlQuery, [idUser]);
}

module.exports = {
    get,
    getAll,
    save,
    cek,
    update,
    hapus
}