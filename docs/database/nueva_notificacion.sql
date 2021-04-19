CREATE TABLE notificaciones(
    id INT AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    producto_id INT NOT NULL,
    titulo VARCHAR(255),
    mensaje VARCHAR(255),
    autor VARCHAR(255) DEFAULT 'SISTEMA',
    repeticion INT(2) DEFAULT 1,
    estatus VARCHAR(15) DEFAULT 'ACTIVO',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT id_impuestos PRIMARY KEY(id),
    CONSTRAINT fk_usuarios_notificaciones 
      FOREIGN KEY(usuario_id) 
      REFERENCES usuarios(id)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
    CONSTRAINT `fk_notificaciones_producto`
      FOREIGN KEY (`producto_id`)
      REFERENCES `world_computer`.`productos` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);