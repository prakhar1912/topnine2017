<template>
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 display">
        <button class="btn btn-primary btn-block button" id="trigger" @click="getImage">Get Top Nine Posts!</button>
        <div v-show="visible" class="generated-image">
            <img :src="source"/>
            <br>
            <br>
            <span @click="originalImage()">Original Version</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span @click="photoVersion()">Photo Version</span>
        </div>
        <br>
        <br>
        <div v-show="visible">
            <div class="share-buttons">
                <a href="http://www.hopperhq.com/?utm_source=TopNine2017&amp;utm_medium=Sharebutton&amp;utm_campaign=Schedule%20to%20IG" class="btn btn-primary btn-block button" target="_blank"><i class="fa fa-instagram"></i>&nbsp;Schedule to Instagram</a>
                <br>
                <a href="https://www.facebook.com/sharer.php?u=http://topnine2017.com" class="btn btn-primary btn-block button" target="_blank"><i class="fa fa-facebook"></i>&nbsp;Share</a>
                <br>
                <a href="https://twitter.com/share?url=http://topnine2017.com&amp;text=Get%20your%20top%20nine%20Instagram%20posts%20for%202017%20at%20&amp;hashtags=TopNine2017" class="btn btn-primary btn-block button" target="_blank"><i class="fa fa-twitter"></i>&nbsp;Tweet</a>
            </div>
            <h3>Don't forget the official hashtag!</h3>
            <br>
            <br>
            <h1 style="color:#4c82f2;font-weight:bold">#TopNine2017</h1>
            <br>
            <br>
            <br>
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
                    this.source = 'images/insta/'+response+'_original.jpeg';
                    this.visible = true;
                });
            },
            originalImage: function(){
                this.source = 'images/insta/'+this.name+'_original.jpeg';
            },
            photoVersion: function(){
                this.source = 'images/insta/'+this.name+'_photo.jpeg';
            }
        }
    }
</script>

<style>
    .display{
        min-height: 720px;
    }
    .generated-image{
        text-align: center;
    }
    .generated-image img{
        display: inline-block;
        width: 100%;
    }
    .generated-image span{
        color: #4c82f2;
        font-style: italic;
        cursor: pointer;
    }
</style>
