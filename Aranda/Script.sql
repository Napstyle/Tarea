
-- Database: ap01

-- DROP DATABASE ap01;

CREATE DATABASE ap01
  WITH OWNER = ap01
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'en_US.UTF-8'
       LC_CTYPE = 'en_US.UTF-8'
       CONNECTION LIMIT = -1;

ALTER DATABASE ap01
  SET DateStyle = 'postgres,euro';



-- Table: public.cliente

-- DROP TABLE public.cliente;

CREATE TABLE public.cliente
(
  id integer NOT NULL DEFAULT nextval('cliente_id_seq'::regclass),
  rfc character varying(13),
  razonsocial character varying(255),
  CONSTRAINT cliente_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.cliente
  OWNER TO ap01;


-- Table: public.detallepedido

-- DROP TABLE public.detallepedido;

CREATE TABLE public.detallepedido
(
  id integer NOT NULL DEFAULT nextval('detallepedido_id_seq'::regclass),
  cantidad integer,
  precio numeric(12,2),
  pedidoid integer,
  productoid integer,
  CONSTRAINT detallepedido_pkey PRIMARY KEY (id),
  CONSTRAINT detallepedido_pedidoid_fkey FOREIGN KEY (pedidoid)
      REFERENCES public.pedido (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT detallepedido_productoid_fkey FOREIGN KEY (productoid)
      REFERENCES public.producto (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.detallepedido
  OWNER TO ap01;

-- Table: public.pedido

-- DROP TABLE public.pedido;

CREATE TABLE public.pedido
(
  id integer NOT NULL DEFAULT nextval('pedido_id_seq'::regclass),
  fecha date,
  clienteid integer,
  CONSTRAINT pedido_pkey PRIMARY KEY (id),
  CONSTRAINT pedido_clienteid_fkey FOREIGN KEY (clienteid)
      REFERENCES public.cliente (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT id UNIQUE (id),
  CONSTRAINT pedido_id_key UNIQUE (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.pedido
  OWNER TO ap01;


-- Table: public.producto

-- DROP TABLE public.producto;

CREATE TABLE public.producto
(
  nombrep character varying(255),
  precio_sugerido numeric(12,2),
  id integer NOT NULL DEFAULT nextval('producto_id_seq'::regclass),
  CONSTRAINT producto_pkey PRIMARY KEY (id),
  CONSTRAINT producto_id_key UNIQUE (id),
  CONSTRAINT producto_id_key1 UNIQUE (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.producto
  OWNER TO ap01;

- Table: public."user"

-- DROP TABLE public."user";

CREATE TABLE public."user"
(
  id integer NOT NULL DEFAULT nextval('user_id_seq'::regclass),
  username character varying(25) NOT NULL,
  first_name character varying(50),
  last_name character varying(50),
  phone_number character varying(50),
  email character varying(50),
  password character varying(50),
  role integer,
  CONSTRAINT user_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public."user"
  OWNER TO ap01;

-- Index: public.user_unique_username

-- DROP INDEX public.user_unique_username;

CREATE UNIQUE INDEX user_unique_username
  ON public."user"
  USING btree
  (username COLLATE pg_catalog."default");


