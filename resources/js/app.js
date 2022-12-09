import './bootstrap';

window.Vue = require('vue').default;

import Vue from 'vue'
import App from './app/App.vue'
import router from "./app/router";
import vuetify from './app/plugins/vuetify.js'


new Vue({
    router,
    vuetify,
    render: h => h(App),
}).$mount('#app')
