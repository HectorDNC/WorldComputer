DROP TRIGGER IF EXISTS detalle_venta_au;



DELIMITER $$

CREATE TRIGGER detalle_venta_au
    AFTER INSERT
    ON detalle_venta FOR EACH ROW
BEGIN
	SET @stock_min = (SELECT stock_min FROM productos WHERE id=NEW.producto_id);
	SET @stock_actual = (SELECT stock FROM v_inventario WHERE id=NEW.producto_id);
	IF(@stock_actual <= @stock_min) THEN
	    INSERT INTO notificaciones(usuario_id,titulo, mensaje)
	    VALUES (1, 'Alerta', CONCAT('Bajo stock de producto id: "',NEW.producto_id,'"'));
	END IF;
END$$    

DELIMITER ;