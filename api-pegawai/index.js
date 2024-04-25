const express = require('express')
const app = express()
const port = 3000

const bodyParser = require('body-parser')
app.use(bodyParser.json())

const db = require('./connection')
const response = require('./response')


app.get('/', (req, res) => {
  res.send('Selamat Datang !')
})

app.get('/find', (req, res) => {
    const nip = req.query.nip;
    if (!nip) {
        res.send('Tidak ada data yang dikirim !');
    } else {
        const sql = `SELECT nip FROM t_pegawai WHERE nip = ${nip}`;
        db.query(sql, [nip], (error, result) => {
            if (error) {
                throw error;
            }

            if (result.length === 1) {
                //res.status(200).send('success');
                response(200, 'success', res)
            } else if (result.length > 1) {
                //res.status(204).send('notcontent');
                response(204, 'notcontent', res)
            } else {
                //res.status(404).send("Data not found");
                response(404, 'Data not found', res)
            }
        });
    }
});

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})
