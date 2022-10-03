<label class="col-md-4 col-form-label text-md-right" for="language">Languages:</label>
<div class="col-md-6">
    {{-- @php
       dump($languages);die;
    @endphp --}}
    <select class="custom-select @error('language') is-invalid @enderror"  name="language[]" id="language" required multiple size=8 >
        @foreach ($languages as $item)
            <option value=" {{$item->code}} "> {{$item->name}} </option>
        @endforeach
    </select> 

    @error('language')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>