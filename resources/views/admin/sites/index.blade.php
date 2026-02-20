@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Sites for {{ $company->name }}</h2>

        <a href="{{ route('admin.sites.create', $company) }}" class="btn btn-dark">
            + Add Site
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">

            <table class="table table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Domain</th>
                        <th>Widget Key</th>
                        <th>Status</th>
                        <th>Embed Script</th>
                    </tr>
                </thead>
                <tbody>

                @forelse($sites as $site)
                    <tr>
                        <td>{{ $site->domain }}</td>

                        <td>
                            <small>{{ $site->widget_key }}</small>
                        </td>

                        <td>
                            @if($site->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <textarea class="form-control" rows="3" readonly>
<script src="{{ url('/widget.js') }}" 
        data-key="{{ $site->widget_key }}">
</script>
                            </textarea>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-3">
                            No sites created yet.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection