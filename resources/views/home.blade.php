@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" id="card-header"><span>{{ __('Dashboard') }}</span><a
                        href="{{ route('create') }}" class="float-right btn btn-info">Add new vehicle</a></div>
                <div class="card-body table-responsive-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Plate Number</th>
                                <th scope="col">Insurance Date</th>
                                <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody class="table-body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        
        let headers = {
            "Accept": 'application/json',
            'Authorization': 'Bearer {{ Auth::user()->api_token }}'
        }
    
        $.ajax({
            url: '/api/vehicles',
            headers: headers,
            method: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }  
        }).done(function(data){
            data.vehicles.forEach(vehicle => {
                var registerUrl = "";
                let url = "{{ route('edit', 'id') }}";
                url = url.replace('id', vehicle.id);
                $('.table-body').append(
                    '<tr id="tRow-'+ vehicle.id +'"><td>' + vehicle.brand + '</td><td>'
                    + vehicle.model + '</td><td>'
                    + vehicle.plate_number + '</td><td id="tData-'+ vehicle.id +'">'
                    + vehicle.insurance_date + 
                    '</td><td><a href="'+registerUrl+
                    '" class="btn btn-info registerVehicleBtn" data-id="'+vehicle.id+'">Register</a><a href="'+url+
                    '" class="btn btn-success ml-2">Edit</a><button class="btn btn-danger ml-2 deleteVehicleBtn" data-id="'+vehicle.id+'">Delete</button></td></tr>')
            });
        });            
    

    $(document).on('click', '.deleteVehicleBtn', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let tableRow = 'tRow-'+ id;
        let headers = {
            "Accept": 'application/json',
            'Authorization': 'Bearer {{ Auth::user()->api_token }}'
        }

        $.ajax({
        url: '/api/vehicles/delete',
        method: 'DELETE',
        headers: headers,
        data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content'),
                }
                }).done(function(data) {
                    document.getElementById(tableRow).remove();
                return 'success';
            });
        });

    $(document).on('click', '.registerVehicleBtn', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let tableData = 'tData-'+ id;
        registerUrl = "{{ route('register', 'id') }}";
        url = registerUrl.replace('id', id);
        let newDate = "{{ date('Y-m-d', strtotime('+1 year')) }}";
        let headers = {
            "Accept": 'application/json',
            'Authorization': 'Bearer {{ Auth::user()->api_token }}'
        };

        $.ajax({
        url: '/api/vehicles/register',
        method: 'PUT',
        headers: headers,
        data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content'),
            insurance_date: newDate,
        }
    }).done(function(data) {
        document.getElementById(tableData).innerHTML = newDate;
        return 'success';
    });
    });

});
            
</script>
@endsection