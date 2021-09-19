import filters from './filters'
require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import router from "./router";

import Form from 'vform'
import {  HasError, AlertError } from 'vform/src/components/bootstrap4';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const app = new Vue({
    el: '#app',
    router,
});
