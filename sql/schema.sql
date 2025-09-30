
CREATE TABLE cards (
  id INT PRIMARY KEY AUTO_INCREMENT,
  card_number VARCHAR(20) NOT NULL UNIQUE,
  pin VARCHAR(4) NOT NULL,
  activated_at DATETIME NOT NULL,
  expires_at DATE NOT NULL,
  balance DECIMAL(12,2) NOT NULL,
  created_at DATETIME NULL,
  updated_at DATETIME NULL
);
