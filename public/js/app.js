var app = angular.module('myApp', ['ui.bootstrap','ngAnimate'] );

app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

app.controller('frontCtrl', function ($scope, $http, $timeout) {
    $http.get('/public/articles').success(function(data){
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 1; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter
        $scope.totalItems = $scope.list.length;
    });

    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };

    //При вызове фильра за 10 милисекунд обновляем количество элементов.
    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };



    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
});





app.controller('sliderCtrl', function ($scope, $http, $timeout,$interval) {

    $scope.slides = [
        { 'image': '/public/images/1.jpg' }
        //{ 'image': '/public/images/2.jpg' },
        //{ 'image': '/public/images/3.jpg' },
        //{ 'image': '/public/images/4.jpg' }
    ];

    $scope.currentIndex = 0;

    $scope.setCurrentSlideIndex = function (index) {
        $scope.interval = 0;
        var k = jQuery('.slider_wrap').height();
        jQuery('.slider_wrap').css({'height':k});

        //jQuery('.round-left').css({'position':'absolute','top':k/2-30,'z-index':9998});
        //jQuery('.round-right').css({'position':'absolute','top':k/2-30,'z-index':9998});

        $scope.currentIndex = index;
    };

    $scope.isCurrentSlideIndex = function (index) {
        return $scope.currentIndex === index;
    };

    $scope.next = function() {
        $scope.interval = 0;
        var k = jQuery('.slider_wrap').height();
        jQuery('.slider_wrap').css({'height':k});

        //кнопки на место
        //jQuery('.round-left').css({'position':'absolute','top':k/2-30,'z-index':9998});
        //jQuery('.round-right').css({'position':'absolute','top':k/2-30,'z-index':9998});

        $scope.currentIndex < $scope.slides.length - 1 ? $scope.currentIndex++ : $scope.currentIndex = 0;
    };

    $scope.prev = function() {
        $scope.interval = 0;
        var k = jQuery('.slider_wrap').height();
        jQuery('.slider_wrap').css({'height':k});

        //jQuery('.round-left').css({'position':'absolute','top':k/2-30,'z-index':9998});
        //jQuery('.round-right').css({'position':'absolute','top':k/2-30,'z-index':9998});

        $scope.currentIndex > 0 ? $scope.currentIndex-- : $scope.currentIndex = $scope.slides.length - 1;
    };

    $scope.play = function(){
        $interval(function() {
            $scope.next();
            $scope.interval = 0;
        }, 20000); //2
    }

    $scope.interval = 0;
    $interval(function() {
        $scope.interval = ($scope.interval + 0.5) % 100;
    }, 1000);

    $scope.play();






});

app.controller('rotateCtrl', function ($scope, $http, $timeout,$interval) {
    $scope.rotate_content = function() {
        jQuery('.wrapper').css({'max-height':'100%','overflow':'hidden'}).removeClass('duration').addClass('perspective_main').removeClass('perspective_main_back');
        jQuery('.contact_form').css({'right':'0'});
    };

    $scope.rotate_back= function() {
        jQuery('.wrapper').css({'height':'100%','overflow':'inherit'}).removeClass('duration').addClass('perspective_main_back').removeClass('perspective_main');
        jQuery('.contact_form').css({'right':'-40%'});
    };
});
