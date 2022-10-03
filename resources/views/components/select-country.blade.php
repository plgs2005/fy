<label class="col-md-4 col-form-label text-md-right" for="location">Countries:</label>
<div class="col-md-6">
    <select class="custom-select @error('location') is-invalid @enderror"  name="location[]" id="location" required multiple size=8 >
        @foreach ($countries['data'] as $item)
            <option value=" {{$item['Iso2']}} "> {{$item['name']}} </option>
        @endforeach
    </select> 

    @error('location')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>