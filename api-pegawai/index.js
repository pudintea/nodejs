const express = require('express')
const app = express()
const port = 3000

const bodyParser = require('body-parser')
app.use(bodyParser.json())

const db = require('./connection')
const response = require('./response')


app.get('/', (req, res) => {
  res.send('Hello World!')
})

app.get('/find', (req, res) => {
    const nip = req.query.nip;
    const sql = `SELECT nip FROM t_pegawai WHERE nip = ${nip}`;
    db.query(sql, [nip], (error, result) => {
        if (error) {
            throw error;
        }
        if (result.length === 1) {
            // console.log(result[0].nip);
            // res.send(result[0]);
            response(200, 'success', res)
        }else if(result.length > 1){
            response(204, 'notcontent', res)
        } else {
            //res.status(404).send("Data not found");
            response(404, 'notfound', res)
        }
    });
});

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})
