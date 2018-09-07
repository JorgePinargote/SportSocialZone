<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Follow extends Eloquent
{
    protected $connection = 'mongodb';

}
