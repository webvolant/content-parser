<!doctype html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>Обработка сайта</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="template/loaders/loaders.css-master/loaders.css">
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
            background: rgb(15, 148, 187);

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

        .loader {
            width: 52px;
            height: 52px;
            position: absolute;
            z-index: 100505;
            left: 45%;
            top: 45%;
            margin: -16px 0 0 -16px;
        }

        .loader span{
            position: absolute;
            left: -200%;
            top: 150%;
            width:300px;
            color: #ffffff;

        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-sanitize.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-resource.js"></script>
    <script src="js/ab_parser.js"></script>
</head>
<body>

<div id="page-preloader"><div class="loader"><div class="loader-inner square-spin"><div></div></div></div></div>

<div class="container-fluid">

<div ng-controller="parserCtrl">
    <div class="container">
    <div class="row">
        <div class="col-xs-offset-0 col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">

            <h2>Сервис - собирает текст с сайта</h2>

            <form  name="userForm"  class="">


                <div class="panel panel-primary">
                    <div class="panel-heading">Адрес исследования</div>
                    <div class="panel-body">

                            <input type="text" ng-model="sublink" class="input-medium search-query form-control" placeholder="http://labmagnat.kg/" required/>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Исключение адресов</div>
                    <div class="panel-body">

                        <div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Важно!</strong> <h6>Если вам нужно исключить к примеру адреса с forum - http://site.com/forum,нужно указать просто forum</h6>
                            Количество исключаемых адресов может быть БЕСКОНЕЧНО!<br/>
                            Добавляйте нажатием кнопки...
                        </div>

                        <p><button class="btn btn-danger form-control" ng-click="addNewChoice()">Добавить исключение</button></p>

                        <div data-ng-repeat="item in exp">
                            <p class="" ng-show="!$last">
                                <input type="text" ng-model="item.address" name="" class="form-control" placeholder="forum">
                            </p><!-- /input-group -->

                                <div class="input-group" ng-show="$last">
                                    <input type="text" ng-model="item.address" name="" class="form-control" placeholder="forum">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-warning remove form-control"  ng-click="removeChoice()"><span class="glyphicon glyphicon-remove"></span>  Удалить</button>
                                    </span>
                                </div><!-- /input-group -->
                        </div>

                    </div>
                </div>


                <p>
                    <button type="submit" class="btn btn-success form-control" ng-click="sub()">Начать сбор информации</button>
                </p>
            </form>
        </div>
    </div>
</div>


    <hr/>

    <div ng-show="loader" ng-bind-html="loader">
    </div>

    <button type="" ng-show="values" class="btn btn-success" ng-click="selectedToWord(values)">Экспортировать в Word</button>
    <a class="btn btn-info" ng-show="filename" href="%% filename %%">Скачать файл</a>

    <table class="table table-hover">

        <thead>
        <tr>
            <th>Сумма слов: %% sum %%</th>
        </tr>
            <th>
                <input type="checkbox"  ng-checked="true" ng-model="selectedAll" ng-click="checkAll(values,selectedAll)"/>Отметить все
            </th>
            <th> Ссылка </th>
            <th> Заголовок </th>
            <th> Текст </th>
            <th> Числов слов </th>
        </thead>
        <tr ng-repeat="value in values">
            <td>
                <input type="checkbox" id="" ng-value="value.enabled"
                       ng-checked="true" ng-model="value.enabled" ng-click="Selected(value)"/>
            </td>
            <td>%% value.url %%</td>
            <td>%% value.title %%</td>
            <td>%% value.text %%</td>
            <td>%% value.count_words %%</td>

        </tr>
        <tr>
            <th>Сумма слов: %% sum %%</th>
        </tr>
    </table>
</div>
</div>


<div class="fluid-container footer">
    <div class="container">
        <div class="developed pull-right">
            <style>
                img.developed_logo {
                    position: relative;
                    top:-2px;
                }
            </style>
            <img src="/public/template/ablogo.png" class="developed_logo" width="20px" height="20px"> <a href="">AB SOLUTIONS</a> - Разработка сервиса<br>
            <div class="pull-right"><a href="mailto:barkalovlab@gmail.com"><span class="glyphicon glyphicon-envelope"></span> Антон Баркалов</a></div>
        </div>




    </div>

</div>

</body>

<script>
    $(window).on('load', function () {
        var $preloader = $('#page-preloader'),
            $spinner   = $preloader.find('.loader');
        $spinner.fadeOut();
        $preloader.delay(400).fadeOut('fast');
    });

    $( document ).ready(function() {
        setInterval (function(){
            if (scrollY > 0)
                jQuery('.topmenu').css({'background':'rgba(23, 60, 78, 0.8)'}).addClass('duration');
            //window.alert(scrollY);
            else
                jQuery('.topmenu').css({'background':'inherit'}).removeClass('duration');

        }, 300);






        //Добавление формы в клиниках для выбора теста.
        var $i=0;
        jQuery(".test-new").click(function(e) {
            e.preventDefault();


            //var arr = [{'1':'root'},{'2':'---two'}];
            //window.alert( obj );
            //var arr = obj;
            //var selector = "<form class='' 'default' role='form'><div class='div50 margin10'><label for='test_id'>Исследование</label><select class='form-control' id='test_id"+$i+"'></select></div>";
            //$(".tests").append(selector);
            var form = "<div class='div50 margin10'><label for='test_id'>Пример ссылки: http://labmagnat.kg/forum</label><input type='text' ng-model='xp' class='form-control' id = 'test_id"+$i+"'/></div></form>";
            jQuery(".tests").append(form);

            //var select = $("#test_id"+$i);
            //select.html('');
        });


    });
/*
        //if (arr){
            for(var k in arr){
                console.log(k, '=>', arr[k]);
                $.each((k, '=>', arr[k]), function(i, value) {
                    //window.alert(value);
                    select.append('<option id="' + i + '" value="' + i + '">' + value + '</option>');
                });
            }
            $i=$i+1;
        //}
        */

/*
    //Сохранение значений из формы в клиниках.
    $(".test-save").click(function(e) {
        e.preventDefault();
        var $p = 0;

        var klinik_id = $("input[name=klinik_id]").val();

        var arr = [];
        arr["test_id"] = [];
        arr["price_for_test"] = [];
        //arr["links"] = [];

        $(".tests select").each(function(i) {
            arr.test_id.push($("select[id=test_id"+$p+"]").val());
            arr.price_for_test.push($("input[id=price_for_test"+$p+"]").val());
            //arr.price_for_test.push($("input[id=links"+$p+"]").val());
            //window.alert(test_id);
            //window.alert(price_for_test);
            $p=$p+1;
        });
        $.post('/admin/test-save', {test_id:JSON.stringify(arr.test_id),price_for_test:JSON.stringify(arr.price_for_test),klinik_id:klinik_id},function(data){
            //$(".dropdown-messages").html(data);
            if (data['flag']=='0')
                swal({
                    title: 'Ошибка',
                    text: data['data'],
                    type: 'error',
                    confirmButtonText: 'Закрыть'
                });
            else{
                swal({
                    title: 'Успех',
                    text: data['data'],
                    type: 'success',
                    confirmButtonText: 'Закрыть'
                });
            }
            location.reload();
        });
    });
*/
    //удаление значений из формы в клиниках.
    /*$(".test-delete").click(function(e) {
        e.preventDefault();
        $(this).parents('p').remove();//.html('Исследование было удалено!');
        var test_id = $(this).attr('id');
        //window.alert(test_id);
        var klinik_id = $("input[name=klinik_id]").val();
        $.post('/admin/test-delete', {test_id:test_id,klinik_id:klinik_id},function(data){
            console.log(data);
        });
    });*/




</script>
</html>