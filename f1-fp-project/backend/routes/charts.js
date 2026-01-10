const express = require('express');
const router = express.Router();
const db = require('../db');

router.get('/', (req, res) => {
  db.query(
    'SELECT winner, SUM(points) as total FROM results GROUP BY winner',
    (err, data) => {
      res.json(data);
    }
  );
});

module.exports = router;
