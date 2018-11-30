DROP TABLE if exists BookCategories;
DROP TABLE if exists CategoryNames;
DROP TABLE if exists BookAuthors;
DROP TABLE if exists authorNames;
DROP TABLE if exists Books;

create table if not exists Books (
  idBook varchar(70) not null,
  price double not null,
  title varchar(70) not null,
  cover varchar(255) default null,
  description text,
  primary key (idBook)
) engine=InnoDB default charset=utf8mb4;

create table if not exists authorNames (
	idAuthor int not null auto_increment,
	name varchar(70) not null,
	primary key (idAuthor)
) engine=InnoDB default charset=utf8mb4;

create table if not exists BookAuthors (
	idBook varchar(70) not null,
	idAuthor int not null,
	primary key (idAuthor, idBook),
	foreign key (idBook)
   		references Books(idBook)
    	on delete cascade on update cascade,
    foreign key (idAuthor)
   		references authorNames(idAuthor)
    	on delete cascade on update cascade
) engine=InnoDB default charset=utf8mb4;

create table if not exists CategoryNames (
	idCategory int not null auto_increment,
	name varchar(70) not null,
	primary key (idCategory)
) engine=InnoDB default charset=utf8mb4;

create table if not exists BookCategories (
	idBook varchar(70) not null,
	idCategory int not null,
	primary key (idBook, idCategory),
	foreign key (idBook)
   		references Books(idBook)
    	on delete cascade on update cascade,
    foreign key (idCategory)
   		references CategoryNames(idCategory)
    	on delete cascade on update cascade
) engine=InnoDB default charset=utf8mb4;