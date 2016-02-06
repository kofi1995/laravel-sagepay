<?php

namespace Kofikwarteng\LaravelSagepay\Facade;

use Illuminate\Support\Facades\Facade;

class SagePayFacade extends Facade {

    protected static function getFacadeAccessor() {
      return 'laravelsagepay';
     }

}
