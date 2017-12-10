<template>
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
        <button class="btn btn-primary btn-block button" id="trigger" @click="getImage">Click here to get your top nine posts of 2017!</button>
        <div v-show="visible" class="generated-image">
            <img :src="source"/>
            <br>
            <br>
            <span @click="originalImage()">Original Version</span>
            <span @click="photoVersion()">Photo Version</span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                visible: false,
                name: '',
                source: ''
            }
        },
        methods: {
            getImage: function(){
                $.ajax({
                    url: '/generate/image',
                    type: 'POST',
                    data:{
                        username: window.username,
                        profile_picture: window.profilePicture,
                        posts: window.posts,
                        likes: window.likes,
                        top_nine: window.topNine 
                    },
                    beforeSend: function(){
                        $('#trigger').html("Loading...").css('pointer-events','none');
                    }
                }).done(response => {
                    $('#trigger').slideUp();
                    this.name = response;
                    this.source = 'images/'+response+'_original.jpeg';
                    this.visible = true;
                });
            },
            originalImage: function(){
                this.source = 'images/'+this.name+'_original.jpeg';
            },
            photoVersion: function(){
                this.source = 'images/'+this.name+'_photo.jpeg';
            }
        }
    }
</script>

<style>
    .generated-image img{
        display: block;
        max-width: 100%;
        border: 1px solid black;
    }
    .generated-image span{
        text-decoration: underline;
        cursor: pointer;
    }
</style>
