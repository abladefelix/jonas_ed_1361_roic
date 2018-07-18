<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use DateTime;

class NotificationsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function setNotification($user_id = 0, $title = 'none', $content = null, $type = 'default', $system = 'none')
  {
    $setNotification = DB::table('notifications')->insert(['user_id' => $user_id, 'title' => $title, 'content' => $content, 'type' => $type, 'system' => $system]);
    return $setNotification;
  }

  public function clearNotifications($type)
  {
    $clearNotifications = DB::table('notifications')->where('type', $type)->update(['status' => 0]);
  }

}
