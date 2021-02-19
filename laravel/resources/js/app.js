require('./bootstrap');

window.Vue = require('vue');

//components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

new Vue({
    el: '#app',
})
