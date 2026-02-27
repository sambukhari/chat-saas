@extends('layouts.neon', ['title' => 'Company Sites'])

@section('content')

<h3 class="neon-title mb-3">Sites</h3>

<a href="{{ route('company.sites.create') }}" class="btn btn-neon mb-3">
    + Add Site
</a>

<div class="neon-card p-3">
    <div class="table-responsive">
        <table class="table table-dark table-borderless align-middle">
            <thead>
                <tr>
                    <th>Domain</th>
                    <th>Widget Key</th>
                    <th>Install Script</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sites as $site)
                @php
                    $script = '<script src="https://chat.ezead.com/widget/ezead-chat.js" data-widget-key="'.$site->widget_key.'"></script>';
                @endphp
                <tr>
                    <td>{{ $site->domain }}</td>

                    <td>
                        <small>{{ $site->widget_key }}</small>
                    </td>

                    <td>
                        <div class="input-group input-group-sm">
                            <textarea cols="50" readonly id="script-{{ $site->id }}">{{ $script }}</textarea> 
                            <button class="btn btn-outline-info" style="margin-left: 5px" onclick="copyScript('script-{{ $site->id }}', this)">
                                Copy
                            </button>
                        </div>
                    </td>

                    <td>
                        <form method="POST"
                              action="{{ route('company.sites.destroy', $site) }}"
                              onsubmit="return confirm('Delete this site?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Copy Script JS --}}
<script>
function copyScript(inputId, btn) {
    const input = document.getElementById(inputId);
    input.select();
    input.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(input.value).then(() => {
        btn.innerText = "Copied!";
        btn.classList.remove('btn-outline-info');
        btn.classList.add('btn-success');

        setTimeout(() => {
            btn.innerText = "Copy";
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-info');
        }, 2000);
    });
}
</script>

@endsection