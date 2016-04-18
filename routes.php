<?php

// Function that calls the controller
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
			
	  case 'artists':
        $controller = new ArtistsController();
      break;
	}

    $controller->{ $action }();
  }


// This portion of the code executes first
// Adding entries for the new controllers and its actions
  $controllers = array('pages' => ['home','login', 'restricted', 'error'], //controller: pages.  functions: home, login, restricted, error
					   
					   'artists' => ['see', 'add', 'update', 'delete']); // controller: artists. functions see, add, update, delete
					   
                  

  
  if (array_key_exists($controller, $controllers)) {// The variable $controller was declared in the file index.php
    if (in_array($action, $controllers[$controller])) {// The variable $action was declared in the file index.php
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }

?>