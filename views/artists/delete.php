<head>
	<script>
		// check if user is logged in
		if(localStorage.getItem("login") === "false"){
			//redirect to login screen
			window.location = "?controller=pages&action=restricted";
		}
	</script>
	
  	<script>
		var app = angular.module('deleteArtistApp', []);
    
    	app.controller('deleteArtistCtrl', function ($scope, $http) {
      	"use strict";
  
      	$scope.name = '';
      	$scope.successMessage = '';

      	// call this method when submit is clicked
      	$scope.deleteArtist = function() {
        
        // if there was something entered
        if($scope.name != ''){
          
          	// need to check if this name already exists
          	// GET the id of the artist with this name
          	var url = "./api/artists/name/" + $scope.name;
          
			// GET request
          	$http.get(url)
				
			.then(function (response) { // GET success
				
          		var id = response.data.Artist[0].artist_id;
				
            	//DELETE request to the api
            	var deleteUrl = "./api/artists/" + id;
				
           		$http({
            		url: deleteUrl,
            		method: "DELETE",
          		})
          		.then(function(response) {	// DELETE success
            		$scope.successMessage = "Successfully deleted " + $scope.name + ".";
            		$scope.name = '';
          		}, 
						  
          		function(response) {  // DELETE failed
					$scope.successMessage = "Deletion failed." + response.data;
				});
			})
			.catch( function (data) { // GET failed
				$scope.successMessage = "Deletion failed. There is no artist called '" + $scope.name + "'.";
			});
		}
      }
});

</script>
  
  
</head>


<h2>Delete an Artist</h2>
  <div ng-app="deleteArtistApp" ng-controller="deleteArtistCtrl">
    
    <h3>{{successMessage}}</h3>
    
    <form ng-submit="deleteArtist()" >
        <p>
        <label>Name:</label></br>
        <input ng-model="name" class="textBox" type="text" required/></br>
        </p>

        <input class="button" type="submit" value="Delete Artist"/>
        <input class="button" type="reset" value="Reset"/>
    </form>
  </div>



