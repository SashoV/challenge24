@extends('layouts.app')
@section('content')
<div class="container">
    @if ($errors->any())
    <div class="row justify-content-center">
        <div class="alert alert-danger col-md-6" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <form action="" method="POST" class="col-md-6 createForm" id="createForm">
            @csrf
            <div class="form-group @error('brand') has-error @enderror">
                <label class="control-label" for="brand">Brand</label>
                <input type="text" class="form-control" name="brand" id="brand" value="{{ old('brand') }}"
                    placeholder="Brand" required>
            </div>
            <div class="form-group @error('model') has-error @enderror">
                <label class="control-label" for="model">Model</label>
                <input type="text" class="form-control" name="model" id="model" value="{{ old('model') }}"
                    placeholder="Model" required>
            </div>
            <div class="form-group @error('plate_number') has-error @enderror">
                <label class="control-label" for="plate_number">Plate Numebr</label>
                <input type="text" class="form-control" name="plate_number" id="plate_number"
                    value="{{ old('plate_number') }}" placeholder="Plate Number" required>
            </div>
            <div class="form-group @error('insurance_date') has-error @enderror">
                <label class="control-label" for="insurance_date">Insurance Date</label>
                <input type="date" class="form-control" name="insurance_date" id="insurance_date"
                    value="{{ old('plate_number') }}" placeholder="Insurance Date" required>
            </div>
            <input class="btn btn-info" type="submit" id="createVehicleBtn" value="Create">
            <a href="{{ route('home') }}" class="btn btn-info">Cancel</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).on('submit', '#createForm', function(e){
        e.preventDefault();

        let headers = {
            "Accept": 'application/json',
            'Authorization': 'Bearer {{ Auth::user()->api_token }}'
        }
        
        $.ajax({
            url: '/api/vehicles/store',
            headers: headers,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                brand: $('#brand').val(),
                model: $('#model').val(),
                plate_number: $('#plate_number').val(),
                insurance_date: $('#insurance_date').val(),
            },  
        }).done(function(data){ 
            window.location = '/';
        })
    });

</script>
@endsection