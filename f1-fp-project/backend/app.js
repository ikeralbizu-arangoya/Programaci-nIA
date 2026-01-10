const express = require('express');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

app.use('/results', require('./routes/results'));
app.use('/merch', require('./routes/merch'));
app.use('/news', require('./routes/news'));
app.use('/tickets', require('./routes/tickets'));
app.use('/charts', require('./routes/charts'));

app.listen(3000, () => {
  console.log('Servidor en http://localhost:3000');
});
