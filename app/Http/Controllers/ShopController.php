<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use DateTime;
use Session;

class ShopController extends Controller
{

  public function getArticles($category_id, $sort_by)
  {
    switch ($sort_by) {
      case 'popularity':
        $sort_by = 'sales';
        $sort_type= 'DESC';
        break;
      case 'price_low_high':
        $sort_by = 'price';
        $sort_type= 'ASC';
        break;
      case 'price_high_low':
        $sort_by = 'price';
        $sort_type= 'DESC';
        break;
      case 'coins':
        $sort_by = 'sales';
        $sort_type= 'DESC';
        break;
      case 'information':
        $sort_by = 'sales';
        $sort_type= 'DESC';
        break;
      default:
        $sort_by = 'sales';
        $sort_type= 'DESC';
        break;
    }
    $getArticles = DB::table('items')->where('category_id', $category_id)->orderby($sort_by, $sort_type)->get();
    return json_encode($getArticles);
  }

}
