CREATE TABLE IF NOT EXISTS themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme_name VARCHAR(255),
    css_file VARCHAR(255)
);

-- users tablosunu oluştur
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    theme_id INT,
    FOREIGN KEY (theme_id) REFERENCES themes(id) ON DELETE SET NULL
);

-- kartvizit tablosunu oluştur
CREATE TABLE IF NOT EXISTS kartvizit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    title VARCHAR(255),
    phone VARCHAR(20),
    email VARCHAR(255),
	hakkimda VARCHAR(255),
	web VARCHAR(255),
	sos_1 VARCHAR(255),
	sos_2 VARCHAR(255),
	sos_3 VARCHAR(255),
	sos_4 VARCHAR(255),
	iban VARCHAR(255),
    theme_id INT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (theme_id) REFERENCES themes(id) ON DELETE SET NULL
);

-- Tema verilerini ekle
INSERT INTO themes (theme_name, css_file) VALUES
('Theme 1', 'theme1.css'),
('Theme 2', 'theme2.css'),
('Theme 3', 'theme3.css'),
('Theme 4', 'theme4.css'),
('Theme 5', 'theme5.css');
