CREATE TABLE users(
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    api_token VARCHAR(255) UNIQUE , 
    profile_pic VARCHAR(255) ,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY(id)
);

 CREATE TABLE questions(
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    user_id INTEGER UNSIGNED NOT NULL ,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id)
);

 CREATE TABLE answers(
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    body TEXT NOT NULL,
    vote INTEGER UNSIGNED NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    user_id INTEGER UNSIGNED NOT NULL ,
    question_id INTEGER UNSIGNED NOT NULL ,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id) ,
    FOREIGN KEY(question_id) REFERENCES questions(id)
);