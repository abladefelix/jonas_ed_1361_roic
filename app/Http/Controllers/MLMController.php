<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use DateTime;

class MLMController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    return view('mlm');
  }

  public function getBanners()
  {
    $getBanners = DB::table('referral_links')->where('partner_id', Auth::user()->id)->first();
    $getBanners->link1 = ['name' => 'Link'];
    $getBanners->banner1 = ['name' => 'Banner 1', 'script'=>'<iframe src="https://scripts.roic.io/r/b1/'.$getBanners->referral_link_uid.'"></iframe>'];
    $getBanners->banner2 = ['name' => 'Banner 2', 'script'=>'<iframe src="https://scripts.roic.io/r/b2/'.$getBanners->referral_link_uid.'"></iframe>'];
    $getBanners->banner3 = ['name' => 'Banner 3', 'script'=>'<iframe src="https://scripts.roic.io/r/b3/'.$getBanners->referral_link_uid.'"></iframe>'];
    return json_encode($getBanners);
  }

  public function getAllPartner($user_id)
  {
    $getAllPartner = DB::table('users')->where('mlm_owner', $user_id)->get();
    foreach ($getAllPartner as $key => $partner) {
      $partner->total_visits = DB::table('referrals')->where('partner_id', $partner->id)->where('type_of_action', 'referral_partner_page_visit')->count();
      $partner->total_purchases = DB::table('referrals')->where('partner_id', $partner->id)->where('type_of_action', 'referral_partner_purchase')->count();
      $partner->total_registers = DB::table('referrals')->where('partner_id', $partner->id)->where('type_of_action', 'referral_partner_register')->count();
      $partner->total_members = DB::table('users')->where('mlm_owner', $partner->id)->count();
      $partner->total_sales = DB::table('referrals')->where('partner_id', $partner->id)->where('type_of_action', 'referral_partner_sale')->sum('sales');
    }
    return $getAllPartner;
  }

  public function getAllPartnerJson()
  {
    return json_encode($this->getAllPartner(Auth::user()->id));
  }

  public function getPartner($partner_id)
  {
    $getUser = DB::table('users')->where('id', $partner_id)->select('firstname', 'lastname')->first();
    $getPartner = ['user' => $getUser, 'members' => $this->getAllPartner($partner_id)];
    return json_encode($getPartner);
  }

}
