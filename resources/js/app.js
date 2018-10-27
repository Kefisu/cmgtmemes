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
            // Fetch all tags
            axios.get('/tags/get').then(response => {
                this.tags = response.data;
            });
        },
        addTag() {
            console.log('Adding tag..');
            var tag = document.getElementById('newtag');
            // Make ajax request
            axios.get('/tag/add/' + tag.value).then(response => {
                // Reload data
                this.fetchData();
                // Empty input
                tag.value = "";
            })
        },
    }

});

window.addEventListener("load", function(){
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
                "background": "#237afc"
            },
            "button": {
                "background": "#fff",
                "text": "#237afc"
            }
        },
        "position": "bottom-right",
        "content": {
            "href": "/privacy"
        }
    })});
