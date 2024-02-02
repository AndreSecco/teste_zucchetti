import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import vSelect from "vue-select";

import VueSweetalert2 from "vue-sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';

// import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Vue.config.productionTip = false

Vue.use(VueSweetalert2);
Vue.component("v-select", vSelect);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
