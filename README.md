# AJW Recipe Search
Powered by Yummly API

## Project Status
So far, I've been duplicating features of other sites. This progress is nearing a "complete" status. Mostly because I won't be working on things much after this quarter.

## Installation
1. Copy /ajw into your web root directory
2. Import the most current SQL file (it will drop your CI database if it exists)
3. Point browser to http://localhost:8888/ajw or something similar
4. Login info: admin@admin.com/////password

## Todo List
* Autocomplete
    * limit displayed matches
    * Yummly matches beginning of words, NOT just any matching string
* Tags
    * A string listing the tags is provided, but the links do nothing
* Filters
    * Work for the most part.. They use a form and POST, so when using the include/exclude ingredient links the filters don't get re-submitted.