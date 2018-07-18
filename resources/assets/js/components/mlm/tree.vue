<template>
  <div class="card">
    <div class="card-head">
      <div class="row">
        <div class="col-md-6">
          <h1>My Tree</h1>
        </div>
        <div class="col-md-6 text-right">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label>Search</label>
          <input class="form-control" id="search_partner" name="search_partner" placeholder="Search">
        </div>
      </div>
      <div class="col-md-7 text-right">
        <div v-if="partners.length > 1">{{partners.length}} Members</div>
        <div v-if="partners.length == 1">1 Member</div>
      </div>
    </div>
    <div>
      <div v-if="partners.length == 0">There are no members in your network</div>
      <ul class="list-group list-group-flush" v-if="partners.length !== 0">
        <li class="list-group-item">
          <div class="row">
            <div class="col-md-4"><strong>Name</strong></div>
            <!--<div class="col-md-2"><strong>Members (active)</strong></div>-->
            <div class="col-md-2"><strong>Wins</strong></div>
            <div class="col-md-2"><strong>Purchases</strong></div>
            <div class="col-md-2"><strong>Clicks</strong></div>
            <div class="col-md-2 text-right"><strong>$</strong></div>
          </div>
        </li>
        <li class="list-group-item" v-for="partner in partners">
          <div class="row">
            <div class="col-md-4">
              <button class="btn btn-link" data-toggle="modal" data-target="#partnerModal" v-on:click="getPartner(partner.id)">{{partner.firstname}} {{partner.lastname}}</button>
            </div>
            <!--<div class="col-md-2">{{partner.total_members}}</div>-->
            <div class="col-md-2">{{partner.total_registers}}</div>
            <div class="col-md-2">{{partner.total_purchases}}</div>
            <div class="col-md-2">{{partner.total_visits}}</div>
            <div class="col-md-2 text-right">$ {{partner.total_sales}}</div>
          </div>
        </li>
      </ul>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="partnerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{partner.user.firstname}} {{partner.user.lastname}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-group list-group-flush" v-if="partner.members.length !== 0">
              <li class="list-group-item">
                <div class="row">
                  <div class="col-md-4"><strong>Name</strong></div>
                  <!--<div class="col-md-2"><strong>Members (active)</strong></div>-->
                  <div class="col-md-2"><strong>Wins</strong></div>
                  <div class="col-md-2"><strong>Purchases</strong></div>
                  <div class="col-md-2"><strong>Clicks</strong></div>
                  <div class="col-md-2 text-right"><strong>$</strong></div>
                </div>
              </li>
              <li class="list-group-item" v-for="partner in partner.members">
                <div class="row">
                  <div class="col-md-4">
                    <button class="btn btn-link" v-on:click="getPartner(partner.id)">{{partner.firstname}} {{partner.lastname}}</button>
                  </div>
                  <!--<div class="col-md-2">{{partner.total_members}}</div>-->
                  <div class="col-md-2">{{partner.total_registers}}</div>
                  <div class="col-md-2">{{partner.total_purchases}}</div>
                  <div class="col-md-2">{{partner.total_visits}}</div>
                  <div class="col-md-2 text-right">$ {{partner.total_sales}}</div>
                </div>
              </li>
            </ul>
            <div v-if="partner.members.length == 0">This member has no members in his tree</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      partner:{user:[],members:[]},
      partners:[]
    }
  },
  created() {
    var vm = this;
    vm.getAllPartner();
  },
  props: {
    model: Object
  },
  methods: {
    getPartner(partner_id) {
      var vm = this;
      $.getJSON(domain+'/api/partner/'+partner_id, function(response) {
        vm.partner = response;
      });
    },
    getAllPartner() {
      var vm = this;
      $.getJSON(domain+'/api/partner/all', function(response) {
        vm.partners = response;
      });
    }
  }
}
</script>
