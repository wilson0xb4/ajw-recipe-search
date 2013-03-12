# AJW Recipe Search
Powered by Yummly API

## Project Status
So far, I've been duplicating features of other sites. This progress is nearing a "complete" status. Mostly because I won't be working on things much after this quarter.

## Installation
1. Copy /ajw into your web root directory.
2. Import the most current SQL file (it will drop your CI database, if it exists).
3. Point browser to http://localhost:8888/ajw or something similar.
4. Login info
    * username: admin@admin.com
    * password: password

## Todo List
* Autocomplete
    * limit displayed matches
    * Yummly matches beginning of words, NOT just any matching string
* Tags
    * A string listing the tags is provided, but the links do nothing
* Filters
    * Work for the most part.. They use a form and POST, so when using the include/exclude ingredient links the filters don't get re-submitted.
* "Common" Ingredients
    * Ability to save a list of ingredients that will usually be on hand, and factor that into the search results.
    * Show recipes that can be made given any combination of these ingredients, within a specified threshold.
* Ingredient Equivalencies
    * Maintain a table of equivalent or similar ingredients.
    * Automatically exchange equivalent ingredients in ingredient lists based on user preferences (diet, dislikes, etc).