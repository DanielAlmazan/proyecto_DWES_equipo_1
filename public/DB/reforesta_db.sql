CREATE DATABASE IF NOT EXISTS reforestaDB;
USE reforestaDB;

drop table if exists admins cascade;
drop table if exists usersInEvent cascade;
drop table if exists speciesInEvent cascade;
drop table if exists events cascade;
drop table if exists users cascade;
drop table if exists species cascade;
drop table if exists newsletterSubscribers cascade;

CREATE TABLE users
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(255),
    surnames VARCHAR(255),
    email    VARCHAR(255) NOT NULL UNIQUE,
    nickname VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    karma    INT DEFAULT 0,
    avatar   VARCHAR(1000)
);

CREATE TABLE admins
(
    id INT PRIMARY KEY,
    CONSTRAINT fk_admins_users FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE events
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(255),
    host          INT          NOT NULL,
    description   VARCHAR(255),
    province      VARCHAR(255) NOT NULL,
    locality      VARCHAR(255) NOT NULL,
    terrainType   VARCHAR(255),
    date          DATETIME     NOT NULL,
    bannerPicture VARCHAR(1000),
    type          ENUM ('urbana', 'rural de conservación', 'rural de protección', 'rural de agroforestal', 'rural productiva'),
    CONSTRAINT fk_events_users FOREIGN KEY (host) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE species
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    scientificName VARCHAR(255) NOT NULL,
    commonName     VARCHAR(255) NOT NULL,
    climate        VARCHAR(255),
    region         VARCHAR(255),
    daysToGrow     INT,
    benefits       VARCHAR(1000),
    picture        VARCHAR(1000),
    url            VARCHAR(255)
);

CREATE TABLE usersInEvent
(
    userId  INT,
    eventId INT,
    PRIMARY KEY (userId, eventId),
    CONSTRAINT fk_usersInEvent_users FOREIGN KEY (userId) REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT fk_usersInEvent_events FOREIGN KEY (eventId) REFERENCES events (id) ON DELETE CASCADE
);

CREATE TABLE speciesInEvent
(
    specieId INT,
    eventId  INT,
    PRIMARY KEY (specieId, eventId),
    CONSTRAINT fk_speciesInEvent_species FOREIGN KEY (specieId) REFERENCES species (id) ON DELETE CASCADE,
    CONSTRAINT fk_speciesInEvent_events FOREIGN KEY (eventId) REFERENCES events (id) ON DELETE CASCADE
);

CREATE TABLE newsletterSubscribers
(
    email VARCHAR(255) PRIMARY KEY
);

-- DEFAULT DATA --

-- USERS --
INSERT INTO users (name, surnames, email, nickname, password, avatar)
VALUES ('Miguel', 'Collado', 'mig@gmail.com', 'mike', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'client2.jpg'),
       ('Lucia', 'Rodriguez', 'luci@gmail.com', 'luciRod', '2fdcbc8615c275ffbe49106cf85fbab1566b92559a251a5535a217f211dfa3f2', 'client1.jpg'),
       ('Anacletus', 'McJohnson', '1', 'Er AnAkLeTus', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'analisto.png');
-- DEFAULT PASSWORDS:
-- Miguel: 1234
-- Lucia: luci
-- Anacletus: 1

-- ADMIN --
INSERT INTO admins (id)
VALUES (3);

-- EVENTS --
INSERT INTO events (host, name, description, province, locality, terrainType, date, bannerPicture, type)
VALUES (1, '¡Reforesta!', '¡Vamos a plantar arbolicos!', 'Alicante', 'Alicante', 'rural de protección',
        '2022-11-22 12:00:00', 'event1.jpg', 'urbana'),
       (2, 'Menos natación y más reforestación',
        '¿Cansade de ver a gente nadar en la playa? ¡Únete en nuestro evento por la reforestación del mar para que esos autodenominados "healthy" se vayan a nadar a otra parte!',
        'Madrid', 'Madrid', 'urbana', '2023-08-27 00:00:00', 'event1.jpg', 'urbana');

-- SPECIES --
INSERT INTO species (scientificName, commonName, climate, region, daysToGrow, benefits, picture, url)
VALUES ('Cattus', 'Gatoctus', 'Mediterráneo', 'Alicante', 365, 'Madera, corcho, bellotas', 'cattus.jpg',
        'https://es.wikipedia.org/wiki/Quercus_suber'),
       ('Quercus ilex', 'Encina', 'Mediterráneo', 'Alicante', 365, 'Madera, bellotas', 'encina.jpg',
        'https://es.wikipedia.org/wiki/Quercus_ilex');

-- USERS IN EVENT --
INSERT INTO usersInEvent (userId, eventId)
VALUES (1, 1),
       (2, 1),
       (1, 2);

-- SPECIES IN EVENT --
INSERT INTO speciesInEvent (specieId, eventId)
VALUES (1, 1),
       (2, 1),
       (1, 2);

-- NEWSLETTER SUBSCRIBERS --
INSERT INTO newsletterSubscribers (email)
VALUES ('anaclet@mc.johnson');