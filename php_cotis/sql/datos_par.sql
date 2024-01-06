-- Eliminamos las tablas si es que estas existÃ­an antes

DROP TABLE Vuelo CASCADE;
DROP TABLE Aeronave CASCADE; 
DROP TABLE Compania CASCADE;
DROP TABLE FPL CASCADE;
DROP TABLE Operacion CASCADE;
DROP TABLE Aerodromo CASCADE;
DROP TABLE Pista CASCADE;
DROP TABLE PuertoEmbarque CASCADE;
DROP TABLE Ciudad CASCADE;
DROP TABLE Licencia CASCADE;
DROP TABLE Certificado CASCADE;
DROP TABLE Punto CASCADE;
DROP TABLE Ruta CASCADE;

-- Creamos las tablas con sus respectivos atributos
CREATE TABLE Licencia(certificado_id INT, fecha_habilitacion DATE, fecha_termino DATE, categoria varchar(30), pasaporte varchar(9));
CREATE TABLE Ciudad(nombre_ciudad varchar(30) , nombre_pais varchar(30));
CREATE TABLE Punto(nombre_punto varchar(6) , latitud float, longitud float);
CREATE TABLE Aeronave(nombre_aeronave varchar(30), modelo_aeronave varchar(30), peso_aeronave float, codigo_aeronave varchar(7) );
CREATE TABLE Compania(nombre_compania varchar(30), codigo_compania varchar(3) );
CREATE TABLE Ruta(ruta_id INT , nombre_ruta varchar(6), cardinalidad INT, nombre_punto varchar(6));
CREATE TABLE Certificado(certificado_id INT, fecha_habilitacion DATE, fecha_termino DATE, codigo_aeronave varchar(7));
CREATE TABLE Aerodromo(aerodromo_id INT , nombre varchar(100), codigo_ICAO varchar(4), codigo_IATA varchar(3), latitud float, longitud float, nombre_ciudad varchar(30));
CREATE TABLE Vuelo(propuesta_vuelo_id INT , codigo varchar(20), fecha_salida timestamp, fecha_llegada timestamp, aerodromo_salida_id INT, aerodromo_llegada_id INT, codigo_aeronave varchar(7), codigo_compania varchar(3));
CREATE TABLE Pista(aerodromo_id INT, codigo_pista varchar(3) );
CREATE TABLE PuertoEmbarque(aerodromo_id INT , codigo_puerto_embarque INT);
CREATE TABLE FPL(fpl_id INT , propuesta_vuelo_id INT, estado varchar(10), codigo varchar(7), fecha_salida timestamp, fecha_llegada timestamp, aerodromo_salida_id INT, aerodromo_llegada_id INT, codigo_aeronave varchar(7), fecha_envio_propuesta DATE, codigo_compania varchar(3), ruta_id varchar(20), velocidad float, altitud float, tipo_vuelo varchar(30), max_pasajeros float, realizado varchar(12), pasaporte_piloto varchar(9), pasaporte_copiloto varchar(9));
CREATE TABLE Operacion(operacion_id INT, fpl_id INT, aerodromo_despegue INT, aerodromo_arribo INT, fecha_arribo timestamp, codigo_pista_arribo varchar(3), codigo_puerto_embarque_arribo INT, fecha_despegue timestamp, codigo_pista_despuegue varchar(3), codigo_puerto_embarque_despuegue INT, codigo_aeronave varchar(7));







-- Migramos los datos de los archivos
\COPY Aerodromo from '../data/aerodromos.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Aeronave from '../data/aeronaves.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Certificado from '../data/certificados.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Ciudad from '../data/ciudades.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Compania from '../data/companias.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY FPL from '../data/fpl.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Licencia from '../data/licencias.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Operacion from '../data/operaciones.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Pista from '../data/pistas.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY PuertoEmbarque from '../data/csv/puertos_embarque.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Punto from '../data/csv/puntos.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Ruta from '../data/csv/rutas.csv' DELIMITER ',' NULL AS '' CSV HEADER;
\COPY Vuelo from '../data/csv/vuelos.csv' DELIMITER ',' NULL AS '' CSV HEADER;
