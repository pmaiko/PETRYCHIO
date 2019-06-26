import Vue from 'vue'
import App from './App.vue'

import router from './router'
import store from './store'

// import BootstrapVue from 'bootstrap-vue'
// Vue.use(BootstrapVue);

import VueCookie from 'vue-cookie'
Vue.use(VueCookie);


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.js'

//import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'slick-carousel/slick/slick.css'
import './sass/app.scss'
import './libs/font-awesome/css/font-awesome.min.css'

window.axios = require('axios');
//window.axios.defaults.headers.common['Authorization'] = 'Bearer null';
store.dispatch('checkLogged');
new Vue({
    render: h => h(App),
    router,
    store,

}).$mount('#app')
