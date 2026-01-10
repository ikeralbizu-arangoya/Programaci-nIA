const express = require('express');
const router = express.Router();
const db = require('../db');

router.get('/', (req, res) => {
  db.query('SELECT * FROM tickets', (err, data) => {
    if (err) throw err;
    res.json(data);
  });
});

router.post('/buy', (req, res) => {
  const { buyer, race } = req.body;
  db.query(
    'INSERT INTO purchases (buyer, race) VALUES (?,?)',
    [buyer, race],
    () => res.json({ message: 'Compra realizada' })
  );
});

module.exports = router;
