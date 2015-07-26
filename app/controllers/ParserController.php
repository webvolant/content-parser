<?php

class ParserController extends Controller {

    public function home()
    {
        if (Input::all()!=0){
            $url = Input::get('url');
            return View::make('parser/home', array('url'=>$url));
        }
        return View::make('parser/home');
    }


}