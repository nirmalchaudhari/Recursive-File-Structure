CREATE TABLE IF NOT EXISTS flstruct (
  id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(50) NOT NULL,
  type enum('Drive','Directory','File') NOT NULL,
  parentId int(5) NOT NULL DEFAULT 0,
  path varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;