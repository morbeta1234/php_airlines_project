DROP TABLE IF EXISTS reservas;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS personas;
DROP TABLE IF EXISTS Image;
DROP TABLE IF EXISTS vuelos;
SET DateStyle TO European;


CREATE TABLE personas(
  id int PRIMARY KEY,
  nombre varchar(150),
  pasaporte varchar(9),
  fecha_nacimiento date
);

CREATE TABLE clientes(
  id int PRIMARY KEY,
  id_persona int,
  FOREIGN KEY(id_persona) REFERENCES personas(id),
  nacionalidad varchar(20),
  pasaporte varchar(9)
);

CREATE TABLE vuelos(
  id int PRIMARY KEY,
  aerodromo_salida_id int, 
  aerodromo_llegada_id int,
  ruta_id int,
  codigo_vuelo varchar(20),
  codigo_aeronave varchar(20),
  codigo_compania varchar(20),
  fecha_salida timestamp,
  fecha_llegada timestamp,
  velocidad float,
  altitud float,
  estado varchar(20)
);

CREATE TABLE Image(
  id serial PRIMARY KEY,
  filename varchar(100)
);

CREATE TABLE reservas(
  reserva_id int,
  codigo_reserva varchar(12),
  numero_ticket int,
  vuelo_id int,
  comprador_id int,
  pasajero_id int,
  numero_asiento int,
  clase varchar(15),
  comida_y_maleta varchar(15),
  FOREIGN KEY(vuelo_id) REFERENCES vuelos(id),
  FOREIGN KEY(comprador_id) REFERENCES clientes(id),
  FOREIGN KEY(pasajero_id) REFERENCES clientes(id)
);

\COPY personas from '../data/personas.csv' DELIMITER ',' CSV HEADER;
\COPY clientes from '../data/clientes.csv' DELIMITER ',' CSV HEADER;
\COPY vuelos from '../data/vuelos_nuevos.csv' DELIMITER ',' CSV HEADER;
\COPY reservas from '../data/reservas_nuevas.csv' DELIMITER ',' CSV HEADER;


