<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use DateTime;

class PartnerController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
  }

  public function request()
  {
    $is_partner = Auth::user()->is_partner;
    if ($is_partner == 0) {
      $setRequest = DB::table('users')->where('id', Auth::user()->id)->update(['is_partner' => 1]);
      if ($setRequest) {
        (new MailController)->partnerApprovalMail(Auth::user()->email);
        //generate referral ID
        $referral_link_uid = uniqid();
        $insertReferral = DB::table('referral_links')->insert(['partner_id' => Auth::user()->id, 'referral_link_uid' => $referral_link_uid]);
        $insertReferralAction = DB::table('referrals')->insert(['partner_id' => Auth::user()->mlm_owner, 'type_of_action' => 'referral_user_got_partner', 'referral_link_id' => 0, 'link_type' => 0, 'new_member_id' => Auth::user()->id]);
        return json_encode(['status' => 'success']);
      }
    } else if($is_partner == 1) {
      return json_encode(['status' => 'is_partner']);
    } elseif($is_partner == 2) {
      return json_encode(['status' => 'blocked']);
    }
  }

}
