
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window.$ = window.jQuery = require('jquery');
import LiquorTree from 'liquor-tree';

Vue.use(LiquorTree);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component',  require('./components/ExampleComponent.vue'));
Vue.component('arvore',             require('./components/TreeComponent.vue'));
Vue.component('loading',            require('./components/ScreenService/Loading.vue'));
Vue.component('rastreador',         require('./components/RastreadorComponent.vue'));

Vue.component(LiquorTree.name, LiquorTree);

const app = new Vue({
    el: '#app'
});
