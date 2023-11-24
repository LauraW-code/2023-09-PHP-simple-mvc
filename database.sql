
CREATE TABLE hackatruite (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  liste VARCHAR(255)
);

CREATE TABLE user (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  username VARCHAR(255),
  password VARCHAR(255)
);

INSERT INTO user (username,password) VALUES ('hacka', 'thon');
