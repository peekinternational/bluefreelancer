/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 import VueSocketio from 'vue-socket.io';
 import socketio from 'socket.io-client';
 
 window.Vue = require('vue').default;
 window.Vue.prototype.$socket = socketio.connect('https://peekvideochat.com:22000');
 // window.Vue.use(VueSocketio,socketio('https://peekvideochat.com:22000'));
 Vue.use(new VueSocketio({
     debug: true,
     connection: 'https://peekvideochat.com:22000',
 }))
 window.axios = require('axios');
 window.axios.defaults.baseURL = 'http://localhost:8000/';
//  window.axios.defaults.baseURL = 'https://www.engezli.com/';
 Vue.config.productionTip = false;
 Vue.prototype.$hostname = 'http://localhost:8000/';
//  Vue.prototype.$hostname = 'https://www.engezli.com/';

 Vue.component('messages', require('./components/ExampleComponent.vue').default);
 
 const app = new Vue({
     el: '#app',
 });