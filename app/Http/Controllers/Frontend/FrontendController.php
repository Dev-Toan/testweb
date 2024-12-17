<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function syncAttributeGroup($attributes)
    {
        $groupAttribute = [];
        foreach ($attributes as $key => $attribute) {
            $aaa = $attribute->gettype()['name'];
            $groupAttribute[$aaa][] = $attribute->toArray();
        }
        return $groupAttribute;
    }
}
