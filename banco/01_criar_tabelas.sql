create table cliente(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    NOME TEXT NOT NULL,
    email TEXT,
    telefone TEXT,
    cidade TEXT
);

CREATE TABLE produto (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    descricao TEXT,
    preco REAL NOT NULL,
    imagem TEXT
);

CREATE TABLE venda (
    id INTERGER PRIMARY KEY AUTOINCREMENT,
    cliente_id INTEGER NOT NULL,
    produto_id INTEGER NOT NULL,
    quantidade INTEGER NOT NULL,
    valor_total REAL NOT NULL, 
    data_venda TEXT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id),
    FOREIGN KEY (produto_id) REFERENCES (id)

);