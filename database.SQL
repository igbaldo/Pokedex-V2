Drop Database if exists pokemonsBaldoIgnacio;
Create Database pokemonsBaldoIgnacio;

Use pokemonsBaldoIgnacio;

Create Table Genero(
Id Tinyint PRIMARY KEY AUTO_INCREMENT,
Descripcion Varchar (10),
Imagen Varchar(500));

Create Table Tipo(
Id Tinyint PRIMARY KEY AUTO_INCREMENT,
Descripcion Varchar (10),
Imagen Varchar(500));

Create Table Pokemon(
Id Tinyint PRIMARY KEY AUTO_INCREMENT,
Descripcion Varchar (25),
Ataque Varchar (50),
Imagen Varchar(500),
IdGenero Tinyint,
IdTipo Tinyint,
FOREIGN KEY (IdGenero) references Genero (Id),
FOREIGN KEY (IdTipo) references Tipo (Id));

Create Table Usuario(
IdUsuario Tinyint PRIMARY KEY AUTO_INCREMENT,
Usuario Varchar (50),
Clave Varchar (50));


Insert into Genero (Descripcion, Imagen)
Values 	
("Masculino"," http://downloadicons.net/sites/default/files/woman-sex-symbol-icon-63284.png"),
("Femenino"," https://png.icons8.com/metro/1600/male.png");

Insert Into Tipo (Descripcion, Imagen)
Values 
("Fuego","https://vignette.wikia.nocookie.net/es.pokemon/images/c/ce/Tipo_fuego.gif/revision/latest?cb=20170114100331s"),
("Electrico","https://vignette.wikia.nocookie.net/es.pokemon/images/1/1b/Tipo_el%C3%A9ctrico.gif/revision/latest?cb=20170114100155"),
("Agua"," https://vignette.wikia.nocookie.net/pokemon-planet/images/5/5b/Bulbasaur_by_elfaceitoso.png/revision/latest?cb=20161115042430");

Insert Into Pokemon (Descripcion, Ataque, Imagen, IdGenero, IdTipo)
Values  
("Charmander","Fuego Fatuo", "https://vignette.wikia.nocookie.net/es.pokemon/images/b/be/Charmander_%28anime_SO%29.png/revision/latest?cb=20120906002506",1,1),
("Pikachu","ImpacTrueno","https://vignette.wikia.nocookie.net/new-fantendo/images/7/77/Pikachu.png/revision/latest?cb=20141022175016&path-prefix=es",2,2),
("Bulbasaur","Latigo Cepa"," https://vignette.wikia.nocookie.net/pokemon-planet/images/5/5b/Bulbasaur_by_elfaceitoso.png/revision/latest?cb=20161115042430",1,3);

Insert Into Usuario(Usuario, Clave)
Values("admin","admin");
