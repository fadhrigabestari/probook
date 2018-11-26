drop table if exists Customers;
create table Customers (
  idCustomer int not null auto_increment,
  cardNumber varchar(16) not null unique,
  name varchar(50) not null,
  balance int not null,
  primary key (idCustomer)
) engine=InnoDB default charset=utf8mb4;

drop table if exists Transactions;
create table Transactions (
  idTransaction int not null auto_increment,
  senderCardNumber varchar(16) not null,
  receiverCardNumber varchar(16) not null,
  amount int not null,
  transactionTime datetime not null,
  primary key (idTransaction),
  foreign key (senderCardNumber)
    references Customers(cardNumber)
    on delete cascade on update cascade,
  foreign key (receiverCardNumber)
    references Customers(cardNumber)
    on delete cascade on update cascade
) engine=InnoDB default charset=utf8mb4;
