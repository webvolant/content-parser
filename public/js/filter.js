var myApp = angular.module('myApp', [] );
myApp
    .controller( 'MyCtrl', function( $scope, $http, $filter ){
        $scope.var = {};
        $scope.var.hello = "hi Anton!";


        /*
         $scope.itemsPerPage = 2;
         $scope.currentPage = 0;

         $http.get('/public/articles', {msg:'hello word!'}).
         success(function(ar, status, headers, config) {
         $scope.articles = ar;
         }).
         error(function(data, status, headers, config) {
         });

         $scope.range = function() {

         var rangeSize = 3;

         var ps = [];

         var start;

         start = $scope.currentPage;

         if ( start > $scope.pageCount()-rangeSize ) {

         start = $scope.pageCount()-rangeSize+1;

         }

         for (var i=start; i<start+rangeSize; i++) {

         ps.push(i);

         }

         return ps;

         };


         $scope.prevPage = function() {

         if ($scope.currentPage > 0) {

         $scope.currentPage--;

         }
         };


         $scope.DisablePrevPage = function() {

         return $scope.currentPage === 0 ? "disabled" : "";

         };


         $scope.pageCount = function() {
         var myFilteredData = $filter('filter')($scope.articles,$scope.query);
         return Math.ceil(myFilteredData.length/$scope.itemsPerPage)-1;

         };


         $scope.nextPage = function() {

         if ($scope.currentPage > $scope.pageCount()) {

         $scope.currentPage++;

         }
         };


         $scope.DisableNextPage = function() {

         return $scope.currentPage === $scope.pageCount() ? "disabled" : "";

         };


         $scope.setPage = function(n) {
         $scope.currentPage = n;
         };



         })


         .filter('pagination', function()
         {
         return function(input, start) {
         start = parseInt(start, 10);
         return input.slice(start);
         };
         });
         */

    })

