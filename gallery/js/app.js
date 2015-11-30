var galleryApp = angular.module('galleryApp', [
  'ngRoute',
  'galleryControllers',
  'afkl.lazyImage',
  'wu.masonry'
]);

galleryApp.filter('escape', function() {
	  return window.encodeURIComponent;
	});

galleryApp.config(['$routeProvider', 
  function($routeProvider) {
    $routeProvider.
      when('/albums', {
        templateUrl: 'partials/album-list.html',
        controller: 'AlbumListCtrl'
      }).
      when('/albums/:albumName', {
        templateUrl: 'partials/album-detail.html',
        controller: 'AlbumDetailCtrl'
      }).
      otherwise({
        redirectTo: '/albums'
      });
  }]);	