drop table if exists Nasabah;
create table Nasabah (
  idNasabah int not null auto_increment,
  name varchar(50) not null,
  no_kartu int not null,
  saldo int not null,
  picture varchar(64) default '04a924e79f3653cc41556d71550a07fb.png',
  unique key (no_kartu),
  primary key (idNasabah)
) engine=InnoDB default charset=utf8mb4;

drop table if exists Transaksi;
create table Transaksi (
  idTransaksi int not null auto_increment,
  no_kartu_pengirim int not null,
  no_kartu_penerima int not null,
  jumlah int not null,
  waktu_transaksi date not null,
  primary key (idTransaksi),
  foreign key (no_kartu_pengirim)
    references Nasabah(no_kartu)
    on delete cascade on update cascade,
  foreign key (no_kartu_penerima)
    references Nasabah(no_kartu)
    on delete cascade on update cascade
) engine=InnoDB default charset=utf8mb4;