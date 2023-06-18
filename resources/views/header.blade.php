
    
    @foreach ($categories as $menu)
    <h2>{{ $menu->name }}</h2>
    <ul class="submenu-list">
        @foreach ($menu->subcategories as $submenu)
            <li>{{ $submenu->content }}</li>
        @endforeach
    </ul>
@endforeach

{{$categories->links()}}

<style>
    /* CSS */
ul.submenu-list {
    display: flex;
    list-style-type: none;
    padding: 0;
}

ul.submenu-list li {
    margin-right: 10px;
}

    </style>