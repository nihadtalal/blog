

require('./bootstrap');




import Vue from 'vue'
import VueRouter from 'vue-router'




import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);
// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});





Vue.use(VueRouter)

//Router Imported
import {routes} from './routes';


//Import User Class

import User from './Helpers/User';
window.User = User


//Import Notification Class

import Notification from './Helpers/Notification';
window.Notification = Notification


//Sweet Alert Start
import Swal from 'sweetalert2'
window.Swal = Swal;


 
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.Toast = Toast;

//Sweet Alert End


window.Reload = new Vue();


const router = new VueRouter({
    routes, 
    mode:'history'
  })




const app = new Vue({
    el: '#app',
    router,
    i18n,
});
