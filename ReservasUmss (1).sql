
/*==============================================================*/
/* Table: AMBIENTE                                              */
/*==============================================================*/
create table AMBIENTE 
(
   ID_AMBIENTE          integer     not null ,
   ID_UBICACION         integer                        null,
   NOMBRE               varchar(100)                   null,
   CAPACIDAD            integer                        null,
   IMG_AMBIENTE         varchar(100)                   null,
   ESTADO               varchar(10)                    null,
   TIPO                 varchar(100)                   null,
   constraint PK_AMBIENTE primary key (ID_AMBIENTE)
);

/*==============================================================*/
/* Index: AMBIENTE_PK                                           */
/*==============================================================*/
create unique index AMBIENTE_PK on AMBIENTE (
ID_AMBIENTE ASC
);

/*==============================================================*/
/* Index: ESTA_EN_FK                                            */
/*==============================================================*/
create index ESTA_EN_FK on AMBIENTE (
ID_UBICACION ASC
);

/*==============================================================*/
/* Table: BITACORA_AMBIENTE                                     */
/*==============================================================*/
create table BITACORA_AMBIENTE 
(
   ID_BI_AMBIENTE       integer        not null ,
   ACCION               varchar(100)                   null,
   DESCRIPCION          varchar(200)                   null,
   FECHA_Y_HORA         timestamp                      null,
   USUARIO              varchar(100)                   null,
   constraint PK_BITACORA_AMBIENTE primary key (ID_BI_AMBIENTE)
);

/*==============================================================*/
/* Index: BITACORA_AMBIENTE_PK                                  */
/*==============================================================*/
create unique index BITACORA_AMBIENTE_PK on BITACORA_AMBIENTE (
ID_BI_AMBIENTE ASC
);

/*==============================================================*/
/* Table: BITACORA_RESERVA                                      */
/*==============================================================*/
create table BITACORA_RESERVA 
(
   ID_BI_RESERVA        integer         not null ,
   ACCION               varchar(100)                   null,
   DESCRIPCION          varchar(200)                   null,
   FECHA_Y_HORA         timestamp                      null,
   USUARIO              varchar(100)                   null,
   constraint PK_BITACORA_RESERVA primary key (ID_BI_RESERVA)
);

/*==============================================================*/
/* Index: BITACORA_RESERVA_PK                                   */
/*==============================================================*/
create unique index BITACORA_RESERVA_PK on BITACORA_RESERVA (
ID_BI_RESERVA ASC
);

/*==============================================================*/
/* Table: BITACORA_USUARIO                                      */
/*==============================================================*/
create table BITACORA_USUARIO 
(
   ID_BI_USUARIO        integer       not null ,
   ACCION               varchar(100)                   null,
   DESCRIPCION          varchar(200)                   null,
   FECHA_Y_HORA         timestamp                      null,
   USUARIO              varchar(100)                   null,
   constraint PK_BITACORA_USUARIO primary key (ID_BI_USUARIO)
);

/*==============================================================*/
/* Index: BITACORA_USUARIO_PK                                   */
/*==============================================================*/
create unique index BITACORA_USUARIO_PK on BITACORA_USUARIO (
ID_BI_USUARIO ASC
);

/*==============================================================*/
/* Table: CALENDARIO                                            */
/*==============================================================*/
create table CALENDARIO 
(
   ID_EVENTO            integer        not null ,
   NOMBRE               varchar(100)                   null,
   FECHA                date                           null,
   constraint PK_CALENDARIO primary key (ID_EVENTO)
);

/*==============================================================*/
/* Index: CALENDARIO_PK                                         */
/*==============================================================*/
create unique index CALENDARIO_PK on CALENDARIO (
ID_EVENTO ASC
);

/*==============================================================*/
/* Table: CARRERA                                               */
/*==============================================================*/
create table CARRERA 
(
   ID_CARRERA           integer          not null ,
   NOMBRE               varchar(100)                   null,
   constraint PK_CARRERA primary key (ID_CARRERA)
);

/*==============================================================*/
/* Index: CARRERA_PK                                            */
/*==============================================================*/
create unique index CARRERA_PK on CARRERA (
ID_CARRERA ASC
);

/*==============================================================*/
/* Table: DICTA                                                 */
/*==============================================================*/
create table DICTA 
(
   ID_MATERIA           integer                        not null,
   ID_USUARIO           integer                        not null,
   GRUPO                varchar(100)                   null,
   constraint PK_DICTA primary key (ID_MATERIA, ID_USUARIO)
);

/*==============================================================*/
/* Index: DICTA_PK                                              */
/*==============================================================*/
create unique index DICTA_PK on DICTA (
ID_MATERIA ASC,
ID_USUARIO ASC
);

/*==============================================================*/
/* Index: DICTA2_FK                                             */
/*==============================================================*/
create index DICTA2_FK on DICTA (
ID_USUARIO ASC
);

/*==============================================================*/
/* Index: DICTA_FK                                              */
/*==============================================================*/
create index DICTA_FK on DICTA (
ID_MATERIA ASC
);

/*==============================================================*/
/* Table: GESTION                                               */
/*==============================================================*/
create table GESTION 
(
   ID_GESTION           integer       not null ,
   NOMBRE               varchar(100)                   null,
   FECHA_INICIO         date                           null,
   FECHA_FIN            date                           null,
   constraint PK_GESTION primary key (ID_GESTION)
);

/*==============================================================*/
/* Index: GESTION_PK                                            */
/*==============================================================*/
create unique index GESTION_PK on GESTION (
ID_GESTION ASC
);

/*==============================================================*/
/* Table: HORARIO                                               */
/*==============================================================*/
create table HORARIO 
(
   ID_HORARIO           integer        not null ,
   HORA                 time                           null,
   constraint PK_HORARIO primary key (ID_HORARIO)
);

/*==============================================================*/
/* Index: HORARIO_PK                                            */
/*==============================================================*/
create unique index HORARIO_PK on HORARIO (
ID_HORARIO ASC
);

/*==============================================================*/
/* Table: MATERIA                                               */
/*==============================================================*/
create table MATERIA 
(
   ID_MATERIA           integer        not null ,
   NOMBRE               varchar(100)                   null,
   constraint PK_MATERIA primary key (ID_MATERIA)
);

/*==============================================================*/
/* Index: MATERIA_PK                                            */
/*==============================================================*/
create unique index MATERIA_PK on MATERIA (
ID_MATERIA ASC
);

/*==============================================================*/
/* Table: PUEDE_TENER                                           */
/*==============================================================*/
create table PUEDE_TENER 
(
   ID_MATERIA           integer                        not null,
   ID_CARRERA           integer                        not null,
   constraint PK_PUEDE_TENER primary key (ID_MATERIA, ID_CARRERA)
);

/*==============================================================*/
/* Index: PUEDE_TENER_PK                                        */
/*==============================================================*/
create unique index PUEDE_TENER_PK on PUEDE_TENER (
ID_MATERIA ASC,
ID_CARRERA ASC
);

/*==============================================================*/
/* Index: PUEDE_TENER2_FK                                       */
/*==============================================================*/
create index PUEDE_TENER2_FK on PUEDE_TENER (
ID_CARRERA ASC
);

/*==============================================================*/
/* Index: PUEDE_TENER_FK                                        */
/*==============================================================*/
create index PUEDE_TENER_FK on PUEDE_TENER (
ID_MATERIA ASC
);

/*==============================================================*/
/* Table: REALIZA                                               */
/*==============================================================*/
create table REALIZA 
(
   ID_RESERVA           integer                        not null,
   ID_USUARIO           integer                        not null,
   constraint PK_REALIZA primary key (ID_RESERVA, ID_USUARIO)
);

/*==============================================================*/
/* Index: REALIZA_PK                                            */
/*==============================================================*/
create unique index REALIZA_PK on REALIZA (
ID_RESERVA ASC,
ID_USUARIO ASC
);

/*==============================================================*/
/* Index: REALIZA2_FK                                           */
/*==============================================================*/
create index REALIZA2_FK on REALIZA (
ID_USUARIO ASC
);

/*==============================================================*/
/* Index: REALIZA_FK                                            */
/*==============================================================*/
create index REALIZA_FK on REALIZA (
ID_RESERVA ASC
);

/*==============================================================*/
/* Table: RESERVA                                               */
/*==============================================================*/
create table RESERVA 
(
   ID_RESERVA           integer        not null ,
   ID_HORARIO           integer                        null,
   ID_GESTION           integer                        null,
   ID_AMBIENTE          integer                        null,
   MOTIVO               varchar(200)                   null,
   ESTADO               varchar(10)                    null,
   constraint PK_RESERVA primary key (ID_RESERVA)
);

/*==============================================================*/
/* Index: RESERVA_PK                                            */
/*==============================================================*/
create unique index RESERVA_PK on RESERVA (
ID_RESERVA ASC
);

/*==============================================================*/
/* Index: ES_PARTE_FK                                           */
/*==============================================================*/
create index ES_PARTE_FK on RESERVA (
ID_HORARIO ASC
);

/*==============================================================*/
/* Index: PERTENECE_A_UNA_FK                                    */
/*==============================================================*/
create index PERTENECE_A_UNA_FK on RESERVA (
ID_GESTION ASC
);

/*==============================================================*/
/* Index: PUEDE_TENER_VARIAS_FK                                 */
/*==============================================================*/
create index PUEDE_TENER_VARIAS_FK on RESERVA (
ID_AMBIENTE ASC
);

/*==============================================================*/
/* Table: ROL                                                   */
/*==============================================================*/
create table ROL 
(
   ID_ROL               integer        not null ,
   NOMBRE               varchar(100)                   null,
   constraint PK_ROL primary key (ID_ROL)
);

/*==============================================================*/
/* Index: ROL_PK                                                */
/*==============================================================*/
create unique index ROL_PK on ROL (
ID_ROL ASC
);

/*==============================================================*/
/* Table: UBICACION                                             */
/*==============================================================*/
create table UBICACION 
(
   ID_UBICACION         integer       not null ,
   LUGAR                varchar(50)                    null,
   PISO                 varchar(50)                    null,
   constraint PK_UBICACION primary key (ID_UBICACION)
);

/*==============================================================*/
/* Index: UBICACION_PK                                          */
/*==============================================================*/
create unique index UBICACION_PK on UBICACION (
ID_UBICACION ASC
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO 
(
   ID_USUARIO           integer        not null , 
   ID_ROL               integer                        null,
   NOMBRE               varchar(100)                   null,
   APELLIDO             varchar(100)                   null,
   CORREO               varchar(100)                   null,
   CONTRASENA           varchar(200)                   null,
   CI                   varchar(100)                   null,
   constraint PK_USUARIO primary key (ID_USUARIO)
);

/*==============================================================*/
/* Index: USUARIO_PK                                            */
/*==============================================================*/
create unique index USUARIO_PK on USUARIO (
ID_USUARIO ASC
);

/*==============================================================*/
/* Index: TIENE_FK                                              */
/*==============================================================*/
create index TIENE_FK on USUARIO (
ID_ROL ASC
);

alter table AMBIENTE
   add constraint FK_AMBIENTE_ESTA_EN_UBICACIO foreign key (ID_UBICACION)
      references UBICACION (ID_UBICACION)
      on update restrict
      on delete restrict;

alter table DICTA
   add constraint FK_DICTA_DICTA_MATERIA foreign key (ID_MATERIA)
      references MATERIA (ID_MATERIA)
      on update restrict
      on delete restrict;

alter table DICTA
   add constraint FK_DICTA_DICTA2_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on update restrict
      on delete restrict;

alter table PUEDE_TENER
   add constraint FK_PUEDE_TE_PUEDE_TEN_MATERIA foreign key (ID_MATERIA)
      references MATERIA (ID_MATERIA)
      on update restrict
      on delete restrict;

alter table PUEDE_TENER
   add constraint FK_PUEDE_TE_PUEDE_TEN_CARRERA foreign key (ID_CARRERA)
      references CARRERA (ID_CARRERA)
      on update restrict
      on delete restrict;

alter table REALIZA
   add constraint FK_REALIZA_REALIZA_RESERVA foreign key (ID_RESERVA)
      references RESERVA (ID_RESERVA)
      on update restrict
      on delete restrict;

alter table REALIZA
   add constraint FK_REALIZA_REALIZA2_USUARIO foreign key (ID_USUARIO)
      references USUARIO (ID_USUARIO)
      on update restrict
      on delete restrict;

alter table RESERVA
   add constraint FK_RESERVA_ES_PARTE_HORARIO foreign key (ID_HORARIO)
      references HORARIO (ID_HORARIO)
      on update restrict
      on delete restrict;

alter table RESERVA
   add constraint FK_RESERVA_PERTENECE_GESTION foreign key (ID_GESTION)
      references GESTION (ID_GESTION)
      on update restrict
      on delete restrict;

alter table RESERVA
   add constraint FK_RESERVA_PUEDE_TEN_AMBIENTE foreign key (ID_AMBIENTE)
      references AMBIENTE (ID_AMBIENTE)
      on update restrict
      on delete restrict;

alter table USUARIO
   add constraint FK_USUARIO_TIENE_ROL foreign key (ID_ROL)
      references ROL (ID_ROL)
      on update restrict
      on delete restrict;

