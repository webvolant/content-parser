<!doctype html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>Parser страниц и контента для переводчиков</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <link rel="stylesheet" type="text/css" href="template/loaders/loaders.css-master/loaders.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,700,100,400&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" type="text/css" href="template.css">











    <style>
        #page-preloader {
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background: rgb(0, 0, 0);
            z-index: 100500;
        }

        .loader-inner {
            width: 52px;
            height: 52px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin: -16px 0 0 -16px;
        }
    </style>


</head>
<body>


<div id="page-preloader"><div class="loader"><div class="loader-inner ball-triangle-path"><div></div><div></div><div></div></div></div></div>



<div class="wrapper">

<nav class="topmenu navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <div class="logotype"></div>




            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Навигация</span>
                <i class="fa fa-bars fa-inverse"></i>
            </button>
        </div>
        <div class="navbar-collapse collapse">



            <ul class="nav navbar-nav">
                <li><a href=""><span class="glyphicon glyphicon-home2"></span> Дом</a></li>
                <li><a href=""><span class="glyphicon glyphicon-user2"></span> Работа</a></li>
                <li><a href=""><span class="glyphicon glyphicon-plus2"></span> Контакты</a></li>
                <li><a href=""><span class="glyphicon glyphicon-plus2"></span> Клиенты</a></li>

            </ul>
            <div class="pull-right"><button href="" class="btn btn-info round margintop10" ng-controller="rotateCtrl" ng-click="rotate_content()">Сделать заказ</button></div>

        </div><!--/.nav-collapse -->



    </div>
</nav>





<div class="fluid-container dark">
    <div class="container">
        <div class="shadows"></div>



    </div>

</div>




<div class="fluid-container footer">
    <div class="container">
        <div class="shadows"></div>


        <div class="hr"></div>
        <p class="pull-left">Copyright © 2014-2015 AB SOLUTIONS</p>
    </div>

</div>



</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-animate.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-sanitize.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-resource.js"></script>
<script src="js/app.js"></script>
<script src="js/bl_slider.js"></script>


</body>

<div class="contact_form">
    <a href="" ng-controller="rotateCtrl" ng-click="rotate_back()">Убрать</a>
</div>

<script type="text/javascript">
    /*var link = window.location.href;
     var link_main = "<?php //echo Request::url().'/'; ?>";
     if (link == link_main){
     jQuery('.logotype').css({'background':'url("template/images/logo1.png") no-repeat'});
     jQuery('.topmenu li a').css({'color':'black'});
     //jQuery('.wrapper').css({'background':'#e2f0f2'});
     //window.alert($('body').height());
     //window.alert($('.wrapper').height());
     }*/
</script>


<script>

    $(window).on('load', function () {
        var $preloader = $('#page-preloader'),
            $spinner   = $preloader.find('.loader');
        $spinner.fadeOut();
        $preloader.delay(300).fadeOut('fast');
    });

    $( document ).ready(function() {
        setInterval (function(){
            if (scrollY > 0)
                jQuery('.topmenu').css({'background':'rgba(23, 60, 78, 0.8)'}).addClass('duration');
            //window.alert(scrollY);
            else
                jQuery('.topmenu').css({'background':'inherit'}).removeClass('duration');

        }, 300);

    });




</script>


</html>





