DROP FUNCTION reserva;
CREATE OR REPLACE FUNCTION reserva
    (pasaporte_pasajero1 varchar, pasaporte_pasajero2 varchar,pasaporte_pasajero3 varchar,comprador_id int, id_v int)
RETURNS text AS $$
DECLARE
    pasajero1 RECORD;
    pasajero2 RECORD;
    pasajero3 RECORD;
    comprador RECORD;
    v_comprar RECORD;
    topes11 RECORD;
    topes12 RECORD;
    topes21 RECORD;
    topes31 RECORD;
    topes22 RECORD;
    topes32 RECORD;
    cod_r varchar;
    lts varchar;
    reserva_id int;
    numero_ticket int;

BEGIN
    
    SELECT * INTO pasajero1 FROM (SELECT clientes.id AS id_cliente, id_persona, pasaporte FROM clientes) as clientes, personas WHERE id_persona = personas.id and pasaporte_pasajero1 = clientes.pasaporte LIMIT 1;
    SELECT * INTO pasajero2 FROM (SELECT clientes.id AS id_cliente, id_persona, pasaporte FROM clientes) as clientes, personas WHERE id_persona = personas.id and pasaporte_pasajero2 = clientes.pasaporte LIMIT 1;
    SELECT * INTO pasajero3 FROM (SELECT clientes.id AS id_cliente, id_persona, pasaporte FROM clientes) as clientes, personas WHERE id_persona = personas.id and pasaporte_pasajero3 = clientes.pasaporte LIMIT 1;
    lts := 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    IF pasajero1.id_cliente = pasajero2.id_cliente OR pasajero1.id_cliente = pasajero3.id_cliente OR pasajero2.id_cliente = pasajero3.id_cliente THEN
    RETURN 'Ingrese una sola vez el pasajero. Inténtelo denuevo.';
    END IF;
    
    IF pasajero1 IS NULL and pasaporte_pasajero1 != '' THEN
    RETURN 'No se encuetra registrado pasajero 1.';
    END IF;
    IF pasajero2 IS NULL and pasaporte_pasajero2 != '' THEN
    
    RETURN 'No se encuetra registrado pasajero 2';
    END IF;
    IF pasajero3 IS NULL and pasaporte_pasajero3 != '' THEN
    RETURN 'No se encuetra registrado pasajero 3';
    
    END IF;
    SELECT fecha_salida, fecha_llegada, vuelos.id INTO v_comprar FROM vuelos WHERE vuelos.id = id_v AND vuelos.estado = "aceptado";
    IF v_comprar IS NULL THEN
    RETURN 'No se encuetra registrado pasajero 3';
    
    END IF;
    -- SELECT * INTO vuelos_p1 FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero1.id_cliente;
    -- SELECT * INTO vuelos_p2 FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero2.id_cliente;
    -- SELECT * INTO vuelos_p3 FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero3.id_cliente;
    RAISE NOTICE 'vamos bien acá';

    
    SELECT * INTO topes11 
    from (SELECT * FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero1.id_cliente AND vuelos.estado = 'aceptado') as vuelos_p1 
    WHERE v_comprar.fecha_salida BETWEEN vuelos_p1.fecha_salida AND vuelos_p1.fecha_llegada;
    SELECT * INTO topes21 
    from (SELECT * FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero2.id_cliente AND vuelos.estado = 'aceptado') as vuelos_p2 
    WHERE v_comprar.fecha_salida BETWEEN vuelos_p2.fecha_salida AND vuelos_p2.fecha_llegada;
    SELECT * INTO topes31 
    from (SELECT * FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero3.id_cliente AND vuelos.estado = 'aceptado') as vuelos_p3 
    WHERE v_comprar.fecha_salida BETWEEN vuelos_p3.fecha_salida AND vuelos_p3.fecha_llegada;

    SELECT * INTO topes12 
    from (SELECT * FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero1.id_cliente AND vuelos.estado = 'aceptado') as vuelos_p1 
    WHERE v_comprar.fecha_llegada BETWEEN vuelos_p1.fecha_salida AND vuelos_p1.fecha_llegada;
    SELECT * INTO topes22 
    from (SELECT * FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero2.id_cliente AND vuelos.estado = 'aceptado') as vuelos_p2 
    WHERE v_comprar.fecha_llegada BETWEEN vuelos_p2.fecha_salida AND vuelos_p2.fecha_llegada;
    SELECT * INTO topes32 
    from (SELECT * FROM reservas, vuelos WHERE reservas.vuelo_id = vuelos.id AND reservas.pasajero_id = pasajero3.id_cliente AND vuelos.estado = 'aceptado') as vuelos_p3 
    WHERE v_comprar.fecha_llegada BETWEEN vuelos_p3.fecha_salida AND vuelos_p3.fecha_llegada;
    
    -- SELECT * INTO topes11 from vuelos_p1, v_comprar WHERE v_comprar.fecha_llegada BETWEEN vuelos_p1.fecha_salida AND vuelos_p1.fecha_llegada;

    -- SELECT * INTO topes11 from vuelos_p1, v_comprar WHERE vuelos_p1.fecha_salida BETWEEN v_comprar.fecha_salida AND  v_comprar.fecha_llegada;
    -- SELECT * INTO topes12 from vuelos_p1, v_comprar WHERE vuelos_p1.fecha_llegada BETWEEN v_comprar.fecha_salida AND  v_comprar.fecha_salida;
    -- SELECT * INTO topes21 from vuelos_p2, v_comprar WHERE vuelos_p2.fecha_llegada BETWEEN v_comprar.fecha_salida AND  v_comprar.fecha_salida;
    -- SELECT * INTO topes22 from vuelos_p2, v_comprar WHERE vuelos_p2.fecha_salida BETWEEN v_comprar.fecha_salida AND  v_comprar.fecha_llegada;
    -- SELECT * INTO topes31 from vuelos_p3, v_comprar WHERE vuelos_p3.fecha_salida BETWEEN v_comprar.fecha_salida AND  v_comprar.fecha_llegada;
    -- SELECT * INTO topes32 from vuelos_p3, v_comprar WHERE vuelos_p3.fecha_llegada BETWEEN v_comprar.fecha_salida AND  v_comprar.fecha_salida;
    
    IF topes11 IS NOT NULL OR topes12 IS NOT NULL THEN
    RETURN 'Existe un tope de vuelo para pasajero 1';
    END IF;
    IF topes21 IS NOT NULL OR topes22 IS NOT NULL THEN
    RETURN 'Existe un tope de vuelo para pasajero 2';
    END IF;
    IF topes31 IS NOT NULL OR topes32 IS NOT NULL THEN
    RETURN 'Existe un tope de vuelo para pasajero 3';
    END IF;
    cod_r := concat(caracter_random(lts),caracter_random(lts),caracter_random(lts),caracter_random(lts),caracter_random(lts),caracter_random(lts),caracter_random(lts));
    reserva_id := id_res();
    
    IF pasajero1 IS NOT NULL AND topes11 IS NULL AND topes12 IS NULL THEN
    numero_ticket := numero_asiento(id_v);

    INSERT INTO reservas (
      reserva_id, codigo_reserva, numero_ticket, vuelo_id, comprador_id, pasajero_id, numero_asiento, clase, comida_y_maleta
    ) VALUES (
      reserva_id, cod_r, numero_ticket, id_v, comprador_id, pasajero1.id_cliente, numero_ticket, 'Economica', 'VERDADERO'
    );
    RAISE NOTICE 'Se creo reserva para pasajero 1';
    END IF;

    IF pasajero2 IS NOT NULL AND topes21 IS NULL AND topes22 IS NULL THEN
    numero_ticket := numero_asiento(id_v);
    INSERT INTO reservas (
      reserva_id, codigo_reserva, numero_ticket, vuelo_id, comprador_id, pasajero_id, numero_asiento, clase, comida_y_maleta
    ) VALUES (
      reserva_id, cod_r, numero_ticket, id_v, comprador_id, pasajero2.id_cliente, numero_ticket, 'Economica', 'VERDADERO'
    );
    RAISE NOTICE 'Se creo reserva para pasajero 1';
    END IF;

    IF pasajero3 IS NOT NULL AND topes31 IS NULL AND topes32 IS NULL THEN
    numero_ticket := numero_asiento(id_v);
    INSERT INTO reservas (
      reserva_id, codigo_reserva, numero_ticket, vuelo_id, comprador_id, pasajero_id, numero_asiento, clase, comida_y_maleta
    ) VALUES (
      reserva_id, cod_r, numero_ticket, id_v, comprador_id, pasajero3.id_cliente, numero_ticket, 'Economica', 'VERDADERO'
    );
    END IF;
    
    RETURN '¡Se ha generado la reserva!';
END
$$ language plpgsql

select * from vuelos, aerodromo where vuelos.aerodromo_llegada_id = aerodromo.aerodromo_id AND vuelos.estado = 'aceptado' AND vuelos.id = 57;
select * from vuelos, aerodromo where vuelos.aerodromo_salida_id = aerodromo.aerodromo_id AND vuelos.estado = 'aceptado'