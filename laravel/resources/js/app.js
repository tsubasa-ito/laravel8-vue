require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

Vue.use(Vuetify);

//components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('index-component', require('./components/index.vue').default);
Vue.component('mypage-component', require('./components/mypage.vue').default);

new Vue({
    el: '#app',
    vuetify: new Vuetify({
        iconfont: 'mdi',
    })
})
