--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: advertisement_test; Type: DATABASE; Schema: -; Owner: db_user
--

CREATE DATABASE advertisement_test WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'ru_RU.UTF-8' LC_CTYPE = 'ru_RU.UTF-8';


ALTER DATABASE advertisement_test OWNER TO db_user;

\connect advertisement_test

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: ad_id_seq; Type: SEQUENCE; Schema: public; Owner: db_user
--

CREATE SEQUENCE public.ad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ad_id_seq OWNER TO db_user;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: ad; Type: TABLE; Schema: public; Owner: db_user
--

CREATE TABLE public.ad (
    id integer DEFAULT nextval('public.ad_id_seq'::regclass),
    text character varying(255) NOT NULL,
    price integer NOT NULL,
    view_limit integer NOT NULL,
    banner character varying(255) NOT NULL,
    view_count integer DEFAULT 0
);


ALTER TABLE public.ad OWNER TO db_user;

--
-- Data for Name: ad; Type: TABLE DATA; Schema: public; Owner: db_user
--

COPY public.ad (id, text, price, view_limit, banner, view_count) FROM stdin;
\.


--
-- Name: ad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: db_user
--

SELECT pg_catalog.setval('public.ad_id_seq', 1, false);


--
-- PostgreSQL database dump complete
--

