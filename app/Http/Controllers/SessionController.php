<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use DateTime;
use Session;

class SessionController extends Controller
{

  public function setSession()
  {
    //IF visitor is logged in or it temp_user
    if ((new MainController)->checkTempSession()) {
      $sessionReferralID = Session::get('referral_id');
      //SET session with partner id
      Session::put('referral_id', $_POST['referral_id']);
      $getUser = (new MainController)->getUserOrTempUser();
      //IF there is already a session with a referral_id
      if (isset($sessionReferralID)) {
        $getReferralOwner = DB::table('referral_links')->where('referral_link_uid', $sessionReferralID)->first();
        $insertReferralAction = DB::table('referrals')->insert(['partner_id' => $getReferralOwner->partner_id, 'type_of_action' => 'referral_partner_page_impression', 'referral_link_id' => 0, 'link_type' => 0, 'new_member_id' => $getUser->id]);
        return json_encode(['status' => 'impression_set']);
      } else {
        $getReferralOwner = DB::table('referral_links')->where('referral_link_uid', $_POST['referral_id'])->first();
        $insertReferralAction = DB::table('referrals')->insert(['partner_id' => $getReferralOwner->partner_id, 'type_of_action' => 'referral_partner_page_visit', 'referral_link_id' => 0, 'link_type' => 0, 'new_member_id' => $getUser->id]);
        return json_encode(['status' => 'visit_set']);
      }
    } else {
      return json_encode(['status' => 'is_auth']);
    }
  }

}
