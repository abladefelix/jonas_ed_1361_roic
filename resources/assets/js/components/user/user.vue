<template>
  <div class="container user-start">
    <Header/>
    <div class="app-body" v-if="!$root.user.unauthenticated">
      <div class="sec-orders">
        <Navigation/>
        <div class="app-block">
          <div class="app-title">Start</div>
          <div class="row mb-3">
            <div class="col-md-3">
              <div class="panel panel-default u-panel-info">
                <div class="panel-heading">ROIC Coins <br><span style="font-weight:600;font-size: 19px;">{{$root.user.roic_coins}}</span></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-default u-panel-info">
                <div class="panel-heading">You have a total of <br><span style="font-weight:600;font-size: 19px;">{{overview.orders_count}} Orders</span></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-default u-panel-info">
                <div class="panel-heading">
                  Your Coupons <br><span style="font-weight:600;font-size: 19px;">Total value $ {{$root.user.total_coupon_value}}</span>
                  <div>
                    <ul class="list-group">
                      <li class="list-group-item" v-for="coupon in $root.user.coupons">
                        <div class="row">
                          <div class="col-md-8"><span style="color: #1d1e22;">{{coupon.coupon_code}}</span></div>
                          <div class="col-md-4 text-right">$ {{coupon.value}}</div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <router-link to="/shop" class="btn btn-gold">Buy ROIC Coins</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Header from '../elements/user_head.vue'
import Navigation from '../elements/user_navigation.vue'
export default {
  data() {
    return {
      overview:[],
      current_carrier_level:5,
      carrier_levels:[
        {'id':'1','name':'Junior Consultant','height':'160','margin_top':'210'},
        {'id':'2','name':'Consultant','height':'190','margin_top':'180'},
        {'id':'3','name':'Senior Consultant','height':'220','margin_top':'150'},
        {'id':'4','name':'Junior Ambassador','height':'250','margin_top':'120'},
        {'id':'5','name':'Ambassador','height':'280','margin_top':'90'},
        {'id':'6','name':'Senior Consultant','height':'310','margin_top':'60'},
        {'id':'7','name':'Vice President','height':'340','margin_top':'30'},
        {'id':'8','name':'President','height':'370','margin_top':'0'}
      ]
    }
  },
  created() {
    var vm = this;
    vm.getOrdersCount();
  },
  methods: {
    getOrdersCount() {
      var vm = this;
      $.getJSON(domain+'/api/user/overview', function(response) {
        vm.overview = response;
      });
    }
  },
  components: {
    Header,
    Navigation
  }
}
</script>
