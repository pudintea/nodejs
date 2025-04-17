const mysql = require('mysql2');

const dbPool = mysql.createPool({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || '',
    database: process.env.DB_NAME || ''
});

// Export Module Asyinkronus
module.exports = dbPool.promise();