DROP TABLE IF EXISTS Transactions;
drop table if exists Customers;

create table Customers(
  idCustomer int not null auto_increment,
  cardNumber varchar(16) NOT NULL,
  balance int NOT NULL,
  PRIMARY KEY (idCustomer),
  UNIQUE KEY (cardNumber)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Transactions (
  idTransaction int NOT NULL AUTO_INCREMENT,
  senderCardNumber varchar(16) NOT NULL,
  receiverCardNumber varchar(16) NOT NULL,
  amount int NOT NULL,
  PRIMARY KEY (idTransaction),
  foreign KEY (senderCardNumber)
    references Customers(cardNumber)
    on delete cascade on update cascade,
  foreign KEY (receiverCardNumber)
    references Customers(cardNumber)
    on delete cascade on update cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

insert into customers(cardNumber,balance) values(0,0);
insert into customers(cardNumber, balance) values(123,10000000);
