/*
	create database epsilonp_BDEmpresa;
*/
	use epsilonp_BDEmpresa;
/* ====================================== */
/* TABLA : RESPUESTA DE SOLICITUD */
/* ====================================== */
	drop table if exists respuestasolicitud;
	create table respuestasolicitud(
	id			 	int 				not null AUTO_INCREMENT,
	idsolicitud	int				not null,
	UsrDmd		int				not null,	/* codigo de usuario asignado para atender respusta*/
	RazSocDmd	varchar(150)	null, 		/* Razón social de demandado */
	TipDocDmd	varchar(1)		null,			/* Tipo de documento de demandado */
	NumDocDmd	varchar(20)		null,			/* Numero de documento de demandado */
	DesDirDmd	varchar(150)	null,			/* Domicilio de persona natural o juridica */
	DirEmaDmd	varchar(150)	null,			/* Dirección de correo electronico de demandado */
	ClaSegTok	varchar(150)	null,	    	/* Clave de seguridad generada por el area de SECRETARIA GENERAL */
	ValSegTok	varchar(150)	null,			/* Clave de seguridad ingresada por el usuario al verificar su correo */				
	ApeNomLeg	varchar(150)	null,			/* Apellidos y nombres de representante legal */
	TipDocRep	varchar(1)		null,			/* Tipo de documento de identidad de representante legal */
	NumDocRep	varchar(20)		null,			/* Numero de documento de identidad de representante legal */
	NumTelRep	varchar(20)		null,			/* Numero de telefono de representante */
	NumCelRep	varchar(20)		null,			/* Numero de celular de representante */
	DirEmaRep	varchar(150)	null,			/* Dirección de correo electrónico de representante */
	ApeNomArb	varchar(150)	null,			/* Apellidos y Nombre de Arbitro */
	DesDirArb	varchar(150)	null,			/* Dirección de Arbitro */
	NumTelArb	varchar(20)		null,			/* Telefono de Arbitro */
	DirEmaArb	varchar(150)	null,			/* Email de Arbitro */
	NomProArb	varchar(150)	null,			/* Profesión de Arbitro */
	NumColArb	varchar(50)		null,			/* Numero de Colegiatura */
	FlgRegArb	varchar(1)		null,			/* Indicador de registro de Arbitros OSCE */
	FlgPrtArb	varchar(10)		null,			/* Indicador que indica si centro de arbitraje designa arbitro de parte */
	FlgUniArb	varchar(10)		null,			/* Indicador que indica si centro de arbitraje designa arbitro unico */
	PosPrtDmd	varchar(250)	null,			/* Información por parte del demandado */
	PreRecDmd	varchar(250)	null,			/* Pretensión de Reconvensión de ser el caso */
	CuaCtrdmd	varchar(250)	null,			/* Detalle de  posibles pretensiones y el monto involucrado, en cuanto sea cuantificable. */
	NomFil01		varchar(250)	null,			/* nombre de archivo adjunto Copia de Dni*/
	NomFil02		varchar(250)	null,			/* nombre de archivo adjunto Acreditación de representante legal. */
	NomFil03		varchar(250)	null,			/* nombre de archivo adjunto documentación que considere adjuntar. */
	DirFil01		varchar(250)	null,			/* dirección de archivo adjunto */
	DirFil02		varchar(250)	null,			/* dirección de archivo adjunto */
	DirFil03		varchar(250)	null,			/* dirección de archivo adjunto */
	usrcreacion	int 				null,
	fchcreacion	date				null,
	hracreacion	time				null,
	usrmodifica	int 				null,
	fchmodifica	date				null,
	hramodifica	time				null,
	PRIMARY KEY (id)
	);
	
/* ====================================== */
/* TABLA : TIPO DE SOLICITUD */
/* ====================================== */
	drop table if exists tra_tbTipoSolicitud;
	create table tra_tbTipoSolicitud(
	id			 INT 				NOT NULL AUTO_INCREMENT,
	destipsol VARCHAR(180) 	NOT NULL,
	flgmsaprt VARCHAR(1)    NOT NULL,
	PRIMARY KEY (id)
	);
	
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('SOLICITUD DE ARBITRAJE','N');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('CONTESTACION O ABSOLUCION DE LA SOLICITUD DE ARBITRAJE','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('LEVANTAMIENTO DE OBSERVACIÓN O SUBSANACION DE OBSERVACIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('APERSONAMIENTO Y DELEGACIÓN DE FACULTADES','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('RECONSIDERACIÓN A LA DECISIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('RECONSIDERACIÓN A LA ORDEN ARBITRAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ACUMULACIÓN DE PRETENSIONES','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ABSOLUCIÓN DE ACUMULACIÓN DE PRETENSIONES','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('RECUSACIÓN CONTRA ÁRBITRO U ÁRBITROS','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PAGO DE ARANCEL POR RECUSACIÓN DE ÁRBITRO','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ALEGATOS','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PROPUESTA DE PUNTOS CONTROVERTIDOS','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PROPUESTA DE CONCILIACIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('DEMANDA ARBITRAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('SUBSANACIÓN DE DEMANDA ARBITRAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('CONTESTACIÓN A LA DEMANDA ARBITRAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('SUBSANACIÓN A LA CONTESTACIÓN DE DEMANDA ARBITRAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('CONTESTACIÓN A LA DEMANDA ARBITRAL Y PRESENTA RECONVENCIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('CONTESTACIÓN DE LA DEMANDA DE RECONVENCIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('TACHA A MEDIOS PROBATORIOS','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('EXCEPCIONES','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PRESENTA PERICIA DE PARTE','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('OBSERVA PERICIA','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PRESENTA DICTAMEN PERICIAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('LEVANTA OBSERVACIONES DE PERICIA','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('AMPLIACIÓN DEL DEBER DE REVELACIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ACLARACIÓN AL DEBER DE REVELACIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ACREDITA PAGO DE GASTOS ARBITRALES','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ADJUNTA TASA POR DESIGNACIÓN DE ÁRBITRO RESIDUAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PAGO POR NOTIFICACIÓN FÍSICA','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('SOLICITA FRACCIONAMIENTO DE PAGO','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('RECONSIDERACIÓN DE LIQUIDACIÓN DE COSTOS ARBITRALES','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('REPROGRAMACIÓN DE AUDIENCIA','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('TÉNGASE PRESENTE PARA MEJOR RESOLVER','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('CUMPLE REQUERIMIENTO','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ADJUNTA MEDIOS PROBATORIOS','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ACLARACIÓN, RECTIFICACIÓN, INTEGRACIÓN, INTERPRETACIÓN DE LAUDO','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('COPIAS CERTIFICADAS','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('SOLICITA HOMOLOGACIÓN DE LAUDO ARBITRAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('ARCHIVO DE PROCESO ARBITRAL','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('OTROS','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('CUMPLIMIENTO DE RESOLUCIÓN','S');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PRESENTACIÓN DE MEDIDA CAUTELAR FUERA DE PROCESO ANTE ÉL ÁRBITRO DE EMERGENCIA','N');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('PETICIÓN DE JUNTA DE RESOLUCIÓN DE DISPUTAS','N');
	insert into tra_tbTipoSolicitud(destipsol,flgmsaprt) values ('RESPUESTA A SOLICITUD DE INICIO DE PROCEDIMIENTO ARBITRAL','S');

/* ====================================== */
/* TABLA : CORRELATIVO */
/* ====================================== */
	drop table if exists tra_tbCorrelativo;
	create table tra_tbCorrelativo(
	AniSol	VARCHAR(4) 	NOT NULL,
	NumSol	VARCHAR(6) 	NOT NULL,
	PRIMARY KEY (AniSol)
	);

/* ====================================== */
/* TABLA : MONEDA */
/* ====================================== */
	drop table if exists tra_tbMoneda;
	create table tra_tbMoneda(
	id			INT 				NOT NULL AUTO_INCREMENT,
	SimMon	VARCHAR(20) 	NOT NULL,
	DesMon	VARCHAR(150) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbMoneda(SimMon,desMon) values('-','Seleccione');
	Insert into tra_tbMoneda(SimMon,desMon) values('S/','S/ Soles');
	Insert into tra_tbMoneda(SimMon,desMon) values('$','$ Dolares');
	Insert into tra_tbMoneda(SimMon,desMon) values('€','€ Euros');
	Insert into tra_tbMoneda(SimMon,desMon) values('¥','¥ Yuan');
	Insert into tra_tbMoneda(SimMon,desMon) values('¥','¥ Yen');

/* ====================================== */
/* TABLA : TIPO DE CUANTIA */
/* ====================================== */
	drop table if exists tra_tbtipoCuantia;
	create table tra_tbtipoCuantia(
	id			INT 				NOT NULL AUTO_INCREMENT,
	destip	VARCHAR(250) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbtipoCuantia(destip) values('Indeterminado');
	Insert into tra_tbtipoCuantia(destip) values('Determinado');

/* ====================================== */
/* TABLA : TIPO DE COMPROBANTE */
/* ====================================== */
	drop table if exists tra_tbtipoComprobante;
	create table tra_tbtipoComprobante(
	id			INT 				NOT NULL AUTO_INCREMENT,
	destip	VARCHAR(250) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbtipoComprobante(destip) values('Boleta');
	Insert into tra_tbtipoComprobante(destip) values('Factura');

/* ====================================== */
/* TABLA : TIPO DE ANEXOS */
/* ====================================== */
	drop table if exists tra_tbtipoAnexo;
	create table tra_tbtipoAnexo(
	id			INT 				NOT NULL AUTO_INCREMENT,
	desanx	VARCHAR(250) 	NOT NULL,
	PRIMARY KEY (id)
	);

	Insert into tra_tbtipoAnexo(desanx) values('Comprobante de Pago');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de DNI');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de Poder de Representante');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de Contrato de Arbitraje');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de Contrato de Consorcio');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de Documentos relacionados');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de Actuados Judiciales');
	Insert into tra_tbtipoAnexo(desanx) values('Escritura pública');
	Insert into tra_tbtipoAnexo(desanx) values('Acta legalizada');
	Insert into tra_tbtipoAnexo(desanx) values('Copia literal de registros públicos');
	Insert into tra_tbtipoAnexo(desanx) values('Vigencia de poder de registros públicos');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de la ficha ruc de la empresa');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de los documentos relacionados a la controversia');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de la ficha ruc de la empresa');
	Insert into tra_tbtipoAnexo(desanx) values('Copia de contrato/orden compra/orden de servicio');
	Insert into tra_tbtipoAnexo(desanx) values('Otros documentos');

/* ====================================== */
/* TABLA : DOCUMENTOS INTERNOS */
/* ====================================== */
	drop table if exists tra_tbdocumentosinternos;
	create table tra_tbdocumentosinternos(
	id				INT 				NOT NULL AUTO_INCREMENT,
	desdocint	VARCHAR(150) 	NOT NULL,
	estdocint	VARCHAR(1)		NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ORDEN ARBITRAL','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('DECISIÓN ARBITRAL','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('CARTA','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('CARTA DE ORDEN INTERNO','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('OFICIO','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ACTA DE SESIÓN','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ACTA DE AUDIENCIA DE INSTALACIÓN DE TRIBUNAL ARBITRAL','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ACTA DE AUDIENCIA DE CONCILIACIÓN','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('FIJACIÓN DE PUNTOS CONTROVERTIDOS Y ADMISIÓN DE MEDIOS PROBATORIOS','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ACTA DE AUDIENCIA PERICIAL','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ACTA DE AUDIENCIA DE INFORMES ORALES','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ACTA DE ACTUACIÓN DE MEDIOS PROBATORIOS','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('ACTA DE ILUSTRACIÓN DE HECHOS','H');
	Insert into tra_tbdocumentosinternos(desdocint,estdocint) values('INFORME','H');

/* =========================================== */
/* TABLA : CORRELATIVO DE DOCUMENTOS INTERNOS  */
/* =========================================== */
	drop table if exists tra_tbdocumentosinternos_correlativos;
	create table tra_tbdocumentosinternos_correlativos(
	id				INT 				NOT NULL AUTO_INCREMENT,
	idtipdoc		INT				NULL,
	anio			VARCHAR(4)		NULL,
	numero		VARCHAR(6)		NULL,
	PRIMARY KEY (id)
	);
	
/* ====================================== */
/* TABLA : ESTADOS */
/* ====================================== */
	drop table if exists tra_tbestado;
	create table tra_tbestado(
	id			INT 				NOT NULL AUTO_INCREMENT,
	desest	VARCHAR(150) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbestado(desest) values('Pendiente');
	Insert into tra_tbestado(desest) values('Recibido');
	Insert into tra_tbestado(desest) values('Admitido');
	Insert into tra_tbestado(desest) values('Observado');
	Insert into tra_tbestado(desest) values('Finalizado');

/* ====================================== */
/* TABLA : ESTADO DE REGISTRO */
/* ====================================== */
	drop table if exists tra_tbestadoreg;
	create table tra_tbestadoreg(
	id				VARCHAR(1) 		NOT NULL,
	desestreg	VARCHAR(150) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbestadoreg(id,desestreg) values('H','Habilitado');
	Insert into tra_tbestadoreg(id,desestreg) values('D','Deshabilitado');
	
/* ====================================== */
/* TABLA : SITUACION */
/* ====================================== */
	drop table if exists tra_tbsituacion;
	create table tra_tbsituacion(
	id			INT 				NOT NULL AUTO_INCREMENT,
	dessit	VARCHAR(150) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbsituacion(dessit) values('Por Firmar');
	Insert into tra_tbsituacion(dessit) values('Enviado');

/* ====================================== */
/* TABLA : PERFIL */
/* ====================================== */
	drop table if exists tra_tbperfil;
	create table tra_tbperfil(
	id					INT 				NOT NULL AUTO_INCREMENT,
	desperfil		VARCHAR(150) 	NOT NULL,
	flgusuario		VARCHAR(1)		NULL,
	flgdocinterno	VARCHAR(1)		NULL,
	flgmesapartes	VARCHAR(1)		NULL,
	flgatencion		VARCHAR(1)		NULL,
	flgatendidos	VARCHAR(1)		NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbperfil(desperfil,flgusuario,flgdocinterno,flgmesapartes,flgatencion,flgatendidos) values('ADMINISTRADOR','S','S','N','N','N');
	Insert into tra_tbperfil(desperfil,flgusuario,flgdocinterno,flgmesapartes,flgatencion,flgatendidos) values('RECEPCION','N','N','S','N','N');
	Insert into tra_tbperfil(desperfil,flgusuario,flgdocinterno,flgmesapartes,flgatencion,flgatendidos) values('ATENCION','N','N','N','S','S');
/* ====================================== */
/* TABLA : AREA */
/* ====================================== */
	drop table if exists tra_tbarea;
	create table tra_tbarea(
	id			INT 				NOT NULL AUTO_INCREMENT,
	desarea	VARCHAR(150) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbarea(desarea) values('JUNTA GENERAL DE ACCIONISTAS');
	Insert into tra_tbarea(desarea) values('GERENCIA GENERAL');
	Insert into tra_tbarea(desarea) values('CONTABILIDAD');
	Insert into tra_tbarea(desarea) values('MARKETING');
	Insert into tra_tbarea(desarea) values('SISTEMAS Y REDES INFORMÁTICAS');
	Insert into tra_tbarea(desarea) values('CONSERJERIA');
	Insert into tra_tbarea(desarea) values('CONSEJO SUPERIOR DE ARBITRAJE');
	Insert into tra_tbarea(desarea) values('SECRETARIA GENERAL');
	Insert into tra_tbarea(desarea) values('POOL DE SECRETARIOS ARBITRALES');
	Insert into tra_tbarea(desarea) values('POOL DE ARBITROS');
	Insert into tra_tbarea(desarea) values('MESA DE PARTES');

/* ====================================== */
/* TABLA : CARGO */
/* ====================================== */
	drop table if exists tra_tbcargo;
	create table tra_tbcargo(
	id			INT 				NOT NULL AUTO_INCREMENT,
	descargo	VARCHAR(150) 	NOT NULL,
	PRIMARY KEY (id)
	);
	Insert into tra_tbcargo(descargo) values('ACCIONISTA');
	Insert into tra_tbcargo(descargo) values('GERENTE GENERAL');
	Insert into tra_tbcargo(descargo) values('ASISTENTE GERENCIA GENERAL');
	Insert into tra_tbcargo(descargo) values('CONTADOR');
	Insert into tra_tbcargo(descargo) values('ASISTENTE CONTABILIDAD');
	Insert into tra_tbcargo(descargo) values('COORDINADOR DE MARKETING');
	Insert into tra_tbcargo(descargo) values('COORDINADOR DE SISTEMAS');
	Insert into tra_tbcargo(descargo) values('CONSERJE');
	Insert into tra_tbcargo(descargo) values('CONSEJERO');
	Insert into tra_tbcargo(descargo) values('SECRETARÌA GENERAL');
	Insert into tra_tbcargo(descargo) values('SECRETARIA GENERAL ADJUNTA');
	Insert into tra_tbcargo(descargo) values('SECRETARIO ARBITRAL');
	Insert into tra_tbcargo(descargo) values('ASISTENTE DE SECRETARIO ARBITRAL');
	Insert into tra_tbcargo(descargo) values('ARBITRO');
	Insert into tra_tbcargo(descargo) values('ASISTENTE DE MESA DE PARTES');
/* ====================================== */
/* TABLA : USUARIO */
/* ====================================== */
	drop table if exists tra_tbusuario;
	create table tra_tbusuario(
	id				INT 				NOT NULL AUTO_INCREMENT,
	tipdoc		VARCHAR(1) 		NOT NULL,
	nrodoc		VARCHAR(20) 	NOT NULL,
	nomraz		VARCHAR(150)	NULL,
	direma		VARCHAR(180)	NOT NULL,
	numtel		VARCHAR(20)		NULL,
	passwd		VARCHAR(150)	NOT NULL,
	flgTipUsr	VARCHAR(1)		NULL,
	idarea		INT				NULL,
	nombre		VARCHAR(50)		NULL,
	apepat		VARCHAR(100)	NULL,
	apemat		VARCHAR(100)	NULL,
	idcargo		INT				NULL,
	idperfil		INT				NULL,
	idest			VARCHAR(1)		NULL,
	PRIMARY KEY (id)
	);
	/* usuarios externos */
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idest) VALUES(2,'12345678','Jimmy Pisfil','jimmypisfil156@hotmail.com','123456789','123','E','H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idest) VALUES(2,'44802443','David Montenegro','david.montenegro.s@hotmail.com','993127748','123','E','H');
/* INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idest) VALUES(2,'44802443','David Montenegro','montenegro.sarmiento.david@gmail.com','993127748','123','E','H'); */
	
	/* usuarios internos */
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Accionista','accionista@demo.com','3211458','123','I',1,'Usuario','Accionista','',2,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Gerente General','gerente@demo.com','3211458','123','I',2,'Usuario','Gerente','',3,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Asistente Gerencia General','asistente_gerencia@demo.com','3211458','123','I',2,'Usuario','Asistente','Gerencia',4,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Contador','contador@demo.com','3211458','123','I',3,'Usuario','Contador','',5,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Asistente Contabilidad','asistente_contador@demo.com','3211458','123','I',3,'Usuario','Asistente','Contador',6,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Coordinador de Marketing','coordinador_marketing@demo.com','3211458','123','I',4,'Usuario','Coordinador','Marketing',7,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Coordinador de Sistemas','coordinador_sistemas@demo.com','3211458','123','I',5,'Usuario','Coordinador','Sistemas',8,1,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Conserje','conserje@demo.com','3211458','123','I',6,'Usuario','Conserje','',9,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Consejero','consejero@demo.com','3211458','123','I',7,'Usuario','Consejero','',10,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Secretaria General','secretaria_general@demo.com','3211458','123','I',8,'Usuario','Secretaria','General',11,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Secretaria General Adjunta','secretaria_general_2@demo.com','3211458','123','I',8,'Usuario','Secretaria Adjunta','',12,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Secretario Arbitral','secretario_arbitral@demo.com','3211458','123','I',9,'Usuario','Secretario','Arbitral',13,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Asistente de Secretario Arbitral','asistente_secretario@demo.com','3211458','123','I',9,'Usuario','Asistente','Secretario',14,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Arbitro','arbitro@demo.com','3211458','123','I',10,'Usuario','Arbitro','',15,3,'H');
	INSERT INTO tra_tbusuario(tipdoc,nrodoc,nomraz,direma,numtel,passwd,flgTipUsr,idarea,nombre,apepat,apemat,idcargo,idperfil,idest) VALUES (2,'123456789','Asistente de Mesa de Partes','asistente_mesapartes@demo.com','3211458','123','I',11,'Usuario','Asistente','Mesa de Partes',16,2,'H');

/* ====================================== */
/* TABLA : TIPO DE DOCUMENTO DE IDENTIDAD */
/* ====================================== */
	drop table if exists tra_tbtipdoc;
	create table tra_tbtipdoc(
	id			INT 				NOT NULL AUTO_INCREMENT,
	tipdoc	VARCHAR(150) 	NOT NULL,
	PRIMARY KEY (id)
	);
--	insert into tra_tbtipdoc(tipdoc) values('Seleccionar');
	insert into tra_tbtipdoc(tipdoc) values('DOCUMENTO NACIONAL DE IDENTIDAD');
	insert into tra_tbtipdoc(tipdoc) values('REGISTRO ÚNICO DE CONTRIBUYENTE');
	insert into tra_tbtipdoc(tipdoc) values('CARNET DE EXTRANJERÍA');
	insert into tra_tbtipdoc(tipdoc) values('PASAPORTE');

/* ====================================== */
/* TABLA : SOLICITUD DE ARBITRAJE */
/* ====================================== */
	drop table if exists tra_tbSolicitud;
	create table tra_tbSolicitud(
	id			 	 INT				NOT NULL AUTO_INCREMENT,
	idUsuario	 INT				NOT NULL,	/* Identificador de Usuario*/	
	NumSol		 VARCHAR(15)	NULL,			/* Numero de Solicitud */
	FchCreSol	 DATE				NULL,			/* Fecha de Solicitud */
	HraCreSol	 TIME				NULL,			/* Hora de Solicitud */
	RazSocDem	 VARCHAR(150)	NULL, 		/* Razón social de demandante */
	TipDocDem	 VARCHAR(1)		NULL,			/* Tipo de documento de demandante */
	NumDocDem	 VARCHAR(20)	NULL,			/* Numero de documento de demandante */
	EscPubDem	 VARCHAR(250)	NULL, 		/* Datos de escritura publica acta legalizada etc. */
	DesDirDem	 VARCHAR(150)	NULL,			/* Domicilio de persona natural o juridica */
	ApeNomLeg	 VARCHAR(150)	NULL,			/* Apellidos y nombres de representante legal */
	TipDocRep	 VARCHAR(1)		NULL,			/* Tipo de documento de identidad de representante legal */
	NumDocRep	 VARCHAR(20)	NULL,			/* Numero de documento de identidad de representante legal */
	NumTelRep	 VARCHAR(20)	NULL,			/* Numero de telefono de representante */
	NumCelRep	 VARCHAR(20)	NULL,			/* Numero de celular de representante */
	DirEmaRep	 VARCHAR(150)	NULL,			/* Dirección de correo electronico de representante */
	TipDocEmiCom VARCHAR(1)		NULL,			/* Tipo de comprobante de pago para emitir  */
	NumDocEmiCom VARCHAR(20)	NULL,			/* Numero de documento de identidad dependiendo Tipo de documento  */
	RazSocEmiCom VARCHAR(150)	NULL,			/* Razon social para emision de crompobante en caso elija Boleta */
	RazSocDmd	 VARCHAR(150)	NULL,       /* Razón Social de demandado */
	DesDirDmd	 VARCHAR(150)	NULL,       /* Dirección de demandado */
	TipDocDmd	 VARCHAR(2)		NULL,			/* Tipo de documento de identidad del demandado */
	NumDocDmd	 VARCHAR(20)	NULL,			/* Numero de documento del del demandado */
	NumTelDmd	 VARCHAR(20)	NULL,       /* Numero de Telefono de demandado */
	NumCelDmd	 VARCHAR(20)	NULL,       /* Numero de Celular de demandado */
	DirEmaDmd	 VARCHAR(150)	NULL,       /* Correo electronico de demandado */
	AutRepDmd	 VARCHAR(150)  NULL,			/* Auitoridad o representante */
	ProPubDmd	 VARCHAR(150)  NULL,       /* Procurador público de corresponder */
	DesConArb	 TEXT 			NULL,       /* Detalle de convenio arbitral */
	flgCtrDer	 VARCHAR(1)		NULL,			/* Indicador de Controversia de Derecho */
	flgCtrCon	 VARCHAR(1)		NULL,			/* Indicador de Controversia de Consiciencia */
	flgCtrNac	 VARCHAR(1)		NULL,			/* Indicador de Controversia Nacional */
	flgCtrInt	 VARCHAR(1)		NULL,			/* Indicador de Controversia Internacional */
	flgEspCtr	 VARCHAR(1)		NULL,			/* Indicador de Especialidad por contratación Pública */
	flgEspCiv	 VARCHAR(1)		NULL,			/* Indicador de Especialidad Civil */
	flgEspLey	 VARCHAR(1)		NULL,			/* Indicador de Especialidad Ley General */
	flgEspMin	 VARCHAR(1)		NULL,			/* Indicador de Especialidad Minero */
	flgEspCon	 VARCHAR(1)		NULL,			/* Indicador de Especialidad Conseciones */
	flgEspOtr	 VARCHAR(1)		NULL,			/* Indicador de Especialidad Otros */
	DesNarHec	 VARCHAR(950)	NULL,       /* Descripción de Naracción de Hechos. */
	DesMedCau	 TEXT				NULL,       /* Descripción de Medida Cautelar */
	TipCuant	 	 VARCHAR(2)		NULL,			/* Tipo de Cuantia */
	MonCuant		 VARCHAR(2)		NULL,			/* Moneda de Cuantia */
	ImpNCuant	 VARCHAR(20)	NULL,			/* Importe en numero de cuatía */
	ImpLCuant	 VARCHAR(150)	NULL,			/* Importe en Letras de cuentía */
	ApeNomArb	 VARCHAR(150)	NULL,			/* Apellidos y Nombre de Arbitro */
	DesDirArb	 VARCHAR(150)	NULL,			/* Dirección de Arbitro */
	NumTelArb	 VARCHAR(20)	NULL,			/* Telefono de Arbitro */
	DirEmaArb	 VARCHAR(150)	NULL,			/* Email de Arbitro */
	NomProArb	 VARCHAR(150)	NULL,			/* Profesión de Arbitro */
	NumColArb	 VARCHAR(50)	NULL,			/* Numero de Colegiatura */
	FlgRegArb	 VARCHAR(1)		NULL,			/* Indicador de registro de Arbitros OSCE */
	FlgPrtArb	 VARCHAR(10)	NULL,			/* Indicador que indica si centro de arbitraje designa arbitro de parte */
	FlgUniArb	 VARCHAR(10)	NULL,			/* Indicador que indica si centro de arbitraje designa arbitro unico */
	/* -------- 20-07-01 Etapa 2 ----------*/
	idtipsol		 INT				NULL,			/* Tipo de solicitud*/
	dessum		 VARCHAR(180)	NULL,			/* Descripción de Sumilla*/
	desref		 VARCHAR(180)  NULL,			/* Descripcion de Referencia*/
	/* -------- 20-07-08 Etapa 2 ----------*/	
	nomtra		 VARCHAR(150)	NULL,			 /* Nombre de tramite*/
	idSit		 	 VARCHAR(1)		NULL,			 /* Codigo de Situación */
	idEst		 	 VARCHAR(1)		NULL,			 /* Codigo de Estado */
	FchUltMod	 DATE				NULL,			 /* Fecha de Ultima Modificación */
	flgNotDem	 VARCHAR(1)		DEFAULT 'N', /* Indicar de Notificación de correo de respuesta a demandado*/
	flgSolRes	 VARCHAR(1)		DEFAULT 'N', /* Indicar de respuesta a solicitud*/
	/* -------- 20-08-11 Etapa 3 ----------*/	
	desexicon	 TEXT				NULL,			/* Medida Cautelar : Validez o existencia de convenio arbitral */
	
	frmejenomper VARCHAR(150)	NULL,			/* Medida Cautelar : Nombre de persona a notificar */
	frmejedomper VARCHAR(250)	NULL,			/* Medida Cautelar : domicilio de persona a notificar */
	frmejetelper VARCHAR(20)	NULL,			/* Medida Cautelar : telefono de persona a notificar */
	frmejecelper VARCHAR(20)	NULL,			/* Medida Cautelar : celular de persona a notificar */
	frmejeemaper VARCHAR(150)	NULL,			/* Medida Cautelar : email de persona a notificar */
	frmejenomemp VARCHAR(150)	NULL,			/* Medida Cautelar : Nombre de empresa aseguradora a notificar */
	frmejedomemp VARCHAR(250)	NULL,			/* Medida Cautelar : domicilio de empresa aseguradora a notificar */
	frmejetelemp VARCHAR(20)	NULL,			/* Medida Cautelar : telefono de empresa aseguradora a notificar */
	frmejecelemp VARCHAR(20)	NULL,			/* Medida Cautelar : celular de empresa aseguradora a notificar */
	frmejeemaemp VARCHAR(150)	NULL,			/* Medida Cautelar : email de empresa aseguradora a notificar */
	desexpcon 	 TEXT				NULL,			/* Medida Cautelar : Excepción de conocimiento */
	despre01		 TEXT				NULL,			/* Medida Cautelar : Verificación y comprobación del presupuesto material verosimilitud  */
	despre02		 TEXT				NULL,			/* Medida Cautelar : Verificación y comprobación del presupuesto material peligro en la demora. */
	despre03		 TEXT				NULL,			/* Medida Cautelar : Verificación y justificación del presupuesto material de contracautela. */
	despreadi01	 TEXT				NULL,			/* Medida Cautelar : Inminencia de un perjuicio irreparable */
	despreadi02	 TEXT				NULL,			/* Medida Cautelar : Que la medida se circunscribe a las personas  */
	despreadi03	 TEXT				NULL,			/* Medida Cautelar : No resulta aplicable otra medida cautelar prevista. */
	PRIMARY KEY (id)
	);

/* ====================================== */
/* TABLA : PRETESIONES POR SOLICITUD */
	/* ====================================== */
	drop table if exists tra_tbSolicitudPretension;
	create table tra_tbSolicitudPretension(
	idSolicitud			 	INT				NOT NULL,
	idPretension			INT				NOT NULL,
	desPretension			VARCHAR(150)	NULL,
	PRIMARY KEY (idSolicitud,idPretension)
	);

/* ====================================== */
/* TABLA : TRAMITES DE SOLICITUD */
/* ====================================== */
	drop table if exists tbsolicitudtramite;
	create table tbsolicitudtramite(
	idsolicitud		 	int				not null,
	idtramite			int				not null,
	idsumilla			int				not null,
	nomtramite			varchar(150)	null,
	referencia			varchar(80)		null,
	detalle				text				null,
	nomfileloc			varchar(250)	null,
	nomfileser			varchar(250)	null,
	fchcreacion			date				null,
	hracreacion			time				null,
	primary key (idsolicitud,idtramite)
	);
	/* ====================================== */
	/* TABLA : ENVIOS POR SOLICITUD */
	/* ====================================== */
	drop table if exists tra_tbSolicitudRutas;
	create table tra_tbSolicitudRutas(
	idSolicitud			 	INT				NOT NULL,
	idruta					INT				NOT NULL,
/*	--------------------------------------------*/
	idtipdoc					INT				NULL,
	asunto					VARCHAR(150)	NULL,
	referencia				VARCHAR(150)	NULL,
	contenido				VARCHAR(250)	NULL,
	para						INT				NULL,
	idareaenvio				INT				NULL,
	fchenvio					DATE				NULL,
	hraenvio					TIME				NULL,
	idareadestino			INT				NULL,
	usrrecepcion			INT				NULL,
	fchrecepcion			DATE				NULL,
	hrarecepcion			TIME				NULL,
	flgrecepcion			VARCHAR(1)		NULL,
/*	--------------------------------------------*/
	numdocint				VARCHAR(20)		NULL,
	nomFileLoc				VARCHAR(250)	NULL,
	nomFileSer				VARCHAR(250)	NULL,
	idUsuario				INT 				NULL,
	fchCreacion				DATE				NULL,
	hraCreacion				TIME				NULL,
	flgEliminado 			VARCHAR(1) 		DEFAULT 'N', 
	PRIMARY KEY (idSolicitud,idruta)
	);
	/* ====================================== */
	/* TABLA : OBSERVACIONES POR SOLICITUD */
	/* ====================================== */
	drop table if exists tra_tbSolicitudObservacion;
	create table tra_tbSolicitudObservacion(
	idSolicitud			 	INT				NOT NULL,
	idObservacion			INT				NOT NULL,
	idarea					INT				NULL,
	asunto					VARCHAR(150)	NULL,
	desObservacion			VARCHAR(150)	NULL,
	nomFileLoc				VARCHAR(250)	NULL,
	nomFileSer				VARCHAR(250)	NULL,
	idUsuario				INT 				NOT NULL,
	fchCreacion				DATE				NULL,
	hraCreacion				TIME				NULL,
	PRIMARY KEY (idSolicitud,idObservacion)
	);
/* ====================================== */
/* TABLA : ANEXOS POR SOLICITUD */
/* ====================================== */
	drop table if exists tra_tbSolicitudAnexo;
	create table tra_tbSolicitudAnexo(
	idSolicitud		INT				NOT NULL,
	idAnexo			INT				NOT NULL,
	idTipo			VARCHAR(2)		NULL,
	nomFileLoc		VARCHAR(250)	NULL,
	nomFileSer		VARCHAR(250)	NULL,
	flgEliminado	VARCHAR(1)		NULL,
	PRIMARY KEY (idSolicitud,idAnexo)
	);