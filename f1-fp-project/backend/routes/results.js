const express = require('express');
const router = express.Router();
const db = require('../db');

// READ
router.get('/', (req, res) => {
  db.query('SELECT * FROM results', (err, data) => {
    if (err) throw err;
    res.json(data);
  });
});

// CREATE
router.post('/', (req, res) => {
  const { season, race, winner, team, points } = req.body;
  db.query(
    'INSERT INTO results (season, race, winner, team, points) VALUES (?,?,?,?,?)',
    [season, race, winner, team, points],
    () => res.json({ message: 'Resultado añadido' })
  );
});

// DELETE
router.delete('/:id', (req, res) => {
  db.query(
    'DELETE FROM results WHERE id = ?',
    [req.params.id],
    () => res.json({ message: 'Resultado eliminado' })
  );
});

module.exports = router;
