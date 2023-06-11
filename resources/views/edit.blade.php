<select name="id" id="id" required>
        @foreach ($item as $category)
        <option value="{{ $category->id }}" {{ $category->id == old('id') ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>