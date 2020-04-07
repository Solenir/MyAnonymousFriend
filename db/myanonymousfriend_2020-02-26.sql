-- *****************************************************
-- CRIACAO DO BANCO DE DADOS
-- *****************************************************

CREATE DATABASE DB_myanonymousfriend
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;


USE DB_myanonymousfriend;

-- *****************************************************
-- Tabela..........: USUARIO
-- Elemento do DER.: Entidade Usuario
-- *****************************************************
CREATE TABLE IF NOT EXISTS USUARIO(
  ID_Usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nome VARCHAR(50) NOT NULL,
  Login VARCHAR(40) NOT NULL UNIQUE KEY,
  Senha VARCHAR(62) NOT NULL,
  logado BOOLEAN NOT NULL DEFAULT FALSE
)ENGINE = INNODB;


-- *****************************************************
-- Tabela..........: PUBLICAÇÃO
-- Elemento do DER.: Entidade Publicação
-- *****************************************************
CREATE TABLE IF NOT EXISTS PUBLICACAO (
  ID_Publicacao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,  
  Descricao TEXT
)ENGINE = INNODB;

-- *****************************************************
-- Tabela..........: MENSAGEM
-- Elemento do DER.: Entidade Mensagem
-- *****************************************************
CREATE TABLE IF NOT EXISTS MENSAGEM (
  ID_Mensagem INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idRemetente INT NOT NULL,
  idDestinatario INT NOT NULL,
  Texto TEXT,
  HoraMensagem DATETIME,
  FOREIGN KEY (idRemetente) REFERENCES USUARIO(ID_Usuario),
  FOREIGN KEY (idDestinatario) REFERENCES USUARIO(ID_Usuario)
)ENGINE = InnoDB;