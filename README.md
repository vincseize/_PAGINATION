<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="94" height="20"><linearGradient id="b" x2="0" y2="100%"><stop offset="0" stop-color="#bbb" stop-opacity=".1"/><stop offset="1" stop-opacity=".1"/></linearGradient><clipPath id="a"><rect width="94" height="20" rx="3" fill="#fff"/></clipPath><g clip-path="url(#a)"><path fill="#555" d="M0 0h49v20H0z"/><path fill="#007ec6" d="M49 0h45v20H49z"/><path fill="url(#b)" d="M0 0h94v20H0z"/></g><g fill="#fff" text-anchor="middle" font-family="DejaVu Sans,Verdana,Geneva,sans-serif" font-size="110"> <text x="255" y="150" fill="#010101" fill-opacity=".3" transform="scale(.1)" textLength="390">release</text><text x="255" y="140" transform="scale(.1)" textLength="390">release</text><text x="705" y="150" fill="#010101" fill-opacity=".3" transform="scale(.1)" textLength="350">v1.0.1</text><text x="705" y="140" transform="scale(.1)" textLength="350">v1.0.1</text></g> </svg>

[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)

[![Version](https://badge.fury.io/gh/tterb%2FHyde.svg)](https://badge.fury.io/gh/tterb%2FHyde)
[![GitHub Release](https://img.shields.io/github/release/tterb/PlayMusic.svg?style=flat)](1.0.1)  

[![Github All Releases](https://img.shields.io/github/downloads/atom/atom/total.svg?style=flat)]()

# Auto pagination php, twig 
## sample with sql data; can work, i suppose, with other fetching data

```php
<?php              
    require 'pagination.php';
?>
```

http://  127.0.0.1/table_pagination.php?yourparam=johnDOE&page=19&n_result=5

![alt text](https://github.com/vincseize/PHP-JQUERY/blob/master/pagination/readme.jpg)

- php : pgn.class.php
- php : pagination.php (will be included)
- js : pgn.js
- //
- php : index.php sample page
- php : pgn_pdo.class.php for demo (use your own naturally)
- css : external bootsrap (use your own naturally)

## Result
- '< ul >< li >< /li >...< /ul >'
- |icon_before|1|2|3|current page|icon_next|
- |icon_before|1|2|3|4|current page|5|6|7|8|...|last|icon_next|
- |icon_before|first|...|20|21|22|23|current page|25|26|27|28|...|last|icon_next|
- etc, etc

## Vars php [6] in pagination.php
* `$pgn_dfltLimit`: n default results
* `$pgn_rCount`: total all results in your table
* `$pgn_paramPage`: name for the url parameters, return current page after process
* `$pgn_paramRes`: name for the url parameters, return result for process
* `$pgn_nBtns`: for ui, number of buttons, tot max visible btn = n*2 +1 (without first and last)
* `$pgn_ics`: first, last and ... buttons look

## Vars php [3] in index.php
```php
  $pgn_limit       = 15;          // !Important same as $pgn_dfltLimit value as in pagination.php
  $pgn_paramPage   = 'page';      // !Important same value as in pagination.php
  $pgn_paramRes    = 'n_result';  // !Important same value as in pagination.php
```
## Vars js [1] in pgn.js
* `var classname`: line1 IMPORTANT n_result should be same as $pgn_paramRes

## Usage PHP
* `configure pdo`: -> in pdo.class
* `select your table, etc`: -> in index.php line 6, this my own vars for this sample;
* `test`: -> open index.php
* `re configure vars pagination`: -> in pagination.php
* `test again`: -> open index.php


## Twig PHP
```php
$Pagination = new $this -> Pagination(
    $pgn_page,
    $pgn_dfltLimit,
    $pgn_rCount,
    $pgn_nBtns,
    $pgn_ics,
    $pgn_paramPage,
    $pgn_paramRes,
    "TRUE"
);

$pagination = $Pagination->pagination_ui();
```

```html
<div class="input-group"> 
    <select id='nResult_select' data-pgn="{{pgn_paramRes}}" class="{{pgn_paramRes}}"">
        {% for value in n_results_array %}
            <option>{{ value }}</option>
        {% endfor %}
    </select>
    {{pagination|raw}}
</div>
<script src="pgn.js"></script>
```

## Features
* `get parameters`: don't destruct your own url parameters
* `pagination ui`: several possible on the same page (top, bottom)
* `twig`: easy integration
