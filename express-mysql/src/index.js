require('dotenv').config();
const express = require('express')
const app = express()
const port = process.env.PORT || 5000;

const boRoutes = require('./routes/bo.js');
const usersRoutes = require('./routes/users.js');
const middlewareLogRequest = require('./middleware/logs.js');

// Untuk mencegah header yang bisa memberi tahu bahwa backend kamu pakai Express
app.disable('x-powered-by');

//MiddleWare
app.use(middlewareLogRequest);
//Middleware untuk mengizinkan semua RiquestBody Berupa Json
app.use(express.json());
// Buat Static File/folder
app.use('/assets',express.static('public'));

// Handel Routes
app.use('/bo',boRoutes);
app.use('/users',usersRoutes);

// Route Utama
app.get('/', (req, res) => {
    res.json({
      message : 'Hallo Wolrd'
    })
})

// 404 Handler
app.use((req, res, next) => {
  res.status(404).json({ message: '404 Not Found!' });
});

// Error Handler
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(err.status || 500).json({
    message: err.message || 'Internal Server Error',
  });
});

app.listen(port, () => {
  console.log(`App listening on port ${port}`)
})
