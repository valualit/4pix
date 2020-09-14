require('./bootstrap');
window.Vue = require('vue');
import router from './routes-admin' 

const app = new Vue({
    el: '#app',
	router: router
}); 
