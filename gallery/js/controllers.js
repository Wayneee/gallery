var galleryControllers = angular.module('galleryControllers', []);

galleryControllers.controller('AlbumListCtrl', [ '$scope', '$http',
		function($scope, $http) {
			$http.get('service/album-list.php').success(function(data) {
				$scope.albums = data;
			});
		} ]);

galleryControllers.controller('AlbumDetailCtrl', [ '$scope', '$routeParams',
		'$http', function($scope, $routeParams, $http) {
			$scope.albumName = $routeParams.albumName;
			$http.post('service/album-detail.php', {
				albumName : $scope.albumName
			}).success(function(data) {
				$scope.photos = data;
				
				var galleryLib = new GalleryLib();
				
				$scope.getFileType = galleryLib.getFileType;			
				$scope.loadFullImage = galleryLib.loadFullImage;				
			});

		} ]);