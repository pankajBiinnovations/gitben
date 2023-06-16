
    @foreach ($categories as $category)
       <h1> <optgroup label="{{ $category->name }}"></h1>
       <h3>Related SubCategory</h3>
            @foreach ($category->subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->content }}</option>
            @endforeach
        </optgroup>
        <h1>Total number of subcategory:-- {{$category->subcategories->count()}}</h1>
        {{$categories->links()}}
    @endforeach
