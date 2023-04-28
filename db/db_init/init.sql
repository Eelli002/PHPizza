CREATE TABLE `PHPizza`.`pizzaOrders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `toppings` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `pizzaOrders` (`id`, `title`, `toppings`, `email`, `created_at`) 
    VALUES (NULL, 'My First Pizza', 'Cheese, Pepperoni', 'eelli002@ucr.edu', current_timestamp());

CREATE TABLE `PHPizza`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(255) NOT NULL,
  `lastName` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE USER 'Elijah'@'%' IDENTIFIED BY 'PHPizza123!';

GRANT ALL PRIVILEGES ON PHPizza.* TO 'Elijah'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;