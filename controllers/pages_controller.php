<?php
  class PagesController {
    /*This action of this controller just displays two variables.
      This is the default action when charging the index.php.
    */
    public function home() {
      require_once('views/pages/home.php');
    }
    
	public function login() {
		require_once('views/pages/login.php');
	}
	  
	public function restricted() {
		require_once('views/pages/restricted.php');
	}
	  
    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>