# Interview Task

In retrospect, I would've used Bootstrap instead of using PicoCSS or atleast try to extend Pico with helper classes and a better normalize (starting to hate PicoCSS default margins, you'll see it in the code).

## Routes

Routes are set in the web.php file with all the pages for this project. The frontend was build using simple blade templates to save on time.

## Rates

Shifts rates are set as integers in the database, with the last two digits being the decimal point. I've made this decision as in e-commerce systems, that's how prices are displayed. Going with this route, I've removed the currency from the price, but hadn't had the time to implement a new column in the database to account for the currency, thus enabling choosing from different currencies per shift.
Open for discussion on this one! :D
