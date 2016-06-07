<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function showWelcome() {
        $items = Item::get();
        return View::make('hello',array('items' => $items));
    }

    public function ajax() {
        $response = Response::make(json_encode(array('response' => 'failure')));

        if (Input::has('id')) {
            $item = Item::find(Input::get('id'));
        } else {
            $item = new Item;
        }

        if (Input::has('distance')) {
            $item->distance = Input::get('distance');
        }
         if (Input::has('age')) {
            $item->age = Input::get('age');
        }
         if (Input::has('floor')) {
            $item->floor = Input::get('floor');
        }
         if (Input::has('layout')) {
            $item->layout = Input::get('layout');
        }
        if (Input::has('school')) {
            $item->school = Input::get('school');
        }
        if (Input::has('air')) {
            $item->air = Input::get('air');
        }
        if (Input::has('light')) {
            $item->light = Input::get('light');
        }
         if (Input::has('name')) {
            $item->name = Input::get('name');
        }

        if ( $item->save()) {

            $response = Response::make(json_encode(array('response' => 'success ', 'id'=>  $item->id)));
        }


        $response->header('Content-Type', 'application/json');

        return $response;
    }

}
