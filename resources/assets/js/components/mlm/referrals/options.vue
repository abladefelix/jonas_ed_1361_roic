<template>
  <div class="card">
    <div class="card-head">
      <div class="row">
        <div class="col-md-6">
          <h1>Refferal Options</h1>
        </div>
        <div class="col-md-6 text-right">
          <router-link to="/referrals" class="btn btn-dark">Referral Statics</router-link>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Your Referral Link</span>
          </div>
          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" :value="'https://p.roic.io/#/partner/r/'+banners.referral_link_uid">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="rf-banner-name"><strong>Banner 1</strong></div>
        <div class="rf-banner rf-banner-1"></div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Script</span>
          </div>
          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" :value="banners.banner1.script">
        </div>
      </div>
      <div class="col-md-6">
        <div class="rf-banner-name"><strong>Banner 2</strong></div>
        <div class="rf-banner rf-banner-2"></div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Script</span>
          </div>
          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" :value="banners.banner2.script">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="rf-banner-name"><strong>Banner 3</strong></div>
        <div class="rf-banner rf-banner-3"></div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Script</span>
          </div>
          <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" :value="banners.banner3.script">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      banners:[]
    }
  },
  created() {
    var vm = this;
    vm.getBanners();
  },
  methods: {
    getBanners() {
      var vm = this;
      $.getJSON(domain+'/api/partner/banners', function(response) {
        vm.banners = response;
      });
    }
  }
}
</script>
