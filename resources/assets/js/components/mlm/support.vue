<template>
  <div class="card">
    <div class="card-head">
      <div class="row">
        <div class="col-md-6">
          <h1>Support Tickets</h1>
        </div>
        <div class="col-md-6 text-right">
        </div>
      </div>
    </div>
    <div class="mb-3">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        New Ticket
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="ticket_form">
                <div class="form-group">
                  <label for="exampleInputEmail1">Subject</label>
                  <input type="email" class="form-control" id="subject" name="subject" v-model="form.subject">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Message</label>
                  <textarea class="form-control" id="message" name="message" rows="8" v-model="form.message"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" v-on:click="createTicket">Create Ticket</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade bd-example-modal-lg chat-modal" id="openTicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{active_ticket.subject}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div>
                <div class="panel panel-primary">
                  <div class="panel-body">
                    <ul class="chat">
                      <li class="right clearfix"><span class="chat-img pull-right">
                        <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                      </span>
                      <div class="chat-body clearfix">
                        <div class="header">
                          <!--<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>-->
                          <strong class="pull-right primary-font">You</strong>
                        </div>
                        <p>
                          {{active_ticket.message}}
                        </p>
                      </div>
                    </li>
                    <!--
                    <li class="left clearfix"><span class="chat-img pull-left">
                      <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                      <div class="header">
                        <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                          <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                        </div>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                          dolor, quis ullamcorper ligula sodales.
                        </p>
                      </div>
                    </li>
                    <li class="right clearfix"><span class="chat-img pull-right">
                      <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                      <div class="header">
                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                      </div>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                        dolor, quis ullamcorper ligula sodales.
                      </p>
                    </div>
                  </li>
                  -->
                </ul>
              </div>
              <div class="panel-footer" v-if="active_ticket.status == 1">
                <div class="input-group">

                  <!-- Message input -->
                  <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." v-model="ticket_modal.message"/>

                  <span class="input-group-btn">
                    <button v-on:click="sendMessage(ticket_modal.ticket_id)" class="btn btn-warning btn-sm" id="btn-chat">
                      Send</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deleteTicket(ticket_modal.ticket_id)">
            Delete Ticket</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Subject</th>
          <th>Raised Time</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="ticket in tickets">
          <td>#{{ticket.id}}</td>
          <td>{{ticket.subject}}</td>
          <td>{{ticket.time_created}}</td>
          <td>
            <span class="badge badge-warning" v-if="ticket.status == 0">Open</span>
            <span class="badge badge-success" v-if="ticket.status == 1">New Answer</span>
            <span class="badge badge-secondary" v-if="ticket.status == 2">Closed</span>
          </td>
          <td><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target="#openTicketModal" v-on:click="getTicket(ticket.id)">open</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      tickets:[],
      active_ticket:[],
      form:{
        subject:'',
        message:''
      },
      // object to be used when modal is opened or displayed
      ticket_modal:{
        ticket_id:'', // ticket id
        message:'' // message
      }
    }
  },
  created() {
    var vm = this;
    vm.getTickets();
  },
  methods: {
    getTicket(ticket_id) {
      var vm = this;
      $.getJSON(domain+'/api/support/ticket/'+ticket_id, function(response) {
        vm.active_ticket = response;
      });

      vm.ticket_modal.ticket_id = ticket_id; // set ticket_modal object's ticket_id
    },
    getTickets() {
      var vm = this;
      $.getJSON(domain+'/api/support/tickets', function(response) {
        vm.tickets = response;
      });
    },
    createTicket() {
      var vm = this;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: domain+'/api/support/ticket/new',
        type: 'post',
        dataType: 'json',
        data:$('#ticket_form').serialize(),
        beforeSend: function(data) {
          if (vm.form.message == '' || vm.form.subject == '') {
            return;
          }
        },
        complete: function(data) {
          var response = $.parseJSON(data.responseText);
          vm.getTickets();
          vm.form.message = '';
          vm.form.subject = '';
        }
      });
    },
    // sends Message from Modal
    sendMessage(ticket_id){
      var vm = this;

      // assign vlaues to ticket message object properties
      vm.ticket_modal.ticket_id = ticket_id; // ticket_id
      // message will contain value from input field

      $.ajax({
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          url: '/api/support/ticket/send_message',
          type: 'POST',
          data: vm.ticket_modal, // ticket message object
          dataType: 'json',
          success: function(data) {
                    console.log('Ticket Message was sent succesfully.');
                    vm.ticket_modal.ticket_id = ''; // set id to empty
                    vm.ticket_modal.message = ''; // set message to empty
                },
                error: function (data) {
                  console.log('An error occurred.');
                  console.log(data);
                }
        });
    },
    // delete Ticket
    deleteTicket(ticket_id){
      var vm = this;

      // assign vlaues to ticket message object properties
      vm.ticket_modal.ticket_id = ticket_id; // ticket_id

      $.ajax({
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          url: '/api/support/ticket/delete',
          type: 'POST',
          data: vm.ticket_modal, // ticket message object
          dataType: 'json',
          success: function(data) {
                    console.log('Ticket was deleted succesfully.');
                    vm.ticket_modal.ticket_id = ''; // set id to empty
                    vm.ticket_modal.message = ''; // set message to empty
                    vm.getTickets(); // refresh tickets
                },
                error: function (data) {
                  console.log('An error occurred.');
                  console.log(data);
                }
        });
    }
  }
}
</script>
