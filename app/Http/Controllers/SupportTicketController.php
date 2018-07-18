<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use DateTime;

class SupportTicketController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getTickets()
  {
    $getTickets = DB::table('support_tickets')->where('user_id', Auth::user()->id)->get();
    return json_encode($getTickets);
  }

  public function getTicket($ticket_id)
  {
    $getTicket = DB::table('support_tickets')->where('id', $ticket_id)->first();
    return json_encode($getTicket);
  }

  public function insertTicket()
  {
    $ticket_array = array(
      'user_id' => Auth::user()->id,
      'subject' => $_POST['subject'],
      'message' => $_POST['message']
    );
    $insertTicket = DB::table('support_tickets')->insert($ticket_array);
    if ($insertTicket) {
      return json_encode(['status' => 'success']);
    } else {
      return json_encode(['status' => 'error']);
    }
  }

  public function sendMessage(Request $request)
  {
    // message array
    $messageArray = array(
      'ticket_id' => $request->get('ticket_id'),
      'user_id' => Auth::user()->id,
      'message' => $request->get('message'),
      'time' => new DateTime()
    );

    $insertMessage = DB::table('support_ticket_chat')->insert($messageArray);
    if ($insertMessage) {
      return json_encode(['status' => 'success']);
    } else {
      return json_encode(['status' => 'error']);
    }
  }

  public function deleteTicket(Request $request)
  {
    // get ticket id
    $ticketId = $request->get('ticket_id');

    $deleteTicket = DB::table('support_tickets')->where('id', $ticketId)->delete();
    if ($deleteTicket) {
      return json_encode(['status' => 'success']);
    } else {
      return json_encode(['status' => 'error']);
    }
  }

}
