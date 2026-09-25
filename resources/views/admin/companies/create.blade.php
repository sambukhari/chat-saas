@extends('layouts.neon', ['title' => 'Create Company'])

@section('content')

<h4 class="mb-4">Create Company</h4>

<div class="card-eze p-4">
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Fix the errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form method="POST" class="company_form" action="{{ route('admin.companies.store') }}">
    @csrf

    <div class="row g-3">
        <div class="col-md-6">
            <input name="name" class="comp_name" placeholder="Company Name" required>
        </div>

        <div class="col-md-6">
            <input name="email" type="email" class="comp_email" placeholder="Email" required>
        </div>

        <div class="col-md-6">
            <input name="password" type="password" class="comp_passw" placeholder="Password" required>
        </div>

        <div class="col-md-6">
            <select name="plan" class="form_select">
                <option value="free">Free</option>
                <option value="pro">Pro</option>
                <option value="enterprise">Enterprise</option>
            </select>
        </div>
    </div>

    <button class="btn-brand mt-4">Create</button>
</form>
</div>

@endsection