<?php

namespace App\Models;

use App\Traits\uuids;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    use uuids;

    public $incrementing = false;
}
