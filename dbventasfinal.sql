
DROP SCHEMA IF EXISTS `dbVentas` ;

CREATE SCHEMA IF NOT EXISTS `dbVentas` DEFAULT CHARACTER SET utf8 ;
USE `dbVentas` ;

create table if not exists almacen
(
    idalmacen        varchar(45) not null
        primary key,
    nombrealmacen    varchar(45) null,
    direccionalmacen varchar(45) null
);

create table if not exists boletaventa
(
    idboletaventa    int auto_increment
        primary key,
    fechaboletaventa date null
);

create table if not exists categoria
(
    idcategoria          varchar(45) not null
        primary key,
    nombrecategoria      varchar(45) null,
    descripcioncategoria text        null
);

create table if not exists cliente
(
    idCliente        int auto_increment
        primary key,
    cliente_rs       varchar(200) not null,
    direccioncliente varchar(100) not null,
    ruccliente       varchar(11)  null,
    correocliente    varchar(45)  null,
    telefonocliente  varchar(9)   null
);

create table if not exists direcom
(
    idDirecom          int          not null
        primary key,
    rmdirecom          varchar(200) null,
    direcciondirecom   varchar(200) null,
    rucdirecom         varchar(11)  null,
    descripciondirecom text         null
);

create table if not exists factura
(
    idfactura        int auto_increment
        primary key,
    fechaemision     date          null,
    fechavencimiento date          null,
    igvfactura       decimal(7, 2) null
);

create table if not exists producto
(
    idproducto            int auto_increment
        primary key,
    nombreproducto        varchar(45)   null,
    descripcionproducto   text          null,
    costounitarioproducto decimal(7, 2) null,
    unidadmedidaproducto  varchar(45)   null,
    stockproducto         int           null,
    marcaproducto         varchar(45)   null,
    almacen_idalmacen     varchar(45)   not null,
    categoria_idcategoria varchar(45)   not null,
    constraint fk_producto_almacen1
        foreign key (almacen_idalmacen) references almacen (idalmacen),
    constraint fk_producto_categoria1
        foreign key (categoria_idcategoria) references categoria (idcategoria)
);

create index if not exists fk_producto_almacen1_idx
    on producto (almacen_idalmacen);

create index if not exists fk_producto_categoria1_idx
    on producto (categoria_idcategoria);

create table if not exists usuario
(
    idusuario        int auto_increment
        primary key,
    nombreusuario    varchar(45)  null,
    apellidosusuario varchar(45)  null,
    claveusuario     varchar(250) null,
    dniusuario       varchar(8)   null,
    direccionusuario varchar(45)  null,
    fechaingreso     date         null,
    telefonousuario  varchar(9)   null,
    tipousuario      varchar(20)  null
);

create table if not exists detalleventa
(
    iddetalleventa            int auto_increment
        primary key,
    cantidadproductoventa     int           null,
    importeventa              decimal(7, 2) null,
    totalboletaventa          decimal(7, 2) null,
    cliente_idCliente         int           not null,
    producto_idproducto       int           not null,
    usuario_idusuario         int           null,
    Direcom_idDirecom         int           null,
    factura_idfactura         int           null,
    boletaventa_idboletaventa int           null,
    constraint fk_detalleventa_Direcom1
        foreign key (Direcom_idDirecom) references direcom (idDirecom),
    constraint fk_detalleventa_boletaventa1
        foreign key (boletaventa_idboletaventa) references boletaventa (idboletaventa),
    constraint fk_detalleventa_cliente1
        foreign key (cliente_idCliente) references cliente (idCliente),
    constraint fk_detalleventa_factura1
        foreign key (factura_idfactura) references factura (idfactura),
    constraint fk_detalleventa_producto1
        foreign key (producto_idproducto) references producto (idproducto),
    constraint fk_detalleventa_usuario1
        foreign key (usuario_idusuario) references usuario (idusuario)
);

create index if not exists fk_detalleventa_Direcom1_idx
    on detalleventa (Direcom_idDirecom);

create index if not exists fk_detalleventa_boletaventa1_idx
    on detalleventa (boletaventa_idboletaventa);

create index if not exists fk_detalleventa_cliente1_idx
    on detalleventa (cliente_idCliente);

create index if not exists fk_detalleventa_factura1_idx
    on detalleventa (factura_idfactura);

create index if not exists fk_detalleventa_producto1_idx
    on detalleventa (producto_idproducto);

create index if not exists fk_detalleventa_usuario1_idx
    on detalleventa (usuario_idusuario);


INSERT INTO dbventas.almacen (idalmacen, nombrealmacen, direccionalmacen) VALUES ('ALM', 'ALMACEN TALAVERA', 'AVE TALAVERA');


INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('acccompu', 'Accesorios Computadora', 'Accesorios Computadora');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('accimpresora', 'Accesorios Impresora', 'Accesorios Impresora');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('audifono', 'Audifono', 'Audifono');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('camara', 'Cámara', 'Cámara');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('estabilizador', 'Estabilizador', 'Estabilizador');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('hdd', 'HDD', 'HDD');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('laptop', 'Laptos', 'Portalites ');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('mochila', 'Mochila', 'Mochilas/Bolsos');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('monitor', 'Monitor', 'Monitor');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('mouse', 'Mouse', 'Mouse/Ratones');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('procesador', 'Procesador', 'Procesador');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('router', 'Router', 'Router wifi/repetidor/AP');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('ssd', 'SSD', 'SSD');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('stereo', 'Stereo', 'Stereo');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('switch', 'Switch', 'Switch');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('targetamadre', 'Targeta Madre', 'Targeta Madre');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('targetasdevdideo', 'Targetas de Videp', 'Targetas de Videp');
INSERT INTO dbventas.categoria (idcategoria, nombrecategoria, descripcioncategoria) VALUES ('teclado', 'Teclado', 'Teclado');

INSERT INTO dbventas.usuario (idusuario, nombreusuario, apellidosusuario, claveusuario, dniusuario, direccionusuario, fechaingreso, telefonousuario, tipousuario) VALUES (5, 'Robins', ' Ccorimanya Vicente', '$2y$10$bLwD0C3ms5CB3FNogzwGOOPZXQQrlfs/Ng1OxCPaVBbN48g19n7tW', '12345678', 'Ave el carmen', '2020-09-04', '974728183', 'Vendedor');
INSERT INTO dbventas.usuario (idusuario, nombreusuario, apellidosusuario, claveusuario, dniusuario, direccionusuario, fechaingreso, telefonousuario, tipousuario) VALUES (6, 'Victor', 'Oscco Mallma', '$2y$10$jd7u/9HJA5xgavRJtXLHWOz927VVgwV/crTq23SJtUsdTXGiUCPPm', '75965456', 'Jr Sol de Oro SN', '2020-09-10', '974728183', 'Vendedor');
INSERT INTO dbventas.usuario (idusuario, nombreusuario, apellidosusuario, claveusuario, dniusuario, direccionusuario, fechaingreso, telefonousuario, tipousuario) VALUES (7, 'Oscar', 'Mora Alvez', '$2y$10$TYbL66wPRKeC1jq4z3qA9e7/F6coYND7Wk3IJRRw10nat81IQGSMa', '85265204', 'Jr Sol de Oro N 231', '2020-10-10', '974728183', 'Cajero');
INSERT INTO dbventas.usuario (idusuario, nombreusuario, apellidosusuario, claveusuario, dniusuario, direccionusuario, fechaingreso, telefonousuario, tipousuario) VALUES (8, 'Paola', 'Oscco Mallma', '$2y$10$SG63.xSbFtfFWCpJQr4zruRs18U3O8Z4cfOr5hfaIRH13.W6v1cnG', '96346578', 'Jr Sol de Oro', '2020-09-02', '965728183', 'Administrador');
INSERT INTO dbventas.usuario (idusuario, nombreusuario, apellidosusuario, claveusuario, dniusuario, direccionusuario, fechaingreso, telefonousuario, tipousuario) VALUES (9, 'Oracio', 'Vicente Ccorimanya', '$2y$10$7qzzeneQ0rw7p8gvA1tmMebfjQ/390HNCEzWxw5SsuKNj2bNvflt6', '12346578', 'ave el carmen', '2020-09-18', '974728183', 'Administrador');

INSERT INTO dbventas.cliente (idCliente, cliente_rs, direccioncliente, ruccliente, correocliente, telefonocliente) VALUES (4, 'Robinson Vicente Ccorimanya', 'Leconcio Prado N 234', null, null, null);
INSERT INTO dbventas.cliente (idCliente, cliente_rs, direccioncliente, ruccliente, correocliente, telefonocliente) VALUES (5, 'Kelly Ancco Huamán', 'Jr 7 de Junio', null, 'mail@mail.com', null);
INSERT INTO dbventas.cliente (idCliente, cliente_rs, direccioncliente, ruccliente, correocliente, telefonocliente) VALUES (6, 'Thony Rodiguez Zevallos', 'Jr 7 de Junio', null, null, '987321654');
INSERT INTO dbventas.cliente (idCliente, cliente_rs, direccioncliente, ruccliente, correocliente, telefonocliente) VALUES (8, 'Jhon Astuchao Huamani', 'Jr 7 de Junio N 353', null, 'jhon@gamil.com', null);
INSERT INTO dbventas.cliente (idCliente, cliente_rs, direccioncliente, ruccliente, correocliente, telefonocliente) VALUES (9, 'Jeremi Caracaz Benites', 'Ave Perú N 564', null, 'jeremi@gamil.com', null);
INSERT INTO dbventas.cliente (idCliente, cliente_rs, direccioncliente, ruccliente, correocliente, telefonocliente) VALUES (10, 'Wilfredo Andía Salazar', 'Jr 7 de Junio 342', null, null, '965487321');
INSERT INTO dbventas.cliente (idCliente, cliente_rs, direccioncliente, ruccliente, correocliente, telefonocliente) VALUES (12, 'Bodega Jasmines', 'Jr 7 de Junio N 31', '78932165421', 'jasmin@gamil.com', '987654321');

INSERT INTO dbventas.direcom (idDirecom, rmdirecom, direcciondirecom, rucdirecom, descripciondirecom) VALUES (1, 'Distribuidora y Reparaciones de Computadoras DIRECOM S.R.L.', 'Jr. Juan Francisco Ramos n°. 689 Apurímac - Andahuaylas - Andahuaylas', '20527175829', 'La empresa, se dedica a la venta de computadores (PCs de escritorios y laptops), accesorios para computadores, y suministro y/o insumos para impresora y otros componentes electrónicos.');

INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (1, 'LENOVO Y700', '2GB RAM INTEL i31232U', 3522.00, 'Unias', 5, 'Lenovo', 'ALM', 'laptop');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (11, 'Toshiba Satellitel 400', 'Thoshiba S-400 i3222U 8GB RAM 1TB HDD', 2599.99, 'Unidades', 6, 'Toshiba', 'ALM', 'laptop');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (12, 'Mocron MKJ', 'Mocron Mouse mkG', 59.99, 'Unidades', 50, 'Micron', 'ALM', 'mouse');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (13, 'Mocron Mouse ', 'Mocron Mouse 2-S', 49.99, 'Unidades', 50, 'Micron', 'ALM', 'mouse');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (14, 'Mocron Mouse ', 'Mocron Mouse wireles ', 96.99, 'Unidades', 50, 'Micron', 'ALM', 'mouse');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (15, 'Mocron Mouse ', 'Mocron Mouse Basic-HH', 19.99, 'Unidades', 50, 'Micron', 'ALM', 'mouse');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (16, 'Mocron Mouse ', 'Mocron Mouse Gaming-PRO', 150.99, 'Unidades', 50, 'Micron', 'ALM', 'mouse');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (17, 'Tinta Canon', 'Tinta  Cannon CYMK', 179.99, 'Pack', 20, 'Canon', 'ALM', 'accimpresora');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (18, 'Tinta Epson', 'Tinta  Epson CYMK', 179.99, 'Pack', 20, 'Epson', 'ALM', 'accimpresora');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (19, 'Tinta Hp', 'Tinta  Hp CYMK', 179.99, 'Pack', 20, 'HP', 'ALM', 'accimpresora');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (20, 'Router TP-Link 200MB', 'Router TP-Link 200MBPS 2.4GHZ ', 129.99, 'Unitario', 20, 'Tp-Link', 'ALM', 'router');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (22, 'Router TP-Link 1200MB', 'Router TP-Link 100MBPS 2.4GHZ 5GHZ ', 229.99, 'Unitario', 20, 'Tp-Link', 'ALM', 'router');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (23, 'Router TP-Link 2400MB', 'Router TP-Link 2400MBPS 2.4GHZ 5GHZ', 269.99, 'Unitario', 20, 'Tp-Link', 'ALM', 'router');
INSERT INTO dbventas.producto (idproducto, nombreproducto, descripcionproducto, costounitarioproducto, unidadmedidaproducto, stockproducto, marcaproducto, almacen_idalmacen, categoria_idcategoria) VALUES (24, 'Router TP-Link 3200MB', 'Router TP-Link 3200MBPS 2.4GHZ ', 329.99, 'Unitario', 20, 'Tp-Link', 'ALM', 'router');


INSERT INTO dbventas.factura (idfactura, fechaemision, fechavencimiento, igvfactura) VALUES (3, '2020-09-10', '2020-09-13', 0.18);
INSERT INTO dbventas.factura (idfactura, fechaemision, fechavencimiento, igvfactura) VALUES (4, '2020-09-04', '2020-09-20', 0.18);
INSERT INTO dbventas.factura (idfactura, fechaemision, fechavencimiento, igvfactura) VALUES (5, '2020-09-17', '2020-09-19', 0.18);
INSERT INTO dbventas.factura (idfactura, fechaemision, fechavencimiento, igvfactura) VALUES (6, '2020-09-16', '2020-09-21', 0.18);
INSERT INTO dbventas.factura (idfactura, fechaemision, fechavencimiento, igvfactura) VALUES (7, '2020-09-16', '2020-09-28', 0.18);

INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (1, '2020-09-18');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (2, '2020-09-09');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (3, '2020-09-09');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (4, '2020-09-27');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (5, '2020-09-19');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (6, '2020-09-19');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (7, '2020-09-19');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (8, '2020-09-19');
INSERT INTO dbventas.boletaventa (idboletaventa, fechaboletaventa) VALUES (9, '2020-09-19');






