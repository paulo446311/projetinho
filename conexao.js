const express = require('express');
const mysql = require('mysql2');
const app = express();
const port = 3000;

// Permitir JSON no corpo das requisições
app.use(express.json());

// Configuração do banco de dados
const db = mysql.createConnection({
    host: 'localhost',
    user: 'seu_usuario',
    password: 'sua_senha',
    database: 'nome_do_banco'
});

// Conectar ao MySQL
db.connect((err) => {
    if(err) {
        console.error('Erro ao conectar:', err);
        return;
    }
    console.log('Conectado ao MySQL');
});

// Rota para buscar dados
app.get('/produtos', (req, res) => {
    db.query('SELECT * FROM produtos', (err, results) => {
        if(err) throw err;
        res.json(results); // envia os dados como JSON
    });
});

// Rota para inserir dados
app.post('/produtos', (req, res) => {
    const { nome, preco } = req.body;
    db.query('INSERT INTO produtos (nome, preco) VALUES (?, ?)', [nome, preco], (err, results) => {
        if(err) throw err;
        res.json({message: 'Produto inserido com sucesso!'});
    });
});

app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});
