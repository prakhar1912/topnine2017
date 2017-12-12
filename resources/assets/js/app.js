
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

$('#logout').on('click',function(){
    $('.primary-container').append('<div style="display:none"><iframe src="https://instagram.com/accounts/logout"></iframe></div>');
    $.ajax({
        url: '/logout',
        type: 'POST',
        data:{
            username: window.username
        },
        beforeSend: function(){
            $('#logout').html("Loading...").css('pointer-events','none');
        }
    }).done(response => {
        if(response[0]&&response[1]){
            toastr.success('Logout successful. Redirecting....');
        } else{
            toastr.error('Something went wrong while trying to logout.');
        }
        setTimeout(function(){
            location.href="/";
        },2000);
    });
});