# PHPizza

PHPizza is a simple web application for ordering pizzas. This project is built using PHP, MySQL, and Docker.

## Prerequisites

Before you start, ensure you have the following software installed on your machine:

- Git
- Docker
- Docker Compose

## Getting Started

1. Clone the repository to your local machine:

git clone https://github.com/Eelli002/PHPizza.git

2. Change to the project directory:

cd phpizza

3. Build and run the Docker containers:

docker compose build

docker compose up

4. Visit the application in your browser:

Open your browser and navigate to [http://localhost/phpizza](http://localhost/phpizza)

5. Manage your MySQL database with PHPMyAdmin:

Open your browser and navigate to [http://localhost:8080](http://localhost:8080)

Login using:

User: Root
Password: 12345

## Stopping the Containers
To stop the running Docker containers, run the following command in the project directory:
docker-compose down