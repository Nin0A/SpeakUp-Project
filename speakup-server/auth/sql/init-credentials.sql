CREATE TABLE IF NOT EXISTS credentials (
    user_id UUID PRIMARY KEY,
    email VARCHAR(100),
    password_hash VARCHAR(255),
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

CREATE TABLE IF NOT EXISTS roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    label TEXT
);
