 
    @foreach ($blogs as $blog)
    <h2>{{ $blog->title }}</h2>
    <ul class="submenu-list">
        @foreach ($blog->comments as $submenu)
            <li>{{ $submenu->content }}</li>
        @endforeach
    </ul>
@endforeach