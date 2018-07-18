<template>
  <div class="container">
    <div class="app-cart">
      <div class="app-title">Partner Page</div>
      <!-- IF is not a partner -->
      <div>
        <p>
          "Informationen zur Partner-Seite" (Sobald diese Seite aufgerufen wird, wird ein cookie / session gesetzt)
        </p>
        -
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
    vm.setSession();
  },
  methods: {
    setSession() {
      var vm = this;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: domain+'/api/partner/referral/setsession',
        type: 'post',
        dataType: 'json',
        data: {referral_id:vm.$route.params.referral_id},
        beforeSend: function(data) {},
        complete: function(data) {
          var response = $.parseJSON(data.responseText);
        }
      });
    },
  }
}
</script>
