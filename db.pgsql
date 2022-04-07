CREATE TABLE macro (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    zabbixid VARCHAR(10) NOT NULL
);

CREATE TABLE host (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    zabbixid VARCHAR(10) NOT NULL
);

CREATE TABLE grupo (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    zabbixid VARCHAR(10) NOT NULL
);

CREATE TABLE usuario (
    id SERIAL PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    nome VARCHAR(50),
    senha VARCHAR(32) NOT NULL,
    admin BIT(1),
    enabled BIT(1) NOT NULL
);

CREATE TABLE schedule (
    id SERIAL PRIMARY KEY,
    original_value VARCHAR(50) NOT NULL,
    new_value VARCHAR(50) NOT NULL,
    date_from VARCHAR(50) NOT NULL,
    date_until VARCHAR(50),
    executed BOOLEAN,
    reverted BOOLEAN
);

CREATE TABLE macro_schedule (
    id SERIAL PRIMARY KEY,
    description VARCHAR(100),
    schedule_id INT REFERENCES schedule(id) NOT NULL,
    host_id INT REFERENCES host(id) NOT NULL,
    usuario_id INT REFERENCES usuario(id) NOT NULL,
    macro_id INT REFERENCES macro(id) NOT NULL,
    scheduled VARCHAR(50) NOT NULL,
    enabled BIT(1) NOT NULL
);

CREATE TABLE grupo_schedule (
    id SERIAL PRIMARY KEY,
    description VARCHAR(100),
    schedule_id INT REFERENCES schedule(id) NOT NULL,
    usuario_id INT REFERENCES usuario(id) NOT NULL,
    grupo_id INT REFERENCES grupo(id) NOT NULL,
    scheduled VARCHAR(50) NOT NULL,
    push_pop BIT(1) NOT NULL,
    enabled BIT(1) NOT NULL
);

CREATE TABLE log (
    id SERIAL PRIMARY KEY,
    logtime VARCHAR(50) NOT NULL,
    usuario_id INT REFERENCES usuario(id) NOT NULL
);

CREATE TABLE log_delete_grupo_schedule (
    id SERIAL PRIMARY KEY,
    grupo_schedule_id INT REFERENCES grupo_schedule(id) NOT NULL,
    log_id INT REFERENCES log(id) NOT NULL
);

CREATE TABLE log_delete_macro_schedule (
    id SERIAL PRIMARY KEY,
    macro_schedule_id INT REFERENCES macro_schedule(id) NOT NULL,
    log_id INT REFERENCES log(id) NOT NULL
);

CREATE TABLE log_edite_grupo_schedule (
    id SERIAL PRIMARY KEY,
    grupo_schedule_id INT REFERENCES grupo_schedule(id) NOT NULL,
    log_id INT REFERENCES log(id) NOT NULL,
    old_date_from VARCHAR(50) NOT NULL,
    new_date_from VARCHAR(50) NOT NULL,
    old_date_until VARCHAR(50) NOT NULL,
    new_date_until VARCHAR(50) NOT NULL,
    old_grupo_id INT REFERENCES grupo(id) NOT NULL,
    new_grupo_id INT REFERENCES grupo(id) NOT NULL,
    old_push_pop BIT(1) NOT NULL,
    new_push_pop BIT(1) NOT NULL
);

CREATE TABLE log_edite_macro_schedule (
    id SERIAL PRIMARY KEY,
    macro_schedule_id INT REFERENCES macro_schedule(id) NOT NULL,
    log_id INT REFERENCES log(id) NOT NULL,
    old_date_from VARCHAR(50) NOT NULL,
    new_date_from VARCHAR(50) NOT NULL,
    old_date_until VARCHAR(50) NOT NULL,
    new_date_until VARCHAR(50) NOT NULL,
    old_original_value VARCHAR(50) NOT NULL,
    new_original_value VARCHAR(50) NOT NULL,
    old_new_value VARCHAR(50) NOT NULL,
    new_new_value VARCHAR(50) NOT NULL
);

CREATE TABLE log_macro_execution (
    id SERIAL PRIMARY KEY,
    macro_schedule_id INT REFERENCES macro_schedule(id) NOT NULL,
    push_pop bit (1) NOT NULL,
    logtime VARCHAR(50) NOT NULL,
    details VARCHAR(100)
);

CREATE TABLE log_grupo_execution (
    id SERIAL PRIMARY KEY,
    grupo_schedule_id INT REFERENCES grupo_schedule(id) NOT NULL,
    push_pop bit (1) NOT NULL,
    logtime VARCHAR(50) NOT NULL,
    details VARCHAR(100)
);

CREATE TABLE host_schedule(
    id SERIAL PRIMARY KEY,
    description VARCHAR(100),
    scheduled VARCHAR(50) NOT NULL,
    schedule_id INT REFERENCES schedule(id) NOT NULL,
    host_id INT REFERENCES host(id) NOT NULL,
    push_pop bit(1) NOT NULL,
    enabled bit(1) NOT NULL
);

CREATE TABLE log_delete_host_schedule(
    id SERIAL PRIMARY KEY,
    host_schedule_id INT REFERENCES host_schedule(id) NOT NULL,
    log_id INT REFERENCES log(id) NOT NULL
);

CREATE TABLE log_host_execution(
    id SERIAL PRIMARY KEY,
    logtime VARCHAR(50) NOT NULL,
    host_schedule_id INT REFERENCES host_schedule(id) NOT NULL,
    details VARCHAR(50),
    push_pop bit(1) NOT NULL
);

CREATE TABLE log_edit_host_schedule(
    id SERIAL PRIMARY KEY,
    host_schedule_id INT REFERENCES host_schedule(id) NOT NULL,
    old_host_id INT REFERENCES host(id) NOT NULL,
    new_host_id INT REFERENCES host(id) NOT NULL,
    log_id INT REFERENCES log(id) NOT NULL,
    old_data_from VARCHAR(50) NOT NULL,
    new_date_from VARCHAR(50) NOT NULL,
    old_date_until VARCHAR(50) NOT NULL,
    new_date_until VARCHAR(50) NOT NULL,
    old_push_pop BIT(1) NOT NULL,
    new_push_pop BIT(1) NOT NULL
);

insert into usuario (login, nome, senha, admin, enabled) VALUES ('ewerton.marschalk@redeunifique.com.br','Ewerton Marschalk','241f47d048d825ffea7ea56aacf02653',b'1',b'1');