CREATE DATABASE IF NOT EXISTS av1_daw;

USE av1_daw;

-- TABELA DE USUÁRIOS
CREATE TABLE usuarios (
    cpf VARCHAR(14) NOT NULL PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- TABELA DE PERGUNTAS DE MÚLTIPLA ESCOLHA
CREATE TABLE perguntas (
    id_pergunta INT NOT NULL PRIMARY KEY,
    pergunta VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- TABELA DE RESPOSTAS DE MÚLTIPLA ESCOLHA
CREATE TABLE respostas (
    id_pergunta INT NOT NULL,
    id_resposta INT NOT NULL,
    resposta VARCHAR(255) NOT NULL,
    certa TINYINT(1) NOT NULL DEFAULT 0,

    PRIMARY KEY (id_pergunta, id_resposta),

    FOREIGN KEY (id_pergunta)
        REFERENCES perguntas(id_pergunta)
) ENGINE=InnoDB;

-- TABELA DE PERGUNTAS DISCURSIVAS
CREATE TABLE perguntas_discursivas (
    id_pergunta INT NOT NULL PRIMARY KEY,
    pergunta VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- TABELA DE RESPOSTAS DISCURSIVAS
CREATE TABLE respostas_discursivas (
    id_resposta INT NOT NULL PRIMARY KEY,
    id_pergunta INT NOT NULL UNIQUE,
    gabarito VARCHAR(255) NOT NULL,

    FOREIGN KEY (id_pergunta)
        REFERENCES perguntas_discursivas(id_pergunta)
) ENGINE=InnoDB;