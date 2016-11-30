<?php

$config = array(
   'DB_HOST'     => 'localhost',
   'DB_10'       => 'noelj-websyslab10',
   'DB_9'        => 'noelj-websyslab9',
   'DB_USERNAME' => 'root',
   'DB_PASSWORD' => 'root',
);

$tables = '
CREATE TABLE IF NOT EXISTS courses (
  crn INTEGER PRIMARY KEY,
  prefix CHARACTER VARYING(4) NOT NULL,
  "number" INTEGER NOT NULL,
  title CHARACTER VARYING(255) NOT NULL,
  section INTEGER NOT NULL,
  year INTEGER NOT NULL
);
CREATE TABLE IF NOT EXISTS students (
  rin INTEGER PRIMARY KEY,
  rcisID CHARACTER VARYING(7) NOT NULL,
  "first name" CHARACTER VARYING(100) NOT NULL,
  "last name" CHARACTER VARYING(100) NOT NULL,
  alias CHARACTER VARYING(100) NOT NULL,
  phone INTEGER NOT NULL,
  street CHARACTER VARYING(100) NOT NULL,
  city CHARACTER VARYING(100) NOT NULL,
  st CHARACTER VARYING(100) NOT NULL,
  zip INTEGER NOT NULL
);
CREATE TABLE IF NOT EXISTS grades (
  id SERIAL PRIMARY KEY,
  crn INTEGER REFERENCES courses,
  rin INTEGER REFERENCES students,
  grade INTEGER NOT NULL
);'
?>