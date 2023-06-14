@foreach ($blogs as $blog) 

<br/>
 {{$blog->title}}  (Title )
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

     {{ $blogs->links() }}

     <style>
        .w-5 {
  width: 10px;
  height: 10px;
}
        </style>