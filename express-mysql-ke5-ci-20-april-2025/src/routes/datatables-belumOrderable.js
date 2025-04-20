// routes/users.js
const express = require('express');
const router = express.Router();
const pool = require('../config/confDbMysql');

router.get('/', async (req, res) => {
    res.status(404).json({
        message: 'Not Found!'
    })
})

router.post('/', async (req, res) => {
	const draw = parseInt(req.body.draw) || 1;
	const start = parseInt(req.body.start) || 0;
	const length = parseInt(req.body.length) || 10;
	const search = req.body.search || '';

	try {
		// Hitung total semua user
		const [totalResult] = await pool.query("SELECT COUNT(*) as total FROM users");
		const recordsTotal = totalResult[0].total;

		// Query untuk filter (jika ada pencarian)
		let filteredQuery = "SELECT * FROM users";
		let params = [];
		
		// Untuk Pencarian
		if (search) {
			filteredQuery += " WHERE users_nama LIKE ? OR users_email LIKE ?";
			params.push(`%${search}%`, `%${search}%`);
		}

		const [filteredResult] = await pool.query(filteredQuery, params);
		const recordsFiltered = filteredResult.length;

		// Ambil data dengan limit dan offset
		filteredQuery += " LIMIT ?, ?";
		params.push(start, length);

		const [users] = await pool.query(filteredQuery, params);

		const data = users.map((user, index) => ({
			id: user.id_users,
			no: start + index + 1,
			nama: user.users_nama,
			email: user.users_email,
			level: user.users_level
		}));
		
		res.json({
			draw,
			recordsTotal,
			recordsFiltered,
			data
		});
	
	} catch (error) {
		console.error(error);
		res.status(500).json({ error: 'Server error' });
	}
});

module.exports = router;
