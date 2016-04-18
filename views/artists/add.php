<head>
	<script>
		// check if user is logged in
		if(localStorage.getItem("login") === "false"){
			//redirect to login screen
			window.location = "?controller=pages&action=restricted";
		}
	</script>

  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  
  <script>
     var app = angular.module('addArtistApp', []);
    
    app.controller('addArtistCtrl', function ($scope, $http) {
      "use strict";
  
		
      $scope.newName = '';
	  $scope.website = '';
	  $scope.soundcloud = '';
	  $scope.youtube = '';
	  $scope.twitter = '';
	  $scope.color = '#888888';
		
      $scope.successMessage = '';
      
      // call this method when submit is clicked
      $scope.addArtist = function() {
        
        // if there was something entered
        if($scope.newName != ''){
          
		var withoutParams = $scope.youtube.split("&");
		var parts = withoutParams[0].split("=");
		var youtubeCode = parts[parts.length - 1]; // Or parts.pop();
			
		var youtubeLink = "https://www.youtube.com/embed/" + youtubeCode;
			
			
			
          //need to check if this name already exists
          // ensure the new name is free
			var newNameURL = "./api/artists/name/" + $scope.newName;
			$http.get(newNameURL)
			.then( function (response){ 
				
				// there was an artist with this name already found,
				if( response.data.Artist instanceof Object){
				// an artist with the new name was found
				$scope.successMessage = "Add failed. The name '" + $scope.newName + "' is already being used.";
				
				}
				else {
          			//POST request to the api
           			$http({
						url: './api/artists',
            			method: "POST",
            			data: { 'name' : $scope.newName,
				   			'website' : $scope.website,
				   			'soundcloud' : $scope.soundcloud,
				   			'youtube' : youtubeCode,
				   			'twitter' : $scope.twitter,
				   			'color' : $scope.color
				  		} // the payload we send to the api
          			})
          			.then(function(response) {
            			// success
            			$scope.successMessage = "Successfully added " + $scope.newName;
            			$scope.newName = '';
						$scope.website = '';
						$scope.soundcloud = '';
						$scope.youtube = '';
						$scope.twitter = '';
						$scope.color = '#888888';
          			}, 
          			function(response) { // optional
            			// failed
          			});
        		}
			});
        
      }
	  }
      
});

</script>
  
  
</head>


<h2>Add a New Artist</h2>
  <div ng-app="addArtistApp" ng-controller="addArtistCtrl">
    
    <h3>{{successMessage}}</h3>
    
    <form ng-submit="addArtist()" >
        <p>
        <label>Name:</label></br>
        <input ng-model="newName" class="textBox" type="text" required/></br>
        </p>

		<p>
        <label>Youtube Video:</label></br>
        <input ng-model="youtube" class="textBox" type="url" required/></br>
        </p>

		<p>
        <label>Website:</label></br>
        <input ng-model="website" class="textBox" type="url"/></br>
        </p>

		<p>
        <label>Soundcloud Name:</label></br>
        <input ng-model="soundcloud" class="textBox" type="text"/></br>
        </p>

		<p>
        <label>Twitter Name:</label></br>
        <input ng-model="twitter" class="textBox" type="text"/></br>
        </p>

		<p>
        <label>Color:</label></br>
        <input ng-model="color" class="textBox" type="color" required/></br>
        </p>

        <input class="button" type="submit" value="Add Artist"/>
        <input class="button" type="reset" value="Reset"/>
    </form>
  </div>



