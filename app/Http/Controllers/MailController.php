<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;

class MailController extends Controller
{

  function checkout($receiver, $user_id) {
    $getUser = DB::table('users')->where('id', $user_id)->first();
    $mailtext = '<html>
    <body>

    <h1>Hello '.$getUser->firstname.' '.$getUser->lastname.', thanks for buying in our shop.</h1>

    You can open your invoice here:<br>
    http://localhost:1361/#/user/orders/201807116B661

    </body>
    </html>
    ';

    $empfaenger = $receiver;
    $absendermail   = "shop@roic.io";
    $absendername   = "ROIC Shop";
    $betreff    = "ROIC Shop Purchase";

    $header  = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=utf-8\r\n";

    $header .= "From: $absendername <$absendermail>";
    // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
    $header .= "X-Mailer: PHP ". phpversion();

    mail($empfaenger, $betreff, $mailtext, $header);

  }

  function checkoutRegistration($receiver) {
    $mailtext = '<html>
    <body>

    <h1>Hello thanks for using ROIC.</h1>

    </body>
    </html>
    ';

    $empfaenger = $receiver;
    $absendermail   = "shop@roic.io";
    $absendername   = "Welcome to ROIC";
    $betreff    = "Thank you for using ROIC";

    $header  = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=utf-8\r\n";

    $header .= "From: $absendername <$absendermail>";
    // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
    $header .= "X-Mailer: PHP ". phpversion();

    mail($empfaenger, $betreff, $mailtext, $header);

  }

  function partnerApprovalMail($receiver) {
    $mailtext = '<html>
    <body>

    <h1>Hello thanks for using our partner program.</h1>

    </body>
    </html>
    ';

    $empfaenger = $receiver;
    $absendermail   = "partner@roic.io";
    $absendername   = "ROIC Partner Program";
    $betreff    = "Thank you for using ROIC";

    $header  = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=utf-8\r\n";

    $header .= "From: $absendername <$absendermail>";
    // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
    $header .= "X-Mailer: PHP ". phpversion();

    mail($empfaenger, $betreff, $mailtext, $header);

  }

}
