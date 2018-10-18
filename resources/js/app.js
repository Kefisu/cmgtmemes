
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    created() {
        this.fetchData();
    },
    data: {
        tags: []
    },
    methods: {
        fetchData() {
            console.log('Fetching data..');
            axios.get('/tags/get').then(response => {
                this.tags = response.data;
            });
        },
        addTag() {
            var token = document.head.querySelector('meta[name="csrf-token"]');

            console.log('Adding tag..');
            axios.post('/tag/store', {
                
            }).then(response => {
                this.fetchData()
            })
        }
    }

});
