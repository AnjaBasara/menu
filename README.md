# Currency Exchange Rate app

### Running the Dockerized application

To run this application, you should have [Docker](https://www.docker.com/) installed.

---

After cloning the repository, open the `menu` folder and run this command:

`docker-compose up`

After that, open the application in your browser by visiting http://localhost:8000/

---

To run the UpdateExchangeRate artisan command, execute the Docker container interactively by running the command:

`docker exec -it currency-app bash`

and then call the command:

`php artisan exchange:update`

---

Thank you for your time!
