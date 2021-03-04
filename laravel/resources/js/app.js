require('./bootstrap');

window.Vue = require('vue');

//components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('index-component', require('./components/index.vue').default);
Vue.component('mypage-component', require('./components/mypage.vue').default);

new Vue({
    el: '#app',
})
