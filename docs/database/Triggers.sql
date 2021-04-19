-- Registrar
CREATE TRIGGER `clientes_ai` AFTER INSERT ON `clientes` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Clientes",CONCAT('Registro de "',NEW.documento,' - ',NEW.nombre,' ',NEW.apellido,'"'));

CREATE TRIGGER `empleados_ai` AFTER INSERT ON `empleados` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Empleados",CONCAT('Registro de "',NEW.documento,' - ',NEW.nombre,' ',NEW.apellido,'"'));

CREATE TRIGGER `proveedores_ai` AFTER INSERT ON `proveedores` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Proveedores",CONCAT('Registro de "',NEW.documento,' - ',NEW.razon_social,'"'));

CREATE TRIGGER `usuarios_ai` AFTER INSERT ON `usuarios` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Usuarios",CONCAT('Registro de "',NEW.documento,' - ',NEW.nombre,' ',NEW.apellido,'"'));

CREATE TRIGGER `categorias_ai` AFTER INSERT ON `categorias` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Categorías",CONCAT('Registro de "',NEW.nombre,'"'));

CREATE TRIGGER `productos_ai` AFTER INSERT ON `productos` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Productos",CONCAT('Registro de "',NEW.codigo,' - ',NEW.nombre,'"'));

CREATE TRIGGER `roles_ai` AFTER INSERT ON `roles` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Roles",CONCAT('Registro de "',NEW.nombre,'"'));

CREATE TRIGGER `servicios_ai` AFTER INSERT ON `servicios` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Servicios",CONCAT('Registro de "',NEW.nombre,'"'));

CREATE TRIGGER `compras_ai` AFTER INSERT ON `compras` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Compras",CONCAT('Registro de Compra<br>Código: ',NEW.codigo));

CREATE TRIGGER `servicios_prestados_ai` AFTER INSERT ON `servicios_prestados` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Servicios Prestados",CONCAT('Registro de Servicio Prestado<br>Código: ',NEW.codigo));

CREATE TRIGGER `ventas_ai` AFTER INSERT ON `ventas` FOR EACH ROW 
    INSERT INTO bitacora(usuario_id, modulo, accion) 
    VALUES (@usuario_id,"Ventas",CONCAT('Registro de Venta<br>Código: ',NEW.codigo));


-- Modificaciones y eliminaciones lógicas
-- Clientes
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `clientes_bu` BEFORE UPDATE ON `clientes`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Clientes",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Clientes",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Clientes",CONCAT('Actualización de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Nombre: ',OLD.nombre,' ',OLD.apellido,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Nombre: ',NEW.nombre,' ',NEW.apellido,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Empleados
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `empleados_bu` BEFORE UPDATE ON `empleados`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Empleados",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Empleados",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Empleados",CONCAT('Actualización de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Nombre: ',OLD.nombre,' ',OLD.apellido,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            'Cargo: ',OLD.cargo,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Nombre: ',NEW.nombre,' ',NEW.apellido,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>',
            'Cargo: ',NEW.cargo,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Proveedores
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `proveedores_bu` BEFORE UPDATE ON `proveedores`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Proveedores",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.razon_social,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Proveedores",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.razon_social,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Proveedores",CONCAT('Actualización de "',OLD.documento,' - ',OLD.razon_social,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Razón Social: ',OLD.razon_social,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Razón Social: ',NEW.razon_social,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Usuarios
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `usuarios_bu` BEFORE UPDATE ON `usuarios`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Usuarios",CONCAT('Habilitación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Usuarios",CONCAT('Eliminación de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'));
        END IF;
    ELSE 
        SET @rol_name = (SELECT nombre FROM `roles` WHERE id=OLD.rol_id);
        SET @rol_name_new = (SELECT nombre FROM `roles` WHERE id=NEW.rol_id);
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Usuarios",CONCAT('Actualización de "',OLD.documento,' - ',OLD.nombre,' ',OLD.apellido,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Documento: ',OLD.documento,'<br>',
            'Nombre: ',OLD.nombre,' ',OLD.apellido,'<br>',
            'Dirección: ',OLD.direccion,'<br>',
            'Teléfono: ',OLD.telefono,'<br>',
            'E-mail: ',OLD.email,'<br>',
            'Usuario: ',OLD.usuario,'<br>',
            'Rol: ',@rol_name,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Documento: ',NEW.documento,'<br>',
            'Nombre: ',NEW.nombre,' ',NEW.apellido,'<br>',
            'Dirección: ',NEW.direccion,'<br>',
            'Teléfono: ',NEW.telefono,'<br>',
            'E-mail: ',NEW.email,'<br>',
            'Usuario: ',NEW.usuario,'<br>',
            'Rol: ',@rol_name_new,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Categorías
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `categorias_bu` BEFORE UPDATE ON `categorias`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Categorías",CONCAT('Habilitación de "',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Categorías",CONCAT('Eliminación de "',OLD.nombre,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Categorías",CONCAT('Actualización de "',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Productos
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `productos_bu` BEFORE UPDATE ON `productos`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Productos",CONCAT('Habilitación de "',OLD.codigo,' - ',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Productos",CONCAT('Eliminación de "',OLD.codigo,' - ',OLD.nombre,'"'));
        END IF;
    ELSE 
        SET @categoria_name = (SELECT nombre FROM `categorias` WHERE id=OLD.categoria_id);
        SET @categoria_name_new = (SELECT nombre FROM `categorias` WHERE id=NEW.categoria_id);
        SET @unidad_name = (SELECT nombre FROM `unidades` WHERE id=OLD.unidad_id);
        SET @unidad_name_new = (SELECT nombre FROM `unidades` WHERE id=NEW.unidad_id);
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Productos",CONCAT('Actualización de "',OLD.codigo,' - ',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Código: ',OLD.codigo,'<br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            'Margén de Ganacia: ',OLD.precio_porcentaje,'<br>',
            'Stock Min.: ',OLD.stock_min,'<br>',
            'Stock Max.: ',OLD.stock_max,'<br>',
            'Categoría: ',@categoria_name,'<br>',
            'Unidad: ',@unidad_name,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Código: ',NEW.codigo,'<br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>',
            'Margén de Ganacia: ',NEW.precio_porcentaje,'<br>',
            'Stock Min.: ',NEW.stock_min,'<br>',
            'Stock Max.: ',NEW.stock_max,'<br>',
            'Categoría: ',@categoria_name_new,'<br>',
            'Unidad: ',@unidad_name_new,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Servicios
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `servicios_bu` BEFORE UPDATE ON `servicios`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Servicios",CONCAT('Habilitación de "',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Servicios",CONCAT('Eliminación de "',OLD.nombre,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Servicios",CONCAT('Actualización de "',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            'Precio: ',OLD.precio,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>'
            'Precio: ',NEW.precio,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Roles
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `roles_bu` BEFORE UPDATE ON `roles`
FOR EACH ROW
BEGIN
    IF(NEW.estatus != OLD.estatus) THEN
        IF(NEW.estatus = 'ACTIVO') THEN
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Roles",CONCAT('Habilitación de "',OLD.nombre,'"'));
        ELSE
            INSERT INTO bitacora(usuario_id, modulo, accion) 
            VALUES (@usuario_id,"Roles",CONCAT('Eliminación de "',OLD.nombre,'"'));
        END IF;
    ELSE 
        INSERT INTO bitacora(usuario_id, modulo, accion, descripcion) 
        VALUES (@usuario_id,"Roles",CONCAT('Actualización de "',OLD.nombre,'"'),
        CONCAT('<b>Información Anterior:</b><br>',
            'Nombre: ',OLD.nombre,'<br>',
            'Descripción: ',OLD.descripcion,'<br>',
            '<br><b>Información Actual:</b><br>',
            'Nombre: ',NEW.nombre,'<br>',
            'Descripción: ',NEW.descripcion,'<br>'
            ));
    END IF;
END;$$
DELIMITER ;
-- Compras
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `compras_bu` BEFORE UPDATE ON `compras`
FOR EACH ROW
BEGIN
    IF(NEW.estatus = 'ACTIVO') THEN
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Compras",CONCAT('Habilitación de "',OLD.codigo,'"'));
    ELSE
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Compras",CONCAT('Anulación de "',OLD.codigo,'"'));
    END IF;
END;$$
DELIMITER ;
-- Servicios Prestados
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `servicios_prestados_bu` BEFORE UPDATE ON `servicios_prestados`
FOR EACH ROW
BEGIN
    IF(NEW.estatus = 'ACTIVO') THEN
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Servicios Prestados",CONCAT('Habilitación de "',OLD.codigo,'"'));
    ELSE
        INSERT INTO bitacora(usuario_id, modulo, accion)
        VALUES (@usuario_id,"Servicios Prestados",CONCAT('Anulación de "',OLD.codigo,'"'));
    END IF;
END;$$
DELIMITER ;
-- Ventas
DELIMITER $$
CREATE TRIGGER IF NOT EXISTS `ventas_bu` BEFORE UPDATE ON `ventas`
FOR EACH ROW
BEGIN
    IF(NEW.estatus = 'ACTIVO') THEN
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Ventas",CONCAT('Habilitación de "',OLD.codigo,'"'));
    ELSE
        INSERT INTO bitacora(usuario_id, modulo, accion) 
        VALUES (@usuario_id,"Ventas",CONCAT('Anulación de "',OLD.codigo,'"'));
    END IF;
END;$$
DELIMITER ;