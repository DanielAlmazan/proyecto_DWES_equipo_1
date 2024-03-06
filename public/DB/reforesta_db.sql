CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    surnames VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    nickname VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    karma INT DEFAULT 0,
    avatar VARCHAR(1000)
);

CREATE TABLE admins (
    id INT PRIMARY KEY,
    CONSTRAINT fk_admins_users FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    host INT NOT NULL,
    description VARCHAR(255),
    province VARCHAR(255) NOT NULL,
    locality VARCHAR(255) NOT NULL,
    terrainType VARCHAR(255),
    date DATETIME NOT NULL,
    bannerPicture VARCHAR(1000),
    type ENUM('urbana', 'rural de conservación', 'rural de protección', 'rural de agroforestal', 'rural productiva'),
    CONSTRAINT fk_events_users FOREIGN KEY (host) REFERENCES users(id)
);

CREATE TABLE species (
    id INT AUTO_INCREMENT PRIMARY KEY,
    scientificName VARCHAR(255) NOT NULL,
    commonName VARCHAR(255) NOT NULL,
    climate VARCHAR(255),
    region VARCHAR(255),
    daysToGrow INT,
    benefits VARCHAR(1000),
    picture VARCHAR(1000),
    url VARCHAR(255)
);

CREATE TABLE usersInEvent (
    userId INT,
    eventId INT,
    PRIMARY KEY (userId, eventId),
    CONSTRAINT fk_usersInEvent_users FOREIGN KEY (userId) REFERENCES users(id),
    CONSTRAINT fk_usersInEvent_events FOREIGN KEY (eventId) REFERENCES events(id)
);

CREATE TABLE speciesInEvent (
    specieId INT,
    eventId INT,
    PRIMARY KEY (specieId, eventId),
    CONSTRAINT fk_speciesInEvent_species FOREIGN KEY (specieId) REFERENCES species(id),
    CONSTRAINT fk_speciesInEvent_events FOREIGN KEY (eventId) REFERENCES events(id)
);

CREATE TABLE newsletterSubscribers (
    email VARCHAR(255) PRIMARY KEY
);

-- DATOS --

INSERT INTO users (name, surnames, email, nickName, password, avatar)
    VALUES ('Miguel', 'Collado', 'mig@gmail.es', 'mike', '1234', 'client2.jpg');
INSERT INTO users (name, surnames, email, nickName, password, avatar)
    VALUES ('Lucia', 'Rodriguez', 'luci@gmail.es', 'luciRod', 'luci', 'client1.jpg');
