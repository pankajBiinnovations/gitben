@foreach ($blogs as $blog) 

<br/>
Title  {{$blog->title}}
            <br/>
        @php
            $comments = $blog->comments;
        @endphp
        
            @foreach ($comments as $comment) 
        
                {{$comment->content}} 
               

            @endforeach
            <br/>
            <br/>
     @endforeach 