DROP TABLE IF EXISTS article;
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

CREATE TABLE IF NOT EXISTS article (
    id int(11) NOT NULL,
    title varchar(64) NOT NULL,
    alias varchar(64) NOT NULL,
    content text NOT NULL,
    date datetime NOT NULL,
    status char(1) NOT NULL DEFAULT'W',
    author_id int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

ALTER TABLE article ADD PRIMARY KEY(id);
ALTER TABLE article ADD KEY idx_author_id(author_id);
ALTER TABLE article MODIFY id int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE article ADD CONSTRAINT fk_article_login_id  FOREIGN KEY(author_id) REFERENCES login (id);

INSERT INTO login (username, password, status) 
VALUES ('admin', '$2y$10$UyXEYppMuVnYN3Vd8l/enu3UoLr9zPTOXuQGWiZ/h4GQejoCJvlH.', 'A'); # password

CREATE VIEW article_username
AS
SELECT article.id,
       title,
       alias,
       content,
       date,
       article.status,
       username AS author,
       author_id
FROM article INNER JOIN login ON article.author_id = login.id;