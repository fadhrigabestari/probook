drop table if exists Reviews;
drop table if exists Transactions;
drop table if exists BookCategories;
drop table if exists categoryNames;
drop table if exists Books;
drop table if exists Users;


create table if not exists Users (
  idUser int not null auto_increment,
  username varchar(20) not null,
  password varchar(50) not null,
  name varchar(50) not null,
  email varchar(50) not null,
  address varchar(140) not null,
  phone varchar(12) not null,
  cardNumber int not null,
  picture varchar(64) default '04a924e79f3653cc41556d71550a07fb.png',
  unique key (username),
  primary key (idUser)
) engine=InnoDB default charset=utf8mb4;

create table if not exists Books (
  idBook varchar(100) not null,
  primary key (idBook)
) engine=InnoDB default charset=utf8mb4;

create table if not exists CategoryNames (
  idCategory int not null auto_increment,
  name varchar(255) not null,
  primary key (idCategory)
) engine=InnoDB default charset=utf8mb4;

create table if not exists BookCategories (
  idBook varchar(100) not null,
  idCategory int not null,
  primary key (idBook, idCategory),
  foreign key (idBook)
      references Books(idBook)
      on delete cascade on update cascade,
    foreign key (idCategory)
      references CategoryNames(idCategory)
      on delete cascade on update cascade
) engine=InnoDB default charset=utf8mb4;

create table if not exists Transactions (
  idTransaction int not null auto_increment,
  idBook varchar(100) not null,
  idUser int not null,
  orderDate date not null,
  quantity int not null,
  primary key (idTransaction),
  foreign key (idBook)
    references Books(idBook)
    on delete cascade on update cascade,
  foreign key (idUser)
    references Users(idUser)
    on delete cascade on update cascade
) engine=InnoDB default charset=utf8mb4;

create table if not exists Reviews (
  idTransaction int not null,
  rating int not null,
  comment text,
  primary key (idTransaction),
  foreign key (idTransaction)
    references Transactions(idTransaction)
    on delete cascade on update cascade
) engine=InnoDB default charset=utf8mb4;
