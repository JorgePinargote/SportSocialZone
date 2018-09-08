@extends('layouts.app')
@section('content')
{{ $publicacion->texto }}
<h3>Comments:</h3>
<div style="margin-bottom:50px;">
    <textarea class="form-control" rows="3" name="body" placeholder="Leave a comment" v-model="commentBox"></textarea>
    <button class="btn btn-success" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
</div>
<div class="media" style="margin-top:20px;" v-for="comment in comments">
    <div class="media-left">
        <a href="#">
            <img class="media-object" src="http://placeimg.com/80/80" alt="..."/>
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">@{{ comment.username }} said...</h4>
        <p>@{{ comment.comentario }}</p>
        <span style="color: #aaa;">on @{{ comment.created_at }}</span>
    </div>
</div>
@endsection
@section('scripts')
<script>
        const app = new Vue({  
          el: '#app',
          data: {
            comments: {},
            commentBox: '',
            post: {!! $publicacion->toJson() !!},
            user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!}
          },
          mounted() {
            this.getComments();
            this.listen();
          },
          methods: {
            getComments() {
              axios.get('/auth/comment/'+this.post._id)
                    .then((response) => {
                      this.comments = response.data
                    })
                    .catch(function (error) {
                      console.log(error);
                    });
            },
            postComment() {
              axios.post('/auth/comment', {
                texto: this.commentBox,
                idpublicacion: this.post._id
              })
              .then((response) => {
                this.comments.unshift(response.data);
                //console.log(response);
                this.commentBox = '';
              })
              .catch((error) => {
                console.log(error);
              })
            }
            ,
            listen() {
              console.log(this.post.idnoticia);
              Echo.channel('publicacion.'+ this.post.idnoticia)
                  .listen('NewComment', (comment) => {
                    console.log(comment);
                    this.comments.unshift(comment);
                  })
            }
          }
        })
      </script>
@endsection
