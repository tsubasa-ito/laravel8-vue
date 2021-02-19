require('./bootstrap');

window.Vue = require('vue');

//components
import Index from './components/index.vue';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('index-component', require('./components/index.vue').default);

new Vue({
    el: '#app',
    router: router
})
