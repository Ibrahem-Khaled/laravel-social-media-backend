<?php

namespace App\Http\Controllers;

use App\Traits\GenerateUniqueSlug;
use App\Traits\SendResponse;
use App\Traits\UploadImage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests , SendResponse , GenerateUniqueSlug , UploadImage;
}
