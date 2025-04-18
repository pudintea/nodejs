require('dotenv').config();
const express = require('express')
const app = express()
const port = process.env.PORT

// REQ MIDLEWARE
const midRequestLog = require('./middleware/logs')
const verifyToken = require('./middleware/verifyToken')

//REQ ROUTES
const roUsers = require('./routes/users')
const roBo    = require('./routes/bo')

// Midleware
app.disable('x-powered-by');
app.use(midRequestLog)

//Middleware RiquestBody Json
app.use(express.json());

// ROUTES
app.use('/bo', roBo)
app.use('/users', verifyToken, roUsers)

// Route Utama
app.get('/', (req, res) => {
  res.send('Hello World!')
})

// 404 Handler
app.use((req, res, next) => {
  res.status(404).json({ message: 'Not Found!' });
});

// Error Handler
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(err.status || 500).json({
    message: err.message || 'Internal Server Error',
  });
});

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})