pragma foreign_keys=1;

create table if not exists Users (
  idUser integer not null primary key autoincrement,
  username varchar(20) not null unique,
  password varchar(50) not null,
  name varchar(50) not null,
  email varchar(50) not null,
  address varchar(140) not null,
  phone varchar(12) not null,
  picture varchar(64) default '04a924e79f3653cc41556d71550a07fb.png'
);

create table if not exists Books (
  idBook integer not null primary key autoincrement,
  title varchar(70) not null,
  author varchar(70) not null,
  cover varchar(64) default null,
  description text
);

create table if not exists Transactions (
  idTransaction integer not null primary key autoincrement,
  idBook integer not null,
  idUser integer not null,
  orderDate date not null,
  quantity int not null,
  foreign key (idBook)
    references Books(idBook)
    on delete cascade on update cascade,
  foreign key (idUser)
    references Users(idUser)
    on delete cascade on update cascade
);

create table if not exists Reviews (
  idTransaction integer not null primary key,
  rating int not null,
  comment text,
  foreign key (idTransaction)
    references Transactions(idTransaction)
    on delete cascade on update cascade
);
