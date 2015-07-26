var app = angular.module('myApp', ["ngResource", "ngSanitize", 'ui.bootstrap', 'ngAnimate' ] );

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('%%');
    $interpolateProvider.endSymbol('%%');
});
/*
app.config(['$httpProvider', function($httpProvider){
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

    $httpProvider.defaults.transformRequest = [function(data) {
        var param = function(obj) {
            var query = '';
            var name, value, fullSubName, subValue, innerObj, i;

            for(name in obj) {
                value = obj[name];

                if(value instanceof Array) {
                    for(i=0; i<value.length; ++i) {
                        subValue = value[i];
                        fullSubName = name + '[' + i + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                } else if(value instanceof Object) {
                    for(subName in value) {
                        subValue = value[subName];
                        fullSubName = name + '[' + subName + ']';
                        innerObj = {};
                        innerObj[fullSubName] = subValue;
                        query += param(innerObj) + '&';
                    }
                } else if(value !== undefined && value !== null) {
                    query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
                }
            }

            return query.length ? query.substr(0, query.length - 1) : query;
        };

        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
}]);*/

app.controller('parserCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.filename = "";
    $scope.sublink ="http://labmagnat.kg";
    $scope.exp = [{id: 'exp1'}];
    $scope.loader = '';

    $scope.sub = function(){
        $scope.loader = "<div id='page-preloader'><div class='loader'><div class='loader-inner pacman'><div></div><div></div><div></div><div></div><div></div></div><span>Я собираю информацию. Пожалуйста ждите!</span></div></div>";
        jQuery('#page-preloader').fadeIn(400).css({background:'rgba(15, 148, 187, 0.91)'});
        $scope.ar = {};
        $scope.elements = {};
        $scope.values = [];
        $scope.sum = 0;
        $http({
            method: 'POST',
            url: '/getData',
            data: {exp:$scope.exp,sublink:$scope.sublink}
        })
        .success(function(ar, status, headers, config) {
                jQuery('#page-preloader').fadeOut(400);
                $scope.loader = '';
                $scope.ar = ar;
                for ($i=0; $i<Object.keys($scope.ar.result).length; $i++)
                {
                    var tempvar = $scope.ar.result[$i].url;
                    var temptitle = $scope.ar.result[$i].title;
                    var temptext = $scope.ar.result[$i].text;
                    var words = $scope.ar.result[$i].count_words;
                    $scope.values.push({ url: tempvar, enabled:true,title: temptitle,text: temptext, count_words: words});
                    $scope.sum +=parseInt(words);
                }
        })
        .error(function(data, status, headers, config) {
            console.log(data);
                jQuery('#page-preloader').fadeOut(400);
                $scope.loader = '';
        });
    }


    $scope.addNewChoice = function() {
        var newItemNo = $scope.exp.length+1;
        $scope.exp.push({'id':'exp'+newItemNo});
    };

    $scope.removeChoice = function() {
        var lastItem = $scope.exp.length-1;
        $scope.exp.splice(lastItem);
    };

    //SUMME
    $scope.Selected = function (data){
        console.log(data.enabled)
        if (data.enabled==true) {$scope.sum +=parseInt(data.count_words); data.enabled = true; }
        if (data.enabled==false) {$scope.sum -=parseInt(data.count_words); data.enabled = false;}
        console.log(data)
    };

    //check all or uncheck all
    $scope.checkAll = function (elements, selectedAll) {
        angular.forEach(elements, function (item) {
            item.enabled = selectedAll;
            if (selectedAll==true)
                $scope.sum +=parseInt(item.count_words);
            else
                $scope.sum = 0;
        });
    };

    $scope.selectedToWord = function(elements){
        $scope.valuesToWord = [];
        /*var listRetailers = [
            {"url":"http://www.fake1.com", "title":"images/1logo.jpg", "text":"1"},
            {"url":"http://www.fake2.com", "title":"images/2logo.gif", "text":"1"}
        ]*/
        for ($i=0; $i<Object.keys(elements).length; $i++)
        {
            if (elements[$i].enabled==true){
                var tempurl = elements[$i].url;
                var temptext = elements[$i].text;
                var temptitle = elements[$i].title;
                var words = elements[$i].count_words;
                $scope.valuesToWord.push({ url: tempurl,title: temptitle,text: temptext, count_words: words});
            }
        }
        //console.log($scope.valuesToWord);
        $http({
            method: 'POST',
            url: '/toWord',
            //headers: { 'Content-Type' : 'application/json' },
            data: $scope.valuesToWord
        })
            .success(function(mass, status, headers, config) {
                $scope.filename = mass;
                console.log(mass);
            })
            .error(function(data, status, headers, config) {
                console.log(data);
            });
    };

}]);

