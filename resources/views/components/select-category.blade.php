<div class="form-group col-md-6">
    <label for="category_id">Category:</label>

    <select class="custom-select @error('category_id') is-invalid @enderror"  @if ($multiple) name="category_id[]" @else name="category_id" @endif  id="category_id" required @if ($multiple) multiple size=8 @endif>
        @if (!$multiple) <option value="">Select one category</option> @endif
        @foreach ($categories as $item)
            <option disabled>──────────</option>
            <option value="{{$item['id']}}" {{selectedCategory($selectedCategory, $item['id'])}} >{{$item['name']}}</option>

            @if (isset($item['childs']))
                @foreach ($item['childs'] as $item2)
                <option value="{{$item2['id']}}" {{selectedCategory($selectedCategory, $item2['id'])}}> - {{$item['name']}} - {{$item2['name']}}</option>
                
                @if (isset($item2['childs']))
                    @foreach ($item2['childs'] as $item3)
                        <option value="{{$item3['id']}}" {{selectedCategory($selectedCategory, $item3['id'])}}> - {{$item['name']}} - {{$item2['name']}} - {{$item3['name']}}</option>
                    @endforeach
                @endif

                @endforeach
            @endif

        @endforeach
    </select> 

    @error('category_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>