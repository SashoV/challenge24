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
        <form action="" method="PUT" class="col-md-6" id="editVehicleForm">
            @csrf
            @method('PUT')
            <div class="form-group @error('brand') has-error @enderror">
                <input type="hidden" value="{{ $vehicle->id }}" name="vehicle_id" id="vehicle_id">
                <label class="control-label" for="brand">Brand</label>
                <input type="text" class="form-control" name="brand" id="brand"
                    value="@if(old('brand') == '') {{ $vehicle->brand }} @else {{ old('brand') }} @endif"
                    placeholder="Brand">
            </div>
            <div class="form-group @error('model') has-error @enderror">
                <label class="control-label" for="model">Model</label>
                <input type="text" class="form-control" name="model" id="model"
                    value="@if(old('model') == '') {{ $vehicle->model }} @else {{ old('model') }} @endif"
                    placeholder="Model">
            </div>
            <div class="form-group @error('plate_number') has-error @enderror">
                <label class="control-label" for="plate_number">Plate Numebr</label>
                <input type="text" class="form-control" name="plate_number" id="plate_number"
                    value="@if(old('plate_number') == '') {{ $vehicle->plate_number }} @else {{ old('plate_number') }} @endif"
                    placeholder="Plate Number">
            </div>
            <div class="form-group @error('insurance_date') has-error @enderror">
                <label class="control-label" for="insurance_date">Insurance Date</label>
                <input type="text" class="form-control" name="insurance_date" id="insurance_date"
                    value="@if(old('insurance_date') == '') {{ $vehicle->insurance_date }} @else {{ old('insurance_date') }} @endif"
                    placeholder="YYYY-MM-DD">
            </div>
            <input class="btn btn-info" type="submit" id="editVehicleBtn" value="Save">
            <a href="{{ route('home') }}" class="btn btn-info">Cancel</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).on('submit', '#editVehicleForm', function(e){
        e.preventDefault();

        let headers = {
            'Accept': 'application/json',
            'Authorization': 'Bearer {{ Auth::user()->api_token }}',
        }
        let id = $('#vehicle_id').val();
        
        $.ajax({
            url: '/api/vehicles/update',
            headers: headers,
            method: 'PUT',
            data: {
                id: id,
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