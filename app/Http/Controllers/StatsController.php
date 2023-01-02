<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    /**
     * Count models row
     * 
     * @param Request Illuminate\Http\Request
     */
    public function count(Request $request)
    {
        $params = $request->all();
        foreach ($params as $i => $v) {
            $params[$i] = boolval(intval($v));

            if ($params[$i] === true) {
                switch ($i) {
                    case 'warehouse': {
                            $params[$i] = Warehouse::count();

                            break;
                        }
                    case 'supplier': {
                            $params[$i] = Supplier::count();

                            break;
                        }
                    case 'brand': {
                            $params[$i] = Brand::count();

                            break;
                        }
                    case 'unit': {
                            $params[$i] = Unit::count();

                            break;
                        }
                    case 'product': {
                            $params[$i] = Product::count();

                            break;
                        }
                    default: {
                            $params[$i] = null;
                        }
                }
            } else {
                $params[$i] = null;
            }
        }

        return response(['message' => 'Count all stats success', 'data' => [
            'count' => $params
        ]], 200);
    }
}
