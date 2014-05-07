WP Nav Walker
=============
Overview
--------
A PHP class that integrates into the [WP Nav Menu](http://codex.wordpress.org/Function_Reference/wp_nav_menu) function to strip out the defualt classes and replace them with a simple, descriptive set comprised of the following:

* Parent `li`s are given the `.has-children` class
* Child `ul`s are given the `.sub-menu` class
* The current page `li` is given the `.active` class

Installation & Usage
----------
You can just grab the nav-walker-class.php file and include it in your functions file.

```
require_once('custom-nav-walker-class.php');
```

And then include the class as a parameter when you use `wp_nav_menu()`. I've included an example function with the custom walker as an below:

```
<?php

$args = array(
    ...
    'walker' => new custom_nav_walker()
);

wp_nav_menu( $args );

?>
```