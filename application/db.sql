DROP TABLE IF EXISTS login;

CREATE TABLE login (
    id int(11) NOT NULL, 
    username varchar(32) NOT NULL,
    password varchar(128) NOT NULL,
    status char(1) NOT NULL DEFAULT 'A'
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE login ADD PRIMARY KEY(id);
ALTER TABLE login ADD UNIQUE KEY uk_login(username);
ALTER TABLE login MODIFY id int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO login (username, password, status) 
VALUES ('admin', '$2y$10$UyXEYppMuVnYN3Vd8l/enu3UoLr9zPTOXuQGWiZ/h4GQejoCJvlH.', 'A'); # password