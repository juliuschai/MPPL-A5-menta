/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueChatScroll from 'vue-chat-scroll';
import VueTimeago from 'vue-timeago';

Vue.use(VueChatScroll);
Vue.component('chat-room' , require('./components/laravel-video-chat/ChatRoom.vue').default);
Vue.component('group-chat-room', require('./components/laravel-video-chat/GroupChatRoom.vue').default);
Vue.component('video-section' , require('./components/laravel-video-chat/VideoSection.vue').default);
Vue.component('file-preview' , require('./components/laravel-video-chat/FilePreview.vue').default);

Vue.use(VueTimeago, {
    name: 'timeago', // component name, `timeago` by default
    locale: 'en',
    locales: {
        'en': require('date-fns/locale/en').default
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('therapist-list', require('./components/TherapistList.vue').default);
Vue.component('fee-form', require('./components/FeeForm.vue').default);
Vue.component('custom-channel', require('./components/CustomChannel.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
