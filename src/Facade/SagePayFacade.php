<?php

namespace Kofikwarteng\LaravelSagepay\Facade;

use Illuminate\Support\Facades\Facade;

class SagePayFacade extends Facade {

//when we call our Alias, this class is called to make our alias work
    protected static function getFacadeAccessor() {
      return 'laravelsagepay';
     }

}
