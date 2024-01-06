DROP FUNCTION id_res();
CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
id_res()

-- declaramos lo que retorna
RETURNS int AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
lts varchar;
Result int;
reserva int;
id_r varchar;

-- definimos nuestra función
BEGIN
    lts = '1234567890';
    id_r := concat(caracter_random(lts),caracter_random(lts),caracter_random(lts),caracter_random(lts),caracter_random(lts));
    SELECT CAST(id_r AS INT) INTO Result;
    SELECT * INTO reserva FROM reservas WHERE reserva_id = Result;
    IF reserva IS NULL THEN
    RETURN Result;
    ELSE
    RETURN id_res();
    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql