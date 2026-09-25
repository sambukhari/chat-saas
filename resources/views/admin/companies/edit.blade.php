@extends('layouts.neon', ['title' => 'Edit Company'])

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Edit Company</h4>
        <div class="small-muted">Update tenant details and plan</div>
    </div>

    <a href="{{ route('admin.companies.index') }}" class="btn-ghost"><i class="fa-solid fa-chevron-left"></i> Back</a>
</div>

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

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card-eze p-4">

    {{-- UPDATE FORM --}}
    <form method="POST" class="company_form" action="{{ route('admin.companies.update', $company) }}">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <label class="form_label">Company Name</label>
                <input
                    name="name"
                    class="comp_name"
                    value="{{ old('name', $company->name) }}"
                    required
                >
            </div>

            <div class="col-12 col-md-6">
                <label class="form_label">Email</label>
                <input
                    name="email"
                    type="email"
                    class="comp_email"
                    value="{{ old('email', $company->email) }}"
                    required
                >
            </div>

            <div class="col-12 col-md-6">
                <label class="form_label">Plan</label>
                <select name="plan" class="form_select" required>
                    @php $plan = old('plan', $company->plan); @endphp
                    <option value="free" {{ $plan === 'free' ? 'selected' : '' }}>Free</option>
                    <option value="pro" {{ $plan === 'pro' ? 'selected' : '' }}>Pro</option>
                    <option value="enterprise" {{ $plan === 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                </select>
            </div>

            <div class="col-12 col-md-6 d-flex align-items-end">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_active"
                        id="is_active"
                        value="1"
                        {{ old('is_active', $company->is_active) ? 'checked' : '' }}
                    >
                    <label class="form_label" for="is_active">
                        Active
                    </label>
                    <div class="form_label">
                        Disable to block company login
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex gap-2 mt-4">
            <button class="btn-brand" type="submit">
                Save Changes
            </button>
        </div>

    </form>
    {{-- END UPDATE FORM --}}

    {{-- DELETE FORM --}}
    <form method="POST"
          action="{{ route('admin.companies.destroy', $company) }}"
          onsubmit="return confirm('Are you sure you want to delete this company? This will delete agents/sites/conversations if cascade is enabled.')"
          class="mt-3">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger">
            Delete Company
        </button>
    </form>
    {{-- END DELETE FORM --}}

</div>

@endsection