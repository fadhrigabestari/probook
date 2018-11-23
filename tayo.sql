create table if not exists Users (
  idUser int not null auto_increment,
  username varchar(20) not null,
  password varchar(50) not null,
  name varchar(50) not null,
  email varchar(50) not null,
  address varchar(140) not null,
  phone varchar(12) not null,
  picture varchar(64) default '04a924e79f3653cc41556d71550a07fb.png',
  unique key (username),
  primary key (idUser)
) engine=InnoDB default charset=utf8mb4;

create table if not exists Books (
  idBook int not null auto_increment,
  title varchar(70) not null,
  author varchar(70) not null,
  cover varchar(64) default null,
  description text,
  primary key (idBook)
) engine=InnoDB default charset=utf8mb4;

create table if not exists Transactions (
  idTransaction int not null auto_increment,
  idBook int not null,
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
