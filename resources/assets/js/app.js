import VueRouter from "vue-router";
import routes from "./routes";
import validator from "vue-validator";
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('bootstrap-material-design');
require('sweetalert');
Vue.use(validator);
Vue.use(VueRouter);
let router = new VueRouter({
    routes
});

Vue.component('profile', require('./components/auth/Profile.vue'));

Vue.http.interceptors.push(function (request, next) {
    request.headers.set('Authorization', 'Bearer ' + localStorage.getItem('jwt_token'));
    next((response) => {
        if (response.status == 401) {
            localStorage.removeItem('jwt_token');
            Vue.http.headers.common['Authorization'] = 'Bearer ' + '';
            window.location = "/#/login";
        }
    });
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

const app = new Vue({
    router
}).$mount('#app');
