# AJW Recipe Search
Powered by [Yummly API](https://developer.yummly.com)

## Project Status
2015: Put back on GitHub (and made public) for historic reasons. Project guaranteed not to work in its current state. Because this repository was public at the time, I did not think about protecting API keys. I have now deleted the keys on Yummly's side, so it *shouldn't* be a compromise.

2013: So far, I've been duplicating features of other sites. This progress is nearing a "complete" status. Mostly because I won't be working on things much after this quarter.

## Description
Using the Yummly API, search for recipes based on user settings (diets, allergies, dislikes, cuisine, etc).

## Installation
This project has only been tested on systems running OS X (10.6 and 10.8) and a [MAMP](http://mamp.info/) setup (Apache 2.2.22, PHP 5.4.4, and MySQL 5.5.25). [CodeIgniter](http://ellislab.com/codeigniter/user-guide/) (a php framework) is used, see documentation.

1. Copy /ajw into your web root directory.
2. Import the most current SQL file (it will drop your CI database, if it exists).
3. Rename /ajw/application/config/config_DEV.php to ..../config.php and fill in the base_url (example: http://localhost:8888/ajw/) and the encryption_key (36 randomized characters, I think..).
4. Rename /ajw/application/config/database_DEV.php to ..../database.php and fill in your database info.
5. Point browser to http://localhost:8888/ajw or something similar.
6. Login info
    * username: admin@admin.com
    * password: password

## Todo List
* Pick better name
* Autocomplete
    * Limit displayed matches, maybe scrollable list)
    * Yummly matches beginning of words, NOT just any matching string.
* Tags
    * A string listing the tags is provided, but the links do nothing.
    * Create functions to list recipes within the selected tag.
* Filters
    * Work for the most part.. They use a form and POST, so when using the include/exclude ingredient links the filters don't get re-submitted.
* AJAX
    * Lots of functions would benefit from AJAX.
    * Also improves user experience.
    * Need to learn javascript / jquery.
* BUG: Filters
    * When too many filters are selected, weird things happen.
    * Probably, just need to deal with the no results returned scenario.
* Layout
    * Endlessly adjust HTML and CSS....
* Tooltips
    * Various parts could benefit from a description.
    * Need to learn javascript / jquery.
* cURL Caching
    * HTTP headers
* Results
    * sort options
* Meta Tables
    * Create a maintenance script to re-build/update meta tables.
* [IonAuth](http://benedmunds.com/ion_auth/)
    * Actually learn it...
    * Utilize all the account features (create user, forgot password, etc).
    * Authenticate correctly (right now all users have to be admin to use the project).
    * Apply theme to IonAuth pages.
* Validation
    * Move rules to config file.
    * Re-evaluate / add rules.

## Way down the road...
* "Common" Ingredients
    * Ability to save a list of ingredients that will usually be on hand, and factor that into the search results.
    * Show recipes that can be made given any combination of these ingredients, within a specified threshold.
* Ingredient Equivalencies
    * Maintain a table of equivalent or similar ingredients.
    * Automatically exchange equivalent ingredients in ingredient lists based on user preferences (diet, dislikes, etc).
* Search History
    * Keep track of the users...data could be useful later to better serve customized results.
* Release Project...
    * Put the project online for all to see.
    * Or just online for collaboration -> need to figure out .htaccess

## Other things
* Exclusion Analysis
    * Keep track of and analyze all users exclusions over time.
    * Trends
    * Generate categories (exclusions during a session).
* Recipe Type Markup
    * Find percentage of sources using recipe specific markup tags.
    * microdata, microformats, RDFa
* Recipe Directions
    * Would be nice to include on my side, instead of forcing the user to leave and go to the source.
    * Parse pages to display directions and other data (comments, etc).
    * Create local database & tables to store my own (or user submitted) recipes.
        * And make them searchable!

## Unused Yummly Features
* The following are either not used or stripped from the returned json object..
    * Facets
    * AllowedIngredient[]
    * maxTotalTime
    * flavors
    * Nutrition estimates
