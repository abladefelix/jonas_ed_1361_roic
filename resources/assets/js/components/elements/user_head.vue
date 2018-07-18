<template>
  <div class="app">
    <div class="rc-user">
      <h1>Overview</h1>
      <div v-if="!$root.user.unauthenticated">
        <div class="user-name">Hello <strong>{{$root.user.username}}</strong></div>
        <div class="user-welcome" v-if="$root.user.show_user_guide == 1">
          From your account dashboard you can manage your orders, informations and edit your password and profile. <small><a v-on:click="$root.user.show_user_guide = 0;setUserHeaderMessage()" class="hide-message">hide</a></small>
        </div>
        <a class="user-logout" href="/logout">Logout</a>
        <br>

        <div class="alert alert-black">
          The Know Your Customer (KYC) verification process has to be completed before being eligible to invest.
          <router-link v-on:click="section = 'kyc'" to="/user/kyc">Get verified here</router-link>
        </div>
      </div>
      <div v-else>
        <div class="user-welcome">
          You need to be logged in.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
    }
  },
  created() {
    var vm = this;
  },
  methods: {
    setUserHeaderMessage() {
      var vm = this;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: domain+'/api/user/status/guide',
        type: 'post',
        dataType: 'json',
        data: {status:0},
        beforeSend: function(data) {},
        complete: function(data) {
          //var response = $.parseJSON(data.responseText);
        }
      });
    }
  }
}
</script>
