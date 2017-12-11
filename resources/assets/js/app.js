
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$.ajaxSetup({
    headers:
    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

import ImageDisplay from './components/ImageDisplay.vue';
import MessageDisplay from './components/MessageDisplay.vue';

let app = new Vue({
    el: '#app',
    components: {ImageDisplay,MessageDisplay},
    data(){
    	return {
    		posts: window.posts
    	}
    },
    computed:{
    	imageDisplay(){
			return (posts>0)
		},
    	messageDisplay(){
    		return (posts==0)
    	}
    }
});

toastr.options = {
	'positionClass':'toast-bottom-left'
};