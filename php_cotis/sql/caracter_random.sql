CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
caracter_random(caracteres varchar)

-- declaramos lo que retorna
RETURNS varchar AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
numero int;
caracter varchar;

-- definimos nuestra función
BEGIN
    SELECT FLOOR(random()*(length(caracteres))) INTO numero ;
    caracter:=  SUBSTRING(caracteres, numero, 1);
    RETURN caracter;



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql

