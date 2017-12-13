<template>
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 display">
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
            <a :href="facebookLink" class="btn btn-primary button" target="_blank"><i class="fa fa-facebook"></i>&nbsp;Share</a>
            <a :href="twitterLink" class="btn btn-primary button" target="_blank"><i class="fa fa-twitter"></i>&nbsp;Tweet</a>
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
                    window.imagename = response;
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
        },
        computed:{
            facebookLink(){
                return "http://www.facebook.com/sharer.php?u=http://45.55.139.230/"+this.source;
            },
            twitterLink(){
                return "#";
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
        width: 75%;
    }
    .generated-image span{
        color: #4c82f2;
        font-style: italic;
        cursor: pointer;
    }
</style>
