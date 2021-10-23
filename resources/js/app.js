import filters from './filters'
require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import router from "./router";
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
  })

  import Swal from 'sweetalert2'

  window.Swal = Swal;

 const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
  });

  window.Toast = Toast;

  Vue.component('pagination', require('laravel-vue-pagination'));

import Form from 'vform'
import {  HasError, AlertError } from 'vform/src/components/bootstrap4';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const app = new Vue({
    el: '#app',
    router,
});
