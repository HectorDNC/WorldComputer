SET FOREIGN_KEY_CHECKS=0;
SET @usuario_id=1;

SET CHARACTER SET utf8; 
TRUNCATE TABLE bitacora;
INSERT INTO bitacora VALUES("1","2021-02-12 17:23:16","Compras","Registro de Compra<br>Código: 000000004","","1");
INSERT INTO bitacora VALUES("2","2021-02-12 17:23:16","Productos","Actualización de \"P456125 - ROUTER 3400\"","","1");
INSERT INTO bitacora VALUES("3","2021-02-12 17:24:51","Ventas","Registro de Venta<br>Código: 000000004","","1");
INSERT INTO bitacora VALUES("4","2021-02-12 17:25:44","Compras","Registro de Compra<br>Código: 000000005","","1");
INSERT INTO bitacora VALUES("5","2021-02-12 17:25:44","Productos","Actualización de \"P456154 - ANTENA KE444\"","","1");
INSERT INTO bitacora VALUES("6","2021-02-12 17:26:00","Ventas","Registro de Venta<br>Código: 000000005","","1");
INSERT INTO bitacora VALUES("7","2021-02-12 17:36:13","Ventas","Habilitación de \"000000005\"","","1");
INSERT INTO bitacora VALUES("8","2021-02-12 17:42:30","Ventas","Habilitación de \"000000005\"","","1");
INSERT INTO bitacora VALUES("9","2021-02-13 22:13:37","Servicios Prestados","Registro de Servicio Prestado<br>Código: 000000004","","1");
INSERT INTO bitacora VALUES("10","2021-02-14 11:17:07","Compras","Anulación de \"000000005\"","","1");
INSERT INTO bitacora VALUES("11","2021-02-14 11:17:09","Compras","Habilitación de \"000000005\"","","1");
INSERT INTO bitacora VALUES("12","2021-02-14 11:19:14","Productos","Actualización de \"P456125 - ROUTER 3400\"","","1");
INSERT INTO bitacora VALUES("13","2021-02-14 11:19:31","Ventas","Registro de Venta<br>Código: 000000006","","1");
INSERT INTO bitacora VALUES("14","2021-02-14 11:21:00","Proveedores","Actualización de \"J-26540950 - MICROTECH\"","<b>Información Anterior:</b><br>Documento: J-26540950<br>Razón Social: MICROTECH<br>Dirección: BARQUISIMETO<br>Teléfono: 0424-5294781<br>E-mail: microtech@gmail.com<br><br><b>Información Actual:</b><br>Documento: J-26540950<br>Razón Social: MICROTECH<br>Dirección: BARQUISIMETO<br>Teléfono: 0424-5294781<br>E-mail: MICROTECH00@GMAIL.COM<br>","1");
INSERT INTO bitacora VALUES("15","2021-02-14 11:23:35","Usuarios","Registro de \"V-27349264 - HECTOR NOGUERA\"","","1");
INSERT INTO bitacora VALUES("16","2021-02-14 11:24:29","Usuarios","Actualización de \"V-27349264 - HECTOR NOGUERA\"","<b>Información Anterior:</b><br>Documento: V-27349264<br>Nombre: HECTOR NOGUERA<br>Dirección: URB EDUARDO GIMENEZ<br>Teléfono: 04261587389<br>E-mail: HECTOR.NOGUERA03@GMAIL.COM<br>Usuario: HECTOR10<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: V-27349264<br>Nombre: HECTOR DAVID NOGUERA<br>Dirección: URB EDUARDO GIMENEZ<br>Teléfono: 04261587389<br>E-mail: HECTOR.NOGUERA03@GMAIL.COM<br>Usuario: HECTOR10<br>Rol: Super Administrador<br>","1");
INSERT INTO bitacora VALUES("17","2021-02-14 11:25:18","Usuarios","Eliminación de \"V-27349264 - HECTOR DAVID NOGUERA\"","","1");
INSERT INTO bitacora VALUES("18","2021-02-14 11:25:42","Usuarios","Actualización de \"V-00000000 - SUPER ADMINISTRADOR\"","<b>Información Anterior:</b><br>Documento: V-00000000<br>Nombre: SUPER ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: superadministrador@email.com<br>Usuario: superadministrador<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: V-00000000<br>Nombre: SUPER ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: SUPERADMINISTRADOR@EMAIL.COM<br>Usuario: SUPERADMINISTRADOR<br>Rol: Super Administrador<br>","1");
INSERT INTO bitacora VALUES("19","2021-02-14 11:26:46","Usuarios","Actualización de \"V-00000000 - SUPER ADMINISTRADOR\"","<b>Información Anterior:</b><br>Documento: V-00000000<br>Nombre: SUPER ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: SUPERADMINISTRADOR@EMAIL.COM<br>Usuario: SUPERADMINISTRADOR<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: V-00000000<br>Nombre: SUPER ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: SUPERADMINISTRADOR@EMAIL.COM<br>Usuario: SUPERADMINISTRADOR<br>Rol: Super Administrador<br>","1");
INSERT INTO bitacora VALUES("20","2021-02-14 11:27:08","Productos","Actualización de \"P456125 - ROUTER 3400\"","<b>Información Anterior:</b><br>Código: P456125<br>Nombre: ROUTER 3400<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 58.5<br>Stock Min.: 25<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456125<br>Nombre: ROUTER 3400<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 58.5<br>Stock Min.: 25<br>Stock Max.: 100<br>Categoría: PC<br>Unidad: PIEZA<br>","1");
INSERT INTO bitacora VALUES("21","2021-02-14 11:46:52","Servicios Prestados","Registro de Servicio Prestado<br>Código: 000000005","","1");
INSERT INTO bitacora VALUES("22","2021-02-14 11:48:04","Servicios Prestados","Registro de Servicio Prestado<br>Código: 000000006","","1");
INSERT INTO bitacora VALUES("23","2021-02-14 12:00:37","Servicios Prestados","Registro de Servicio Prestado<br>Código: 000000007","","1");
INSERT INTO bitacora VALUES("24","2021-02-14 12:07:53","Productos","Actualización de \"P456187 - ADAPTADOR 30K\"","","1");
INSERT INTO bitacora VALUES("25","2021-02-14 12:08:21","Compras","Registro de Compra<br>Código: 000000006","","1");
INSERT INTO bitacora VALUES("26","2021-02-14 12:08:21","Productos","Actualización de \"P456187 - ADAPTADOR 30K\"","","1");
INSERT INTO bitacora VALUES("27","2021-02-14 12:09:09","Productos","Actualización de \"P456187 - ADAPTADOR 30K\"","<b>Información Anterior:</b><br>Código: P456187<br>Nombre: ADAPTADOR 30K<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 2.6<br>Stock Min.: 0<br>Stock Max.: 0<br>Categoría: TELEFONIA<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456187<br>Nombre: ADAPTADOR 30K<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 2.6<br>Stock Min.: 0<br>Stock Max.: 0<br>Categoría: TELEFONIA<br>Unidad: PIEZA<br>","1");
INSERT INTO bitacora VALUES("28","2021-02-14 12:09:35","Productos","Actualización de \"P456165 - CAMARA AL300\"","","1");
INSERT INTO bitacora VALUES("29","2021-02-14 12:10:40","Compras","Registro de Compra<br>Código: 000000007","","1");
INSERT INTO bitacora VALUES("30","2021-02-14 12:10:41","Productos","Actualización de \"P456165 - CAMARA AL300\"","","1");
INSERT INTO bitacora VALUES("31","2021-02-14 12:11:11","Productos","Actualización de \"P456165 - CAMARA AL300\"","<b>Información Anterior:</b><br>Código: P456165<br>Nombre: CAMARA AL300<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 13<br>Stock Min.: 0<br>Stock Max.: 0<br>Categoría: TELEFONIA<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456165<br>Nombre: CAMARA AL300<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 13<br>Stock Min.: 0<br>Stock Max.: 0<br>Categoría: TELEFONIA<br>Unidad: PIEZA<br>","1");
INSERT INTO bitacora VALUES("32","2021-02-14 20:31:57","Usuarios","Actualización de \"V-10000000 - ADMINISTRADOR ADMINISTRADOR\"","<b>Información Anterior:</b><br>Documento: V-10000000<br>Nombre: ADMINISTRADOR ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: admin@email.com<br>Usuario: administrador<br>Rol: Administrador<br><br><b>Información Actual:</b><br>Documento: V-10000000<br>Nombre: ADMINISTRADOR ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: ADMIN@EMAIL.COM<br>Usuario: ADMINISTRADOR<br>Rol: Administrador<br>","1");
INSERT INTO bitacora VALUES("33","2021-02-14 22:16:01","Ventas","Registro de Venta<br>Código: 000000007","","1");
INSERT INTO bitacora VALUES("34","2021-02-14 22:16:13","Ventas","Anulación de \"000000007\"","","1");
INSERT INTO bitacora VALUES("35","2021-02-14 22:16:16","Ventas","Habilitación de \"000000007\"","","1");
INSERT INTO bitacora VALUES("98","2021-02-14 22:28:31","Roles","Eliminación de \"Super Administrador\"","","1");
INSERT INTO bitacora VALUES("99","2021-02-14 22:28:35","Roles","Habilitación de \"Super Administrador\"","","1");
INSERT INTO bitacora VALUES("100","2021-02-14 22:30:59","Proveedores","Eliminación de \"J-26540950 - MICROTECH\"","","1");
INSERT INTO bitacora VALUES("101","2021-02-14 22:31:03","Proveedores","Habilitación de \"J-26540950 - MICROTECH\"","","1");
INSERT INTO bitacora VALUES("102","2021-02-14 22:33:47","Usuarios","Actualización de \"V-10000000 - ADMINISTRADOR ADMINISTRADOR\"","<b>Información Anterior:</b><br>Documento: V-10000000<br>Nombre: ADMINISTRADOR ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: ADMIN@EMAIL.COM<br>Usuario: ADMINISTRADOR<br>Rol: Administrador<br><br><b>Información Actual:</b><br>Documento: V-10000000<br>Nombre: ADMINISTRADOR ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: ADMIN@EMAIL.COM<br>Usuario: ADMINISTRADOR<br>Rol: Administrador<br>","1");
INSERT INTO bitacora VALUES("165","2021-02-14 22:42:15","Productos","Actualización de \"P456123 - MODEM-ROUTER AJ300\"","<b>Información Anterior:</b><br>Código: P456123<br>Nombre: MODEM-ROUTER AJ300<br>Descripción: <br>Margén de Ganancia: 30<br>Precio de Venta: 0<br>Stock Min.: 0<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br><br><b>Información Actual:</b><br>Código: P456123<br>Nombre: MODEM-ROUTER AJ300<br>Descripción: N/A<br>Margén de Ganancia: 30<br>Precio de Venta: 1300<br>Stock Min.: 0<br>Stock Max.: 0<br>Categoría: PC<br>Unidad: PIEZA<br>","1");
INSERT INTO bitacora VALUES("166","2021-02-14 22:43:28","Proveedores","Actualización de \"J-26540950 - MICROTECH\"","<b>Información Anterior:</b><br>Documento: J-26540950<br>Razón Social: MICROTECH<br>Dirección: BARQUISIMETO<br>Teléfono: 0424-5294781<br>E-mail: MICROTECH00@GMAIL.COM<br><br><b>Información Actual:</b><br>Documento: J-26540950<br>Razón Social: MICROTECH<br>Dirección: BARQUISIMETO<br>Teléfono: 0424-5294781<br>E-mail: MICROTECH00@GMAIL.COM<br>","1");
INSERT INTO bitacora VALUES("167","2021-02-14 22:43:43","Proveedores","Actualización de \"J-26540950 - MICROTECH\"","<b>Información Anterior:</b><br>Documento: J-26540950<br>Razón Social: MICROTECH<br>Dirección: BARQUISIMETO<br>Teléfono: 0424-5294781<br>E-mail: MICROTECH00@GMAIL.COM<br><br><b>Información Actual:</b><br>Documento: J-26540950<br>Razón Social: MICROTECH<br>Dirección: BARQUISIMETO<br>Teléfono: 0424-5294781<br>E-mail: MICROTECH00@GMAIL.COM<br>","1");
INSERT INTO bitacora VALUES("168","2021-02-15 15:00:54","Usuarios","Actualización de \"V-30000000 - USUARIO USUARIO\"","<b>Información Anterior:</b><br>Documento: V-30000000<br>Nombre: USUARIO USUARIO<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: usuario@email.com<br>Usuario: usuario<br>Rol: Asistente<br><br><b>Información Actual:</b><br>Documento: V-30000000<br>Nombre: USUARIO USUARIO<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: USUARIO@EMAIL.COM<br>Usuario: USUARIO<br>Rol: Asistente<br>","1");
INSERT INTO bitacora VALUES("169","2021-02-15 20:53:10","Categorías","Eliminación de \"REDES\"","","1");
INSERT INTO bitacora VALUES("170","2021-02-15 20:53:14","Categorías","Habilitación de \"REDES\"","","1");
INSERT INTO bitacora VALUES("171","2021-02-15 21:01:43","Usuarios","Eliminación de \"V-30000000 - USUARIO USUARIO\"","","1");
INSERT INTO bitacora VALUES("172","2021-02-15 21:01:47","Usuarios","Habilitación de \"V-30000000 - USUARIO USUARIO\"","","1");
INSERT INTO bitacora VALUES("173","2021-02-15 21:01:50","Usuarios","Eliminación de \"V-30000000 - USUARIO USUARIO\"","","1");
INSERT INTO bitacora VALUES("174","2021-02-15 21:02:18","Usuarios","Habilitación de \"V-27349264 - HECTOR DAVID NOGUERA\"","","1");
INSERT INTO bitacora VALUES("175","2021-02-15 21:02:21","Usuarios","Habilitación de \"V-30000000 - USUARIO USUARIO\"","","1");
INSERT INTO bitacora VALUES("176","2021-02-15 21:02:48","Usuarios","Eliminación de \"V-27349264 - HECTOR DAVID NOGUERA\"","","1");
INSERT INTO bitacora VALUES("177","2021-02-15 21:03:10","Usuarios","Actualización de \"V-00000000 - SUPER ADMINISTRADOR\"","<b>Información Anterior:</b><br>Documento: V-00000000<br>Nombre: SUPER ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: SUPERADMINISTRADOR@EMAIL.COM<br>Usuario: SUPERADMINISTRADOR<br>Rol: Super Administrador<br><br><b>Información Actual:</b><br>Documento: V-00000000<br>Nombre: SUPER ADMINISTRADOR<br>Dirección: WORLD<br>Teléfono: 000-0000000<br>E-mail: SUPERADMINISTRADOR@EMAIL.COM<br>Usuario: SUPERADMINISTRADOR<br>Rol: Super Administrador<br>","1");



TRUNCATE TABLE categorias;
INSERT INTO categorias VALUES("1","REDES","REDES EN GENERAL","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO categorias VALUES("2","TELEFONIA","TELEFONOS EN GENERAL","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO categorias VALUES("3","PC","PC GENERAL","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE clientes;
INSERT INTO clientes VALUES("1","V-26945214","JOSNERY","DIAZ","LOS CREPUSCULOS","000-1234567","josnery@gmail.com","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO clientes VALUES("2","V-27025411","CARLOS","RAMIREZ","BARQUISIMETO","000-1234567","carlos@gmail.com","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO clientes VALUES("3","V-27022222","HECTOR","NOGUERA","BARQUISIMETO","000-1234567","hector@gmail.com","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO clientes VALUES("4","V-26540950","JESUS","ARRIECHE","DUACA","000-1234567","jesus@gmail.com","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE compras;
INSERT INTO compras VALUES("1","000001","","2021-02-12 01:35:35","12,00","1","ACTIVO","1","2021-02-12 01:35:35","2021-02-12 01:35:35","1");
INSERT INTO compras VALUES("2","000002","","2021-02-12 01:35:35","0","1","ACTIVO","2","2021-02-12 01:35:35","2021-02-12 01:35:35","1");
INSERT INTO compras VALUES("3","000003","","2021-02-12 01:35:35","10,00","1","ACTIVO","3","2021-02-12 01:35:35","2021-02-12 01:35:35","1");
INSERT INTO compras VALUES("4","000000004","","2021-02-12 17:23:16","0","1700000","ACTIVO","1","2021-02-12 17:23:16","2021-02-12 17:23:16","1");
INSERT INTO compras VALUES("5","000000005","","2021-02-12 17:25:44","0","1700000","ACTIVO","1","2021-02-12 17:25:44","2021-02-12 17:25:44","1");
INSERT INTO compras VALUES("6","000000006","","2021-02-14 12:08:21","0","1700000","ACTIVO","1","2021-02-14 12:08:21","2021-02-14 12:08:21","1");
INSERT INTO compras VALUES("7","000000007","1111111","2021-02-14 12:10:40","0","1700000","ACTIVO","1","2021-02-14 12:10:40","2021-02-14 12:10:40","1");



TRUNCATE TABLE configuracion;
INSERT INTO configuracion VALUES("1","nombre_sistema","WORLD & COMPUTER","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO configuracion VALUES("2","dolar","1700000","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO configuracion VALUES("3","iva","10","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE detalle_compra;
INSERT INTO detalle_compra VALUES("1","2000","5","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("2","1000","3","2","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("3","5000","12","3","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("4","2000","5","1","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("5","1000","3","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("6","5000","12","3","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("7","2000","5","1","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("8","1000","3","2","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("9","5000","12","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_compra VALUES("10","45","1","1","4","2021-02-12 17:23:16","2021-02-12 17:23:16");
INSERT INTO detalle_compra VALUES("11","1000","1","3","5","2021-02-12 17:25:44","2021-02-12 17:25:44");
INSERT INTO detalle_compra VALUES("12","2","10","5","6","2021-02-14 12:08:21","2021-02-14 12:08:21");
INSERT INTO detalle_compra VALUES("13","10","10","4","7","2021-02-14 12:10:41","2021-02-14 12:10:41");



TRUNCATE TABLE detalle_entrada;
INSERT INTO detalle_entrada VALUES("1","20","0","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("2","20","0","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("3","20","0","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("4","20","0","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("5","20","0","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("6","20","0","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("7","20","0","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("8","20","0","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_entrada VALUES("9","20","0","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");



TRUNCATE TABLE detalle_salida;
INSERT INTO detalle_salida VALUES("1","5","0","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("2","5","0","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("3","5","0","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("4","5","0","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("5","5","0","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("6","5","0","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("7","5","0","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("8","5","0","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_salida VALUES("9","5","0","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");



TRUNCATE TABLE detalle_servicio;
INSERT INTO detalle_servicio VALUES("1","4","2","2000","2021-02-13 22:13:37","2021-02-13 22:13:37");
INSERT INTO detalle_servicio VALUES("2","4","3","3500","2021-02-13 22:13:37","2021-02-13 22:13:37");
INSERT INTO detalle_servicio VALUES("3","5","2","2000","2021-02-14 11:46:52","2021-02-14 11:46:52");
INSERT INTO detalle_servicio VALUES("4","6","1","6200","2021-02-14 11:48:04","2021-02-14 11:48:04");
INSERT INTO detalle_servicio VALUES("5","7","2","2000","2021-02-14 12:00:37","2021-02-14 12:00:37");



TRUNCATE TABLE detalle_venta;
INSERT INTO detalle_venta VALUES("1","12","2500","1","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("2","6","500","2","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("3","10","200","3","1","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("4","12","2500","1","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("5","6","500","2","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("6","10","200","3","2","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("7","12","2500","1","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("8","6","500","2","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("9","10","200","3","3","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO detalle_venta VALUES("10","1","58.5","1","4","2021-02-12 17:24:51","2021-02-12 17:24:51");
INSERT INTO detalle_venta VALUES("11","1","1300","3","5","2021-02-12 17:26:00","2021-02-12 17:26:00");
INSERT INTO detalle_venta VALUES("12","1","58.5","1","6","2021-02-14 11:19:31","2021-02-14 11:19:31");
INSERT INTO detalle_venta VALUES("13","20","58.5","1","7","2021-02-14 22:16:01","2021-02-14 22:16:01");



TRUNCATE TABLE empleados;
INSERT INTO empleados VALUES("1","V-26945214","JUAN","DIAZ","LOS CREPUSCULOS","000-1234567","josnery@gmail.com","ADMINISTRADOR","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO empleados VALUES("2","V-27025411","PEDRO","BETANCOURT","DON AURELIO","000-1234567","maria@gmail.com","TECNICO","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO empleados VALUES("3","V-26540950","CARLOS","ARRIECHE","DUACA","000-1234567","jesus@gmail.com","TECNICO","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE entradas;
INSERT INTO entradas VALUES("1","000001","2021-02-12 01:35:36","APORTE","aporte de un socio","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO entradas VALUES("2","000002","2021-02-12 01:35:36","PRESTAMO","prestamo de mercancia","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO entradas VALUES("3","000003","2021-02-12 01:35:36","APORTE","aporte de un socio","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");



TRUNCATE TABLE impuestos;
INSERT INTO impuestos VALUES("1","iva","12.00","ACTIVO","2021-02-12 01:35:33","2021-02-12 01:35:33");
INSERT INTO impuestos VALUES("2","iva2","16.00","ACTIVO","2021-02-12 01:35:33","2021-02-12 01:35:33");



TRUNCATE TABLE marcas;
INSERT INTO marcas VALUES("1","TP-LINK","","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO marcas VALUES("2","CISCO","","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO marcas VALUES("3","MERCUSYS","","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE modelos;
INSERT INTO modelos VALUES("1","WF155","","1","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("2","MD399","","1","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("3","JD110","","1","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("4","A300","","2","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("5","A400","","2","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("6","A055","","2","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("7","MS100","","3","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("8","MS200","","3","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO modelos VALUES("9","MS300","","3","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE notificaciones;
INSERT INTO notificaciones VALUES("1","1","1","Stock","Producto P456125 - ROUTER 3400 tiene bajo stock.","SISTEMA","1","INACTIVO","2021-02-14 11:19:31","2021-02-14 11:19:31");
INSERT INTO notificaciones VALUES("2","1","1","Stock","Producto P456125 - ROUTER 3400 tiene bajo stock.","SISTEMA","1","INACTIVO","2021-02-14 22:16:01","2021-02-14 22:16:01");



TRUNCATE TABLE permisos;
INSERT INTO permisos VALUES("1","usuarios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("2","registrar usuarios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("3","editar usuarios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("4","eliminar usuarios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("5","clientes","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("6","registrar clientes","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("7","editar clientes","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("8","eliminar clientes","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("9","empleados","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("10","registrar empleados","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("11","editar empleados","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("12","eliminar empleados","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("13","proveedores","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("14","registrar proveedores","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("15","editar proveedores","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("16","eliminar proveedores","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("17","inventario","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("18","productos","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("19","registrar productos","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("20","editar productos","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("21","eliminar productos","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("22","categorias","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("23","registrar categorias","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("24","editar categorias","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("25","eliminar categorias","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("26","servicios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("27","registrar servicios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("28","editar servicios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("29","eliminar servicios","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("30","servicios prestados","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("31","registrar servicios prestados","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("32","anular servicios prestados","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("33","compras","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("34","registrar compras","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("35","anular compras","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("36","ventas","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("37","registrar ventas","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("38","anular ventas","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("39","roles","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("40","registrar roles","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("41","editar roles","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("42","eliminar roles","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO permisos VALUES("43","reportes","","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");



TRUNCATE TABLE productos;
INSERT INTO productos VALUES("1","P456125","ROUTER 3400","N/A","45","58.5","30","0","25","100","0","0","ACTIVO","3","1","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO productos VALUES("2","P456123","MODEM-ROUTER AJ300","N/A","0","1300","30","0","0","0","0","0","ACTIVO","3","1","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO productos VALUES("3","P456154","ANTENA KE444","","1000","1300","30","0","0","0","0","0","ACTIVO","3","1","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO productos VALUES("4","P456165","CAMARA AL300","N/A","10","13","30","0","0","0","0","0","ACTIVO","2","1","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO productos VALUES("5","P456187","ADAPTADOR 30K","N/A","2","2.6","30","0","0","0","0","0","ACTIVO","2","1","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE proveedores;
INSERT INTO proveedores VALUES("1","J-26540950","MICROTECH","BARQUISIMETO","0424-5294781","MICROTECH00@GMAIL.COM","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO proveedores VALUES("2","J-26543456","CARSYS","CARACAS","0424-5294781","Carsys@gmail.com","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO proveedores VALUES("3","J-26523234","SUPER TECH","BARINAS","0424-5294781","supertech@gmail.com","ACTIVO","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE rol_permiso;
INSERT INTO rol_permiso VALUES("1","1","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","2","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","3","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","4","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","5","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","6","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","7","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","8","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","9","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","10","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","11","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","12","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","13","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","14","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","15","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","16","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","17","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","18","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","19","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","20","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","21","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","22","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","23","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","24","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","25","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","26","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","27","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","28","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","29","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","30","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","31","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","32","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","33","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","34","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","35","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","36","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","37","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","38","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","39","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","40","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","41","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","42","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("1","43","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","5","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","6","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","7","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","8","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","9","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","10","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","11","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","12","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","13","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","14","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","15","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","16","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","18","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","19","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","20","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","21","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","22","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","23","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","24","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","25","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","26","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","27","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","28","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","29","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","30","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","31","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","32","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","33","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","34","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","35","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","36","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","37","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","38","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("2","43","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","5","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","6","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","7","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","8","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","18","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","36","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","37","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO rol_permiso VALUES("3","38","2021-02-12 01:35:35","2021-02-12 01:35:35");



TRUNCATE TABLE roles;
INSERT INTO roles VALUES("1","Super Administrador","Todos los permisos del sistema","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO roles VALUES("2","Administrador","Permisos para la mayoría de los módulos","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO roles VALUES("3","Asistente","Manejo de Inventario, Cliente y Ventas","ACTIVO","2021-02-12 01:35:35","2021-02-12 01:35:35");



TRUNCATE TABLE salidas;
INSERT INTO salidas VALUES("1","000001","2021-02-12 01:35:36","RETIRO","retiro de un socio","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO salidas VALUES("2","000002","2021-02-12 01:35:36","PRESTAMO","prestamo de mercancia","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO salidas VALUES("3","000003","2021-02-12 01:35:36","RETIRO","retiro de un socio","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");



TRUNCATE TABLE servicios;
INSERT INTO servicios VALUES("1","MANTENIMIENTO CAMARAS","Mantenimiento General","6200","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO servicios VALUES("2","REPARACION UPS","Reparacion ","2000","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");
INSERT INTO servicios VALUES("3","FORMATEO PC","Instalacion SO","3500","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36");



TRUNCATE TABLE servicios_prestados;
INSERT INTO servicios_prestados VALUES("1","000001","2021-02-12 01:35:36","2","1","2","1","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36","1");
INSERT INTO servicios_prestados VALUES("2","000002","2021-02-12 01:35:36","3","2","2","1","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36","1");
INSERT INTO servicios_prestados VALUES("3","000003","2021-02-12 01:35:36","3","3","2","1","ACTIVO","2021-02-12 01:35:36","2021-02-12 01:35:36","1");
INSERT INTO servicios_prestados VALUES("4","000000004","2021-02-13 22:13:37","2","0","3","1700000","ACTIVO","2021-02-13 22:13:37","2021-02-13 22:13:37","1");
INSERT INTO servicios_prestados VALUES("5","000000005","2021-02-14 11:46:52","3","0","3","1700000","ACTIVO","2021-02-14 11:46:52","2021-02-14 11:46:52","1");
INSERT INTO servicios_prestados VALUES("6","000000006","2021-02-14 11:48:04","2","0","2","1700000","ACTIVO","2021-02-14 11:48:04","2021-02-14 11:48:04","1");
INSERT INTO servicios_prestados VALUES("7","000000007","2021-02-14 12:00:37","2","0","3","1","ACTIVO","2021-02-14 12:00:37","2021-02-14 12:00:37","1");



TRUNCATE TABLE unidades;
INSERT INTO unidades VALUES("1","PIEZA","pza","activo","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO unidades VALUES("2","METRO","m","activo","2021-02-12 01:35:34","2021-02-12 01:35:34");
INSERT INTO unidades VALUES("3","LITRO","l","activo","2021-02-12 01:35:34","2021-02-12 01:35:34");



TRUNCATE TABLE usuarios;
INSERT INTO usuarios VALUES("1","V-00000000","SUPER","ADMINISTRADOR","WORLD","000-0000000","SUPERADMINISTRADOR@EMAIL.COM","SUPERADMINISTRADOR","ZXRlSml1a1p0akNsbTYwL2hnNEF2UT09","ACTIVO","1","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO usuarios VALUES("2","V-10000000","ADMINISTRADOR","ADMINISTRADOR","WORLD","000-0000000","ADMIN@EMAIL.COM","ADMINISTRADOR","ZXRlSml1a1p0akNsbTYwL2hnNEF2UT09","ACTIVO","2","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO usuarios VALUES("3","V-30000000","USUARIO","USUARIO","WORLD","000-0000000","USUARIO@EMAIL.COM","USUARIO","ZXRlSml1a1p0akNsbTYwL2hnNEF2UT09","ACTIVO","3","2021-02-12 01:35:35","2021-02-12 01:35:35");
INSERT INTO usuarios VALUES("4","V-27349264","HECTOR DAVID","NOGUERA","URB EDUARDO GIMENEZ","04261587389","HECTOR.NOGUERA03@GMAIL.COM","HECTOR10","YVB1aE1tR2Y3RXA5eHgyZHdHRUNWQT09","ELIMINADO","1","2021-02-14 11:23:35","2021-02-14 11:23:35");










TRUNCATE TABLE ventas;
INSERT INTO ventas VALUES("1","000001","2021-02-12 01:35:36","0","1","ACTIVO","1","2021-02-12 01:35:36","2021-02-12 01:35:36","1");
INSERT INTO ventas VALUES("2","000002","2021-02-12 01:35:36","0","1","ACTIVO","2","2021-02-12 01:35:36","2021-02-12 01:35:36","1");
INSERT INTO ventas VALUES("3","000003","2021-02-12 01:35:36","0","1","ACTIVO","3","2021-02-12 01:35:36","2021-02-12 01:35:36","1");
INSERT INTO ventas VALUES("4","000000004","2021-02-12 17:24:51","12","1700000","ACTIVO","3","2021-02-12 17:24:51","2021-02-12 17:24:51","1");
INSERT INTO ventas VALUES("5","000000005","2021-02-12 17:26:00","12","1700000","ACTIVO","2","2021-02-12 17:26:00","2021-02-12 17:26:00","1");
INSERT INTO ventas VALUES("6","000000006","2021-02-14 11:19:31","12","1700000","ACTIVO","4","2021-02-14 11:19:31","2021-02-14 11:19:31","1");
INSERT INTO ventas VALUES("7","000000007","2021-02-14 22:16:01","12","1700000","ACTIVO","4","2021-02-14 22:16:01","2021-02-14 22:16:01","1");



SET FOREIGN_KEY_CHECKS=1;
DELETE FROM bitacora WHERE fecha > "2021-02-15 21:05:33";