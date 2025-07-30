const express = require('express');
const axios = require('axios');
const cors = require('cors');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 3000;

// 🔐 Ton token GitHub personnel
const GITHUB_TOKEN = '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';

app.use(cors());
app.use(express.json());
app.use(express.static(path.join(__dirname, '.')));

app.post('/download', async (req, res) => {
  const { url } = req.body;

  if (!url || !url.includes('github.com')) {
    return res.status(400).send('Lien GitHub invalide.');
  }

  const [, , , user, repo] = url.split('/');
  const zipUrl = `https://api.github.com/repos/${user}/${repo}/zipball`;

  try {
    const response = await axios.get(zipUrl, {
      responseType: 'stream',
      headers: {
        Authorization: `token ${GITHUB_TOKEN}`,
        'User-Agent': 'GitHubDownloader'
      }
    });

    res.setHeader('Content-Disposition', `attachment; filename=${repo}.zip`);
    response.data.pipe(res);
  } catch (err) {
    res.status(500).send('Erreur : ' + err.message);
  }
});

app.listen(PORT, () => {
  console.log(`✅ Serveur en cours sur http://localhost:${PORT}`);
});
