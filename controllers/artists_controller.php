 <?php
  class ArtistsController {

	  	public function see() { 
		  	require_once('views/artists/list.php'); 
	   	}
	  
	  	public function add() { 
      		require_once('views/artists/add.php');
    	}
    
    	public function update() { 
      		require_once('views/artists/update.php');
    	}
    
    	public function delete() { 
      		require_once('views/artists/delete.php');
    	}
      
    	public function error() {
      		require_once('views/pages/error.php');
    	}
  }
?>