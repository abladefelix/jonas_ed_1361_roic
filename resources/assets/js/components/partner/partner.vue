<template>
  <div class="container">
    <div class="app-cart">
      <div class="app-title">Partner</div>
      <!-- IF is not a partner -->
      <div v-if="$root.user.is_partner == 0 && partner_status!=='success'">
        <p>
          "Get a partner info text"
        </p>
        <p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="terms_and_conditions">
            <label class="form-check-label" for="defaultCheck1">
              I’ve read and accept the <router-link to="/partner/termsandconditions" target="_blank">terms & conditions</router-link>
            </label>
            <div class="error-msg" v-if="terms_and_conditions_error">
              Please accept the terms & conditions.
            </div>
          </div>
        </p>
        <div class="mb-3">
          <div class="btn btn-gold" v-on:click="requestPartnership()" v-if="show_request_button">Request ROIC Partnership</div>
        </div>
      </div>
      <div v-if="partner_status=='success'">
        <p>Your Partner Request</p>
        <div class="alert alert-green">Your request was successfully approved. You can now login.</div>
        <div>
          <a href="/partner#/" class="btn btn-gold">Login into the partner area</a>
        </div>
      </div>
      <div v-if="$root.user.is_partner == 1">
        <p>Your are already a ROIC Partner</p>
        <div>
          <a href="/partner#/" class="btn btn-gold">Login here</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      partner_status:'',
      show_request_button:1,
      terms_and_conditions:false,
      terms_and_conditions_error:0
    }
  },
  created() {
    var vm = this;
  },
  methods: {
    requestPartnership() {
      var vm = this;
      vm.terms_and_conditions_error = 0;
      if (vm.terms_and_conditions == false) {
        vm.terms_and_conditions_error = 1;
        return;
      }
      vm.show_request_button = 0;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: domain+'/api/partner/request',
        type: 'post',
        dataType: 'json',
        data: {},
        beforeSend: function(data) {},
        complete: function(data) {
          var response = $.parseJSON(data.responseText);
          vm.partner_status = response.status;
        }
      });
    }
  }
}
</script>
