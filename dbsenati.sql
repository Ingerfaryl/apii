create database senatidb;

use senatidb;
create table marcas
(
	idmarca 		int auto_increment primary key,
    marca			varchar(30) not null,
    create_at		datetime not null default now(),
    inactive_at 	datetime null,
    update_at		datetime null,
    constraint uk_marca_mar unique(marca)
)
engine =innodb;

insert into marcas (marca)
	values
		('Toyota'),
        ('Nissan'),
        ('Volvo'),
        ('Hyundai'),
        ('KIA');

select * from marcas;

create table vehiculos(
    idvehiculo      int AUTO_INCREMENT PRIMARY KEY,
    idmarca         int not null,
    modelo          varchar(50) not null,
    color           VARCHAR(30) not null,
    tipocombustible char(3) not null,
    peso            SMALLINT not null,
    afabricacion    char(4) not null,
    placa           char(7) not null,
    create_at       DATETIME not null default now(),
    inactive_at     DATETIME null,
    update_at       DATETIME null,
    constraint fk_idmarca_veh FOREIGN KEY (idmarca) REFERENCES marcas(idmarca),
    constraint ck_tipocombustible_veh check(tipocombustible in ('GSL','DSL','GNV','GLP')),
    constraint ck_peso_vech check (peso > 0),
    constraint uk_placa_veh UNIQUE(placa)
)
engine = INNODB;

INSERT INTO vehiculos
    (idmarca,modelo,color,tipocombustible,peso,afabricacion,placa)
    VALUES
        (1,'Hilux','blanco','DSL',1800,'2020','ABC-111'),
        (2,'Sentra','gris','GSL',1200,'2021','ABC-112'),
        (3,'EX30','negro','GNV',1350,'2023','ABC-113'),
        (4,'Tucson','rojo','GLP',1800,'2022','ABC-114'),
        (5,'Sportage','vino','DSL',1500,'2010','ABC-115');

CREATE Procedure spu_vehiculos_buscar(in _placa char(7))
BEGIN
    select 
    VEH.idvehiculo,
    MAR.marca,
    VEH.modelo,
    VEH.color,
    VEH.tipocombustible,
    VEH.peso,
    VEH.afabricacion,
    VEH.placa
        from vehiculos VEH
        INNER JOIN marcas MAR on MAR.idmarca = VEH.idmarca
        WHERE(VEH.inactive_at is null) and 
            (VEH.placa = _placa);
END 

CREATE Procedure spu_vehiculos_registrar(
    in _idmarca             int,
    in _modelo              varchar(50),
    in _color               VARCHAR(30),
    in _tipocombustible     char(3),
    in _peso                SMALLINT,
    in _afabricacion        char(4),
    in _placa               char(7)
)
BEGIN
    INSERT INTO vehiculos
    (idmarca,modelo,color,tipocombustible,peso,afabricacion,placa) VALUES
    (_idmarca,_modelo,_color,_tipocombustible,_peso,_afabricacion,_placa);
    SELECT @@LAST_INSERT_ID 'idvehiculo';
END


CREATE Procedure spu_vehiculos_listar()
BEGIN
    SELECT 
    idmarca,
    marca
    from marcas
    WHERE inactive_at is NULL
    ORDER BY marca;
END
CALL spu_vehiculos_buscar('ABC-120');
create table sedes(
    idsede              int AUTO_INCREMENT PRIMARY KEY,
    sede                varchar(120) not null,
    create_at           DATETIME not null default now(),
    inactive_at         DATETIME null,
    update_at           DATETIME null
)engine = innodb;
create table empleados(
    idempleado          int AUTO_INCREMENT PRIMARY KEY,
    idsede              int not null,
    apellidos           varchar(120)not null,
    nombres             varchar(120)not null,
    ndoc                char(8),
    fechanac            DATE not null,
    telefono            char(9) not null,
    create_at           DATETIME not null default now(),
    inactive_at         DATETIME null,
    update_at           DATETIME null,
    constraint fk_sede_gaa FOREIGN key (idsede) references sedes(idsede),
    constraint uq_un_uu unique (ndoc)
)ENGINE = INNODB;
alter Table empleados MODIFY COLUMN fechanac DATE;

create Procedure spu_sedes_agregar(
    in _sede        varchar(120)
)
BEGIN
    insert into sedes(sede) values(_sede);
END;

call spu_sedes_agregar('Piura');
call spu_sedes_agregar('Lima');

create Procedure spu_sedes_buscar()
BEGIN
    select
    idsede,
    sede 
    from sedes where (inactive_at is null);
END;
create PROCEDURE spu_sedes_listar()
BEGIN
	SELECT
		idsede,
		sede
    FROM sedes
	WHERE inactive_at IS NULL
    ORDER BY sede;
END
CALL spu_sedes_listar();
CREATE procedure spu_empleados_registrar
(
    in _idsede          int,
    in _apellidos       varchar(120),
    in _nombres         varchar(120),
    in _ndoc            char(8),
    in _fechanac        date,
    in _telefono        char(9)
)
BEGIN
    insert into empleados
    (idsede,apellidos,nombres,ndoc,fechanac,telefono) values
    (_idsede,_apellidos,_nombres,_ndoc,_fechanac,_telefono);
END

CREATE Procedure spu_empleados_buscar(in _ndoc char(8))
BEGIN
    SELECT 
	EMP.ndoc,
	EMP.nombres,
	EMP.apellidos,
	SED.sede,
	EMP.fechanac,
	EMP.telefono
	FROM empleados EMP
	INNER JOIN sedes SED ON EMP.idsede = SED.idsede
	WHERE EMP.ndoc = ndoc;
end
call spu_empleados_buscar('71592495');
CREATE PROCEDURE spu_empleados_listar()
begin
    SELECT
    idsede,
    apellidos,
    nombres,
    ndoc,
    fechanac,
    telefono
    from empleados
    where inactive_at is null ORDER BY apellidos;
END;
call spu_empleados_listar();
call spu_empleados_registrar (1,'Mesías','Carlos','74859689','2001-02-02','956235689');

select * from vehiculos;
create Procedure spu_resumen_tipocombustible()
BEGIN
    SELECT
    tipocombustible, count(tipocombustible) as 'total'
    from vehiculos
    GROUP BY tipocombustible
    order by tipocombustible;
end

call spu_resumen_tipocombustible();

