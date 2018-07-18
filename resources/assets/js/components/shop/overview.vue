<template>
  <div class="container">
    <div class="sec-orders app-shop">
      <h1>Shop overview</h1>
      <p>
        Here you can buy ROIC Coins
        <div class="row">
          <div class="col-md-3">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Sort by</label>
              <div class="col-sm-8">
                <select class="form-control" v-on:change="getItems" v-model="sort_by">
                  <option value="">select</option>
                  <option value="price_low_high">price: low to high</option>
                  <option value="price_high_low">price: high to low</option>
                  <option value="popularity">by popularity</option>
                  <option value="coins">only coins</option>
                  <option value="information">only information</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </p>

      <div class="row">
        <div class="col-md-3" v-for="(pack, index) in roic_packages">
          <figure class="card card-product">
            <div class="img-wrap">
              <img src="https://roic.io/wp-content/uploads/2018/02/Roin_in_Bild3-2-frei-300x300.png" v-if="pack.type == 'roic_coins'">
              <img :src="pack.main_thumbnail" v-if="pack.type == 'information'">
            </div>
            <figcaption class="info-wrap">
              <h4 class="title">{{pack.display_name}}</h4>
            </figcaption>
            <div class="bottom-wrap">
              <div class="btn btn-black float-right" v-on:click="addItemToCart(pack.id)">Buy Now</div>
              <div class="price-wrap h5">
                <span class="price-new">${{pack.price}}</span> <del class="price-old" v-if="pack.price_old">${{pack.price_old}}</del>
              </div>
            </div>
          </figure>
        </div>
      </div>
    </div>
    <notifications group="item_to_cart" class="rc-notification" />
    <notifications group="item_not_found" class="rc-notification-red" />
    <Disclaimer/>
  </div>
</template>

<script>
import Disclaimer from '../elements/shop_disclaimer.vue'
export default {
  data() {
    return {
      roic_packages:[],
      sort_by:'popularity'
    }
  },
  created() {
    var vm = this;
    vm.getItems();
  },
  computed: {

  },
  methods: {
    getItems() {
      var vm = this;
      $.getJSON(domain+'/api/shop/articles/1/'+vm.sort_by, function(response) {
        vm.roic_packages = response;
      });
    },
    addItemToCart(item_id) {
      var vm = this;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: domain+'/api/session/cart/item/add',
        type: 'post',
        dataType: 'json',
        data: {item_id:item_id},
        beforeSend: function(data) {},
        complete: function(data) {
          var response = $.parseJSON(data.responseText);
          if (response.status == 'item_not_found') {
            vm.$notify({
              group: 'item_not_found',
              duration:3000,
              text: 'This item is currently not available'
            });
          }
          if (response.status == 'item_added' || response.status == 'quantity_updated') {
            vm.$root.getCart();
            vm.$notify({
              group: 'item_to_cart',
              duration:3000,
              text: 'A new item was added into your cart'
            });
            window.location.href = '/#/cart';
          }
        }
      });
    }
  },
  components: {
    Disclaimer
  }
}
</script>
