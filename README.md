## Stack

LEMP stack using Twig 1.34 and bootstrap. The application is split into three
parts. The root file "index.php" is the default view which also handles
the search results. This calls either "search-results.phtml",
"product-info.phtml" or "home.phtml" depending on the number of results from a
search (if any). Next is basket.php which handles the basket and all the payment
pages. The last is account.php which handles the users account information
including past orders. Payment details are not stored by the site as everthing
is managed with the paypal API.

## Database

The database at the moment is mysql as it comes with the web hosting and the
traffic is unlikely to be demanding. There are seperate interfaces for the three
main tables as each is handled differently although they may be
combined/abstracted at a later date.


## style comments
Filenames and frontend varibles use cammelCase and CapsCase for classes.

PHP uses underscore seperated varibles and funcation names and CapsCase for
classes.
