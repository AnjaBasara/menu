# Currency Exchange Rate app

### Configuration

After cloning the repository, copy the `.env.example` file to `.env` and populate these fields:

* CURRENCY_LAYER_API_KEY - with the API key of your CurrencyLayer account
* MAIL_USERNAME - your Gmail email address
* MAIL_PASSWORD - your Google account app password

To configure the GBP order confirmation email recipient(s), go to `mail.php` (located inside the config directory)
and add the email addresses inside the `to` array.

### Running the Dockerized application

To run this application, you should have [Docker](https://www.docker.com/) installed.

---

After configuring the app, run this command inside the root of the repository:

`docker-compose up`

After that, open the application in your browser by visiting http://localhost:8000/

---

To run the UpdateExchangeRate artisan command, execute the Docker container interactively by running the command:

`docker exec -it currency-app bash`

and then call the command:

`php artisan exchange:update`

---

Thank you for your time!
