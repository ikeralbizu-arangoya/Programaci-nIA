const mysql = require('mysql');

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'f1fp'
});

db.connect(err => {
  if (err) throw err;
  console.log('MySQL conectado');
});

module.exports = db;
