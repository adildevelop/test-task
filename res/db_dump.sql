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
-- Name: advertisiment; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE advertisiment WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'ru_RU.UTF-8' LC_CTYPE = 'ru_RU.UTF-8';


ALTER DATABASE advertisiment OWNER TO postgres;

\connect advertisiment

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: ad; Type: TABLE; Schema: public; Owner: adil
--

CREATE TABLE public.ad (
    id integer NOT NULL,
    text character varying(255),
    price integer,
    view_limit integer,
    total_sum integer,
    banner character varying(255),
    view_count integer DEFAULT 0
);


ALTER TABLE public.ad OWNER TO adil;

--
-- Name: ad_id_seq; Type: SEQUENCE; Schema: public; Owner: adil
--

CREATE SEQUENCE public.ad_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ad_id_seq OWNER TO adil;

--
-- Name: ad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: adil
--

ALTER SEQUENCE public.ad_id_seq OWNED BY public.ad.id;


--
-- Name: ad id; Type: DEFAULT; Schema: public; Owner: adil
--

ALTER TABLE ONLY public.ad ALTER COLUMN id SET DEFAULT nextval('public.ad_id_seq'::regclass);


--
-- Data for Name: ad; Type: TABLE DATA; Schema: public; Owner: adil
--

COPY public.ad (id, text, price, view_limit, total_sum, banner, view_count) FROM stdin;
1	Yolo	100	500	\N	https://adawdasdawd.ru	0
2	Yolo	100	500	\N	https://adawdasdawd.ru	0
3	Yolo	100	500	\N	https://adawdasdawd.ru	0
4	Yolo	100	500	\N	https://adawdasdawd.ru	0
5	Yolo	100	500	\N	https://adawdasdawd.ru	0
6	Yolo	100	500	\N	https://adawdasdawd.ru	0
7	Yolo	100	500	\N	https://adawdasdawd.ru	0
8	Yolo	100	500	\N	https://adawdasdawd.ru	0
9	Yolo	100	500	\N	https://adawdasdawd.ru	0
10	Yolo	100	500	\N	https://adawdasdawd.ru	0
11	Yolo	100	500	\N	https://adawdasdawd.ru	0
\.


--
-- Name: ad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: adil
--

SELECT pg_catalog.setval('public.ad_id_seq', 11, true);


--
-- PostgreSQL database dump complete
--

