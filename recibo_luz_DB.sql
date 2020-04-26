drop database if exists recibo_luz;
create database recibo_luz;
use recibo_luz;

create table toma_recibo(
id int not null auto_increment,
fecha date not null,
valor int not null,
num_kilovatio int not null,
primary key(id)
);


create table tipo (
id int not null auto_increment,
valor int not null,
primary key(id)
);
insert into tipo values(null,550);

insert into toma_recibo values (null,"2020-02-12",550,5210);
insert into toma_recibo values (null,"2020-03-03",550,5252);



