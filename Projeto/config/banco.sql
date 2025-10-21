create database if not exists svelte;
use svelte;


CREATE TABLE usuario (
  email VARCHAR(45) PRIMARY KEY,
  nome VARCHAR(45),
  senha VARCHAR(255)
) ENGINE=InnoDB;

create table adm(
	id int auto_increment PRIMARY KEY,
	usuario VARCHAR(45),
  senha VARCHAR(45)
) ENGINE=InnoDB;

CREATE TABLE produto (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  descricao TEXT
) ENGINE=InnoDB;  

insert into adm values("","Thgrasnudo", "yes");
insert into adm values("","ohyes", "yes");
insert into adm values("","fuckgrasny", "no");