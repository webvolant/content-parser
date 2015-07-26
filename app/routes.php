<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('/getData', function()
{
    $url = Input::get('sublink');
    $exps = Input::get('exp');
    //$exps->address;
    //var_dump($exps[0]['address']);
    //return json_encode($exps);
	$parsers = new parser($url,$exps);
    return json_encode($parsers);
});

Route::post('/toWord', function()
{
    $name = 'file.docx';
    $data = Request::all();
    //$len = count($data['url']);

    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();

    foreach ($data as $item){
        $url = htmlspecialchars($item['url']);
        $title = htmlspecialchars($item['title']);
        $html = strip_tags($item['text']);
        $words = strip_tags($item['count_words']);
        $text = html_entity_decode($html, ENT_QUOTES, 'UTF-8');


        $section->addText($url.' - '.$words,array('name'=>'Tahoma', 'size'=>8, 'bold'=>true));
        $section->addText($title,array('name'=>'Arial', 'size'=>16, 'bold'=>true));
        $section->addText($text,array('name'=>'Verdana', 'size'=>10, 'bold'=>false));
    }

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($name);

    return "/public/$name";
    /*var_dump($data);
    for($i=0; $i<2; $i++){
        echo $data[$i];
    }*/

    /*for($i=0; $i<$len; $i++){
        $url = htmlspecialchars($data['url'][$i]);
        $title = htmlspecialchars($data['title'][$i]);
        $html = strip_tags($data['text'][$i]);
        $text = html_entity_decode($html, ENT_QUOTES, 'UTF-8');


        $section->addText($url,array('name'=>'Tahoma', 'size'=>10, 'bold'=>false));
        $section->addText($title,array('name'=>'Arial', 'size'=>16, 'bold'=>true));
        $section->addText($text,array('name'=>'Verdana', 'size'=>12, 'bold'=>false));
/*
    $section->addText('Hello world! I am formatted.',
        array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));

    $phpWord->addFontStyle('myOwnStyle',
        array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
    $section->addText('Hello world! I am formatted by a user defined style',
        'myOwnStyle');

    $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    $fontStyle->setBold(true);
    $fontStyle->setName('Verdana');
    $fontStyle->setSize(22);
    $myTextElement = $section->addText('Hello World!');
    $myTextElement->setFontStyle($fontStyle);

    // Finally, write the document:
    // The files will be in your public folder
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('helloWorld.docx');*/

    /*$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
    $objWriter->save('helloWorld.odt');

    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'RTF');
    $objWriter->save('helloWorld.rtf');///
    }*/

    //var_dump($len);
    //$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //$objWriter->save('File.docx');
});

Route::get('/home', array('as' => 'home',
    'uses' => 'ParserController@home'));

Route::post('/home', array('as' => 'home',
    'uses' => 'ParserController@home'));

Route::get('/', array('as' => 'home',
    'uses' => 'ParserController@home'));

Route::post('/', array('as' => 'home',
    'uses' => 'ParserController@home'));

Route::get('urls', array('as' => 'urls',
    'uses' => 'ParserController@urls'));