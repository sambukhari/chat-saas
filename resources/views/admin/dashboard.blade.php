@extends('layouts.app')

@section('content')
<h2>Super Admin Dashboard</h2>

<div class="row mt-4">

    <div class="col-md-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h5>Total Companies</h5>
                <h3>{{ \App\Models\Company::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5>Total Users</h5>
                <h3>{{ \App\Models\User::count() }}</h3>
            </div>
        </div>
    </div>

</div>
@endsection