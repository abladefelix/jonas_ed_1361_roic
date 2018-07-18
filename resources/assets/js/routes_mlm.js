import Vue from 'vue'
import VueRouter from 'vue-router'

import dashboard from './components/mlm/dashboard.vue'
import transactions from './components/mlm/transactions.vue'
import referrals from './components/mlm/referrals.vue'
import referrals_options from './components/mlm/referrals/options.vue'
import my_income from './components/mlm/income.vue'
import withdraw from './components/mlm/withdraw.vue'
import settings from './components/mlm/settings.vue'
import support from './components/mlm/support.vue'
import tree from './components/mlm/tree.vue'

Vue.use(VueRouter)

// 0. If using a module system (e.g. via vue-cli), import Vue and VueRouter and then call Vue.use(VueRouter).

// 1. Define route components.
// These can be imported from other files
const error = { template: '<div>Diese Seite gibt es nicht.</div>' }

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// Vue.extend(), or just a component options object.
// We'll talk about nested routes later.
const routes = [
  { path: '/', component: dashboard },
  { path: '/dashboard', component: dashboard },
  { path: '/referrals', component: referrals },
  { path: '/referrals/options', component: referrals_options },
  { path: '/income', component: my_income },
  { path: '/withdraw', component: withdraw },
  { path: '/settings', component: settings },
  { path: '/tree', component: tree },
  { path: '/support', component: support },
  { path: '/transactions', component: transactions }, // transactions
  { path: '/transactions/:page_no/:rows_per_page', name: 'transactionsPage', component: transactions }, // transactions route for pagination

  { path: '*', component: error }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes
  //mode: 'history' (removes the hashtag from url)
})
// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
/*
const app = new Vue({
  router
}).$mount('#app')
*/
// Now the app has started!

export default router
