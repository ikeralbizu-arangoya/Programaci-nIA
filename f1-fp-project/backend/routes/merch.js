const express = require('express');
const router = express.Router();
const db = require('../db');

router.get('/', (req, res) => {
  db.query('SELECT * FROM merch', (err, data) => {
    if (err) throw err;
    res.json(data);
  });
});

module.exports = router;
