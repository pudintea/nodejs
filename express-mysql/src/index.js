require('dotenv').config();
const express = require('express')
const app = express()
const port = process.env.PORT || 5000;

const boRoutes = require('./routes/bo.js');
const usersRoutes = require('./routes/users.js');
const middlewareLogRequest = require('./middleware/logs.js');
//MiddleWare
app.use(middlewareLogRequest);
//Middleware untuk mengizinkan semua RiquestBody Berupa Json
app.use(express.json());
// Buat Static File/folder
app.use('/assets',express.static('public'));

app.use('/bo',boRoutes);
app.use('/users',usersRoutes);

app.get('/', (req, res) => {
    res.json({
      message : 'Hallo Wolrd'
    })
})

app.use('/', (req, res) => {
    res.status(404).json({
      message:'404 Not Found !'
    })
})
// Error Handling
app.use((err, req, res, next) =>{
    res.json({
      message: err.message
    })
})
app.listen(port, () => {
  console.log(`App listening on port ${port}`)
})
