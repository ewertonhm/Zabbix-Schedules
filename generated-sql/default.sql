
BEGIN;

-----------------------------------------------------------------------
-- grupo
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "grupo" CASCADE;

CREATE TABLE "grupo"
(
    "id" serial NOT NULL,
    "nome" VARCHAR(50) NOT NULL,
    "zabbixid" VARCHAR(10) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- grupo_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "grupo_schedule" CASCADE;

CREATE TABLE "grupo_schedule"
(
    "id" serial NOT NULL,
    "description" VARCHAR(100),
    "schedule_id" INTEGER NOT NULL,
    "usuario_id" INTEGER NOT NULL,
    "grupo_id" INTEGER NOT NULL,
    "scheduled" VARCHAR(50) NOT NULL,
    "push_pop" VARCHAR(1) NOT NULL,
    "enabled" VARCHAR(1) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- host
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "host" CASCADE;

CREATE TABLE "host"
(
    "id" serial NOT NULL,
    "nome" VARCHAR(50) NOT NULL,
    "zabbixid" VARCHAR(10) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- host_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "host_schedule" CASCADE;

CREATE TABLE "host_schedule"
(
    "id" serial NOT NULL,
    "description" VARCHAR(100),
    "scheduled" VARCHAR(50) NOT NULL,
    "schedule_id" INTEGER NOT NULL,
    "host_id" INTEGER NOT NULL,
    "push_pop" VARCHAR(1) NOT NULL,
    "enabled" VARCHAR(1) NOT NULL,
    "usuario_id" INTEGER,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log" CASCADE;

CREATE TABLE "log"
(
    "id" serial NOT NULL,
    "logtime" VARCHAR(50) NOT NULL,
    "usuario_id" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_delete_grupo_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_delete_grupo_schedule" CASCADE;

CREATE TABLE "log_delete_grupo_schedule"
(
    "id" serial NOT NULL,
    "grupo_schedule_id" INTEGER NOT NULL,
    "log_id" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_delete_host_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_delete_host_schedule" CASCADE;

CREATE TABLE "log_delete_host_schedule"
(
    "id" serial NOT NULL,
    "host_schedule_id" INTEGER NOT NULL,
    "log_id" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_delete_macro_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_delete_macro_schedule" CASCADE;

CREATE TABLE "log_delete_macro_schedule"
(
    "id" serial NOT NULL,
    "macro_schedule_id" INTEGER NOT NULL,
    "log_id" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_edit_host_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_edit_host_schedule" CASCADE;

CREATE TABLE "log_edit_host_schedule"
(
    "id" serial NOT NULL,
    "host_schedule_id" INTEGER NOT NULL,
    "old_host_id" INTEGER NOT NULL,
    "new_host_id" INTEGER NOT NULL,
    "log_id" INTEGER NOT NULL,
    "old_data_from" VARCHAR(50) NOT NULL,
    "new_date_from" VARCHAR(50) NOT NULL,
    "old_date_until" VARCHAR(50) NOT NULL,
    "new_date_until" VARCHAR(50) NOT NULL,
    "old_push_pop" VARCHAR(1) NOT NULL,
    "new_push_pop" VARCHAR(1) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_edite_grupo_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_edite_grupo_schedule" CASCADE;

CREATE TABLE "log_edite_grupo_schedule"
(
    "id" serial NOT NULL,
    "grupo_schedule_id" INTEGER NOT NULL,
    "log_id" INTEGER NOT NULL,
    "old_date_from" VARCHAR(50) NOT NULL,
    "new_date_from" VARCHAR(50) NOT NULL,
    "old_date_until" VARCHAR(50) NOT NULL,
    "new_date_until" VARCHAR(50) NOT NULL,
    "old_grupo_id" INTEGER NOT NULL,
    "new_grupo_id" INTEGER NOT NULL,
    "old_push_pop" VARCHAR(1) NOT NULL,
    "new_push_pop" VARCHAR(1) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_edite_macro_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_edite_macro_schedule" CASCADE;

CREATE TABLE "log_edite_macro_schedule"
(
    "id" serial NOT NULL,
    "macro_schedule_id" INTEGER NOT NULL,
    "log_id" INTEGER NOT NULL,
    "old_date_from" VARCHAR(50) NOT NULL,
    "new_date_from" VARCHAR(50) NOT NULL,
    "old_date_until" VARCHAR(50) NOT NULL,
    "new_date_until" VARCHAR(50) NOT NULL,
    "old_original_value" VARCHAR(50) NOT NULL,
    "new_original_value" VARCHAR(50) NOT NULL,
    "old_new_value" VARCHAR(50) NOT NULL,
    "new_new_value" VARCHAR(50) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_grupo_execution
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_grupo_execution" CASCADE;

CREATE TABLE "log_grupo_execution"
(
    "id" serial NOT NULL,
    "grupo_schedule_id" INTEGER NOT NULL,
    "push_pop" VARCHAR(1) NOT NULL,
    "logtime" VARCHAR(50) NOT NULL,
    "details" VARCHAR(100),
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_host_execution
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_host_execution" CASCADE;

CREATE TABLE "log_host_execution"
(
    "id" serial NOT NULL,
    "logtime" VARCHAR(50) NOT NULL,
    "host_schedule_id" INTEGER NOT NULL,
    "details" VARCHAR(50),
    "push_pop" VARCHAR(1) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- log_macro_execution
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "log_macro_execution" CASCADE;

CREATE TABLE "log_macro_execution"
(
    "id" serial NOT NULL,
    "macro_schedule_id" INTEGER NOT NULL,
    "push_pop" VARCHAR(1) NOT NULL,
    "logtime" VARCHAR(50) NOT NULL,
    "details" VARCHAR(100),
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- macro
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "macro" CASCADE;

CREATE TABLE "macro"
(
    "id" serial NOT NULL,
    "nome" VARCHAR(50) NOT NULL,
    "zabbixid" VARCHAR(10) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- macro_schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "macro_schedule" CASCADE;

CREATE TABLE "macro_schedule"
(
    "id" serial NOT NULL,
    "description" VARCHAR(100),
    "schedule_id" INTEGER NOT NULL,
    "host_id" INTEGER NOT NULL,
    "usuario_id" INTEGER NOT NULL,
    "macro_id" INTEGER NOT NULL,
    "scheduled" VARCHAR(50) NOT NULL,
    "enabled" VARCHAR(1) NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- schedule
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "schedule" CASCADE;

CREATE TABLE "schedule"
(
    "id" serial NOT NULL,
    "original_value" VARCHAR(50) NOT NULL,
    "new_value" VARCHAR(50) NOT NULL,
    "date_from" VARCHAR(50) NOT NULL,
    "date_until" VARCHAR(50),
    "executed" BOOLEAN(1),
    "reverted" BOOLEAN(1),
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- usuario
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "usuario" CASCADE;

CREATE TABLE "usuario"
(
    "id" serial NOT NULL,
    "login" VARCHAR(50) NOT NULL,
    "nome" VARCHAR(50),
    "senha" VARCHAR(32) NOT NULL,
    "admin" VARCHAR(1),
    "enabled" VARCHAR(1) NOT NULL,
    PRIMARY KEY ("id")
);

ALTER TABLE "grupo_schedule" ADD CONSTRAINT "grupo_schedule_grupo_id_fkey"
    FOREIGN KEY ("grupo_id")
    REFERENCES "grupo" ("id");

ALTER TABLE "grupo_schedule" ADD CONSTRAINT "grupo_schedule_schedule_id_fkey"
    FOREIGN KEY ("schedule_id")
    REFERENCES "schedule" ("id");

ALTER TABLE "grupo_schedule" ADD CONSTRAINT "grupo_schedule_usuario_id_fkey"
    FOREIGN KEY ("usuario_id")
    REFERENCES "usuario" ("id");

ALTER TABLE "host_schedule" ADD CONSTRAINT "host_schedule_host_id_fkey"
    FOREIGN KEY ("host_id")
    REFERENCES "host" ("id");

ALTER TABLE "host_schedule" ADD CONSTRAINT "host_schedule_schedule_id_fkey"
    FOREIGN KEY ("schedule_id")
    REFERENCES "schedule" ("id");

ALTER TABLE "host_schedule" ADD CONSTRAINT "host_schedule_usuario_id_fkey"
    FOREIGN KEY ("usuario_id")
    REFERENCES "usuario" ("id");

ALTER TABLE "log" ADD CONSTRAINT "log_usuario_id_fkey"
    FOREIGN KEY ("usuario_id")
    REFERENCES "usuario" ("id");

ALTER TABLE "log_delete_grupo_schedule" ADD CONSTRAINT "log_delete_grupo_schedule_grupo_schedule_id_fkey"
    FOREIGN KEY ("grupo_schedule_id")
    REFERENCES "grupo_schedule" ("id");

ALTER TABLE "log_delete_grupo_schedule" ADD CONSTRAINT "log_delete_grupo_schedule_log_id_fkey"
    FOREIGN KEY ("log_id")
    REFERENCES "log" ("id");

ALTER TABLE "log_delete_host_schedule" ADD CONSTRAINT "log_delete_host_schedule_host_schedule_id_fkey"
    FOREIGN KEY ("host_schedule_id")
    REFERENCES "host_schedule" ("id");

ALTER TABLE "log_delete_host_schedule" ADD CONSTRAINT "log_delete_host_schedule_log_id_fkey"
    FOREIGN KEY ("log_id")
    REFERENCES "log" ("id");

ALTER TABLE "log_delete_macro_schedule" ADD CONSTRAINT "log_delete_macro_schedule_log_id_fkey"
    FOREIGN KEY ("log_id")
    REFERENCES "log" ("id");

ALTER TABLE "log_delete_macro_schedule" ADD CONSTRAINT "log_delete_macro_schedule_macro_schedule_id_fkey"
    FOREIGN KEY ("macro_schedule_id")
    REFERENCES "macro_schedule" ("id");

ALTER TABLE "log_edit_host_schedule" ADD CONSTRAINT "log_edit_host_schedule_host_schedule_id_fkey"
    FOREIGN KEY ("host_schedule_id")
    REFERENCES "host_schedule" ("id");

ALTER TABLE "log_edit_host_schedule" ADD CONSTRAINT "log_edit_host_schedule_log_id_fkey"
    FOREIGN KEY ("log_id")
    REFERENCES "log" ("id");

ALTER TABLE "log_edit_host_schedule" ADD CONSTRAINT "log_edit_host_schedule_new_host_id_fkey"
    FOREIGN KEY ("new_host_id")
    REFERENCES "host" ("id");

ALTER TABLE "log_edit_host_schedule" ADD CONSTRAINT "log_edit_host_schedule_old_host_id_fkey"
    FOREIGN KEY ("old_host_id")
    REFERENCES "host" ("id");

ALTER TABLE "log_edite_grupo_schedule" ADD CONSTRAINT "log_edite_grupo_schedule_grupo_schedule_id_fkey"
    FOREIGN KEY ("grupo_schedule_id")
    REFERENCES "grupo_schedule" ("id");

ALTER TABLE "log_edite_grupo_schedule" ADD CONSTRAINT "log_edite_grupo_schedule_log_id_fkey"
    FOREIGN KEY ("log_id")
    REFERENCES "log" ("id");

ALTER TABLE "log_edite_grupo_schedule" ADD CONSTRAINT "log_edite_grupo_schedule_new_grupo_id_fkey"
    FOREIGN KEY ("new_grupo_id")
    REFERENCES "grupo" ("id");

ALTER TABLE "log_edite_grupo_schedule" ADD CONSTRAINT "log_edite_grupo_schedule_old_grupo_id_fkey"
    FOREIGN KEY ("old_grupo_id")
    REFERENCES "grupo" ("id");

ALTER TABLE "log_edite_macro_schedule" ADD CONSTRAINT "log_edite_macro_schedule_log_id_fkey"
    FOREIGN KEY ("log_id")
    REFERENCES "log" ("id");

ALTER TABLE "log_edite_macro_schedule" ADD CONSTRAINT "log_edite_macro_schedule_macro_schedule_id_fkey"
    FOREIGN KEY ("macro_schedule_id")
    REFERENCES "macro_schedule" ("id");

ALTER TABLE "log_grupo_execution" ADD CONSTRAINT "log_grupo_execution_grupo_schedule_id_fkey"
    FOREIGN KEY ("grupo_schedule_id")
    REFERENCES "grupo_schedule" ("id");

ALTER TABLE "log_host_execution" ADD CONSTRAINT "log_host_execution_host_schedule_id_fkey"
    FOREIGN KEY ("host_schedule_id")
    REFERENCES "host_schedule" ("id");

ALTER TABLE "log_macro_execution" ADD CONSTRAINT "log_macro_execution_macro_schedule_id_fkey"
    FOREIGN KEY ("macro_schedule_id")
    REFERENCES "macro_schedule" ("id");

ALTER TABLE "macro_schedule" ADD CONSTRAINT "macro_schedule_host_id_fkey"
    FOREIGN KEY ("host_id")
    REFERENCES "host" ("id");

ALTER TABLE "macro_schedule" ADD CONSTRAINT "macro_schedule_macro_id_fkey"
    FOREIGN KEY ("macro_id")
    REFERENCES "macro" ("id");

ALTER TABLE "macro_schedule" ADD CONSTRAINT "macro_schedule_schedule_id_fkey"
    FOREIGN KEY ("schedule_id")
    REFERENCES "schedule" ("id");

ALTER TABLE "macro_schedule" ADD CONSTRAINT "macro_schedule_usuario_id_fkey"
    FOREIGN KEY ("usuario_id")
    REFERENCES "usuario" ("id");

COMMIT;
