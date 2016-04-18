<head>
	<script>
		// check if user is logged in
		if(localStorage.getItem("login") === "false"){
			//redirect to login screen
			window.location = "?controller=pages&action=restricted";
		}
	</script>
	
  	<script>
		// this angular script handles the edit/update function
		var app = angular.module('editArtistApp', []);
    
    	app.controller('editArtistCtrl', function ($scope, $http) {
      	"use strict";
  
      	$scope.newName = '';
		$scope.oldName = '';
		$scope.website = '';
	  	$scope.soundcloud = '';
	  	$scope.youtube = '';
		$scope.twitter = '';
	  	$scope.color = '#888888';
			
      	$scope.successMessage = '';

      	// call this method when submit is clicked
      	$scope.editArtist = function() {
        
			// ensure the new name is free
			var newNameURL = "./api/artists/name/" + $scope.newName;
			$http.get(newNameURL)
			.then( function (response){ 
				
				// there was an artist with this name already found,
				if($scope.newName != $scope.oldName && response.data.Artist instanceof Object){
				// an artist with the new name was found
				$scope.successMessage = "Edit failed. The name '" + $scope.newName + "' is already being used.";
				
				}
				else {
				// else the new name was free
					
				// need to check if the old artist exists
          		// GET the id of the artist with this name
          		var url = "./api/artists/name/" + $scope.oldName;
          
				// GET request
          		$http.get(url)
				
				.then(function (response) { // GET success, artist exists
			
					// the artist was found, get its id
					var id = response.data.Artist[0].artist_id;
				
					// rebuild the youtube link so it can be embedded
					var withoutParams = $scope.youtube.split("&");
					var parts = withoutParams[0].split("=");
					var youtubeCode = parts[parts.length - 1]; // Or parts.pop();
					//var youtubeLink = "https://www.youtube.com/embed/" + youtubeCode;
			
            		//PUT request to the api
            		var putUrl = "./api/artists/" + id;
           			$http({
            			url: putUrl,
            			method: "PUT",
						data:  { 'name' : $scope.newName,
				   				'website' : $scope.website,
				   				'soundcloud' : $scope.soundcloud,
				   				'youtube' : youtubeCode,
								'twitter' : $scope.twitter,
				   				'color' : $scope.color
				  }
          			})
          			.then(function(response) {	// PUT success
            			$scope.successMessage = "Successfully edited: " + $scope.oldName + " -> " + $scope.newName;
            			$scope.newName = '';
						$scope.oldName = '';
						$scope.website = '';
						$scope.soundcloud = '';
						$scope.youtube = '';
						$scope.twitter = '';
						$scope.color = '#888888';
          			}, 
					function(response) {  // PUT failed
					$scope.successMessage = "Edit failed." + response.data;
					});
		
				})
				.catch( function (data) { // GET failed
					$scope.successMessage = "Edit failed. There is no artist called '" + $scope.oldName + "'.";
				});
				}
			})
			.catch( function (data){
			$scope.successMessage = "Edit failed. Get Request Failed.";	
			});
      };
			
	// this function displaysthe current info for this artist in the fields
	$scope.getCurrent = function() {
		
		if($scope.oldName == '' ) {
			$scope.successMessage = "Enter the current name of the artist.";
		}
		
		else {
			
			// get request to find this artist
			var nameURL = "./api/artists/name/" + $scope.oldName;
			$http.get(nameURL)
			.then( function (response){ 
				
				// fill in current data
				$scope.newName = response.data.Artist[0].name;
				$scope.website = response.data.Artist[0].website;
				$scope.soundcloud = response.data.Artist[0].soundcloud;
				$scope.twitter = response.data.Artist[0].twitter;
				$scope.color = response.data.Artist[0].color;
				
				//  present a playable link from the video code
				$scope.youtube =  "http://youtube.com/watch?v=" + response.data.Artist[0].youtube;
			})
			.catch( function (data) {
				  $scope.successMessage = "Load failed. There is no artist called '" + $scope.oldName + "'.";
			});
		}
		
	} // end copyName
	
}); // end controller

</script>
  
  
</head>


<h2>Edit an Artist</h2>
  <div ng-app="editArtistApp" ng-controller="editArtistCtrl">
    
    <h3>{{successMessage}}</h3>
    
    <form ng-submit="editArtist()" >
		
        <p>
        <label>Current Artist Name:</label></br>
        <input ng-model="oldName" class="textBox" type="text" required/></br>
        </p>
	  			
		<p>
		<input id="currentInfoButton" class="quickButton" ng-click="getCurrent()" type="button" value="Load Current Info"/>
		</p>
		
 		<p>
    	<label>New Artist Name:</label></br>
    	<input ng-model="newName" name="newName" class="textBox" type="text" required/></br>
    	</p>
			
		<p>
		<label>New Youtube Video:</label></br>
        <input ng-model="youtube" class="textBox" type="url" required/></br>
        </p>

		<p>
        <label>New Website:</label></br>
        <input ng-model="website" class="textBox" type="url"/></br>
        </p>

		<p>
        <label>New Soundcloud Name:</label></br>
        <input ng-model="soundcloud" class="textBox" type="text"/></br>
        </p>

		<p>
        <label>New Twitter Name:</label></br>
        <input ng-model="twitter" class="textBox" type="text"/></br>
        </p>

		<p>
        <label>New Color:</label></br>
        <input ng-model="color" class="textBox" type="color" required/></br>
        </p>
		
        <input class="button" type="submit" value="Update Artist Info"/>
        <input class="button" type="reset" value="Reset"/>
    </form>
  </div>