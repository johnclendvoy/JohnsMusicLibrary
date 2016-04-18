<DOCTYPE html>
  
<html>
	<head>
		<script>
			var app = angular.module('listArtistsApp', []);

				app.controller('listArtistsCtrl', function ($scope, $http, $sce) {
				"use strict";

				// get list of all artists from api
				$http.get("./api/artists").then(function (response) {
					$scope.allArtists = response.data.Artists;

					for(var i = 0; i < $scope.allArtists.length; i++){
						$scope.embedLink = "https://www.youtube.com/embed/" + $scope.allArtists[i].youtube;
						$scope.trustedLink = $sce.trustAsResourceUrl($scope.embedLink); 
						$scope.allArtists[i].youtube = $scope.trustedLink;

						// build a soundcloud link
						$scope.scLink = "https://www.soundcloud.com/" + $scope.allArtists[i].soundcloud;
						$scope.allArtists[i].soundcloud = $scope.scLink;

						// build a twitter link
						$scope.twLink = "https://www.twitter.com/" + $scope.allArtists[i].twitter;
						$scope.allArtists[i].twitter = $scope.twLink;	
					}
					});   
				});
		</script>
</head>
	
<body>
 
	<div ng-app="listArtistsApp" ng-controller="listArtistsCtrl">
		<h2>Quick Links:</h2>

		<p class="doubleSpace">
		<span ng-repeat="x in allArtists">

			<a class="quickButton" 
					style="background:{{x.color}}; border-color:{{x.color}};" 
					href="#{{x.name}}">{{x.name}}</a>
		</span> 
		</p>

		</br>
	</br>
	</br>
		<h2>All Artists:</h2>

		<div class="artistCard" ng-repeat="x in allArtists" style="background:{{x.color}}">

			<div class="socialLinks">
				<h2 class="artistTitle" id="{{x.name}}" style="color:{{x.color}};">{{x.name}}</h2>
				
				<span>
					<a class="quickButton" style="background:{{x.color}}; border-color:{{x.color}};" target="_blank" href="{{x.website}}">Website</a>
					<a class="quickButton" style="background:{{x.color}}; border-color:{{x.color}};" target="_blank" href="{{x.soundcloud}}">Soundcloud</a>

					<a class="quickButton" style="background:{{x.color}}; border-color:{{x.color}};" target="_blank" href="{{x.twitter}}">Twitter</a>
				</span>


				<span>
					<a id="topButton" class="quickButton" style="background:{{x.color}}; border-color:{{x.color}};" href="#">Back to Top</a>
				</span>
			</div>
			
			<div class="videoContainer">
				<div class="videoBox">
					<iframe ng-src="{{x.youtube}}" frameborder="0" allowfullscreen="" align="center"></iframe>
				</div>
			</div>

			
		</div>
	</div>
</body>
</html>

