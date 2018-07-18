<template>
  <div class="card">
    <div class="card-head">
      <div class="row">
        <div class="col-md-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-md-6 text-right">
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="dash-info-box">
            <div class="title">My Tree</div>
            <router-link to="/tree" class="view-more">View more</router-link>
            <span class="badge badge-danger">! 3 New Members</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="dash-info-box">
            <div class="title">Transactions</div>
            <router-link to="/transactions" class="view-more">View more</router-link>
          </div>
        </div>
        <div class="col-md-3">
          <div class="dash-info-box">
            <div class="title">Referrals</div>
            <router-link to="/referrals" class="view-more">View more</router-link>
          </div>
        </div>
        <div class="col-md-3">
          <div class="dash-info-box">
            <div class="title">Support Tickets</div>
            <router-link to="/support" class="view-more">View more</router-link>
          </div>
        </div>
      </div>
      <!--
      <div class="row">
        <div class="col-md-6">
          <div>
            <strong>Today Refferal visitors</strong>
            <div>Last Week Rise by 62%</div>
          </div>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div>
            <strong>Today Refferal clicks</strong>
            <div>Last Week Rise by 52%</div>
          </div>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div>
            <strong>Today Refferal wins</strong>
            <div>Last month Rise by 12%</div>
          </div>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-dash-news">
            <div class="news-head">
              <span class="news-notification">News</span>
            </div>
            <div class="news-author">
              <div class="author-profile"></div>
              <div class="author-info">
                <div class="author-name">Alex Muster</div>
                <div class="author-title">Data Analyst - Team ROIC</div>
              </div>
            </div>
            <div class="news-body">
              <p class="news-content">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry scrambled it to make text of the printing and typesetting industry scrambled a type specimen book text of the dummy text of the printing printing and typesetting industry scrambled dummy text of the printing.
              </p>
              <div class="btn btn-light btn-read-more">Read more</div>
            </div>
          </div>
        </div>
      </div>
      -->
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

  },
  methods: {

  }
}
</script>
