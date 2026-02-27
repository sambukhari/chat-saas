@extends('layouts.neon', ['title' => 'Agent Login'])

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="neon-card p-4 p-md-5 neon-glow">
            <h2 class="neon-title mb-1">Agent Console</h2>
            <p class="text-muted-neon mb-4">Support agent login</p>

            <form method="POST" action="{{ route('agent.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="agent@email.com" required>
                    @error('email') <div class="small text-danger mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button class="btn btn-neon w-100 py-2">Login</button>
            </form>
            <div class="login-switch mt-4 text-center">

                <div class="mb-2 text-muted-neon small">
                    Switch Portal
                </div>
            
                <div class="d-flex justify-content-center gap-2 flex-wrap">
            
                    <a href="{{ route('admin.login') }}"
                       class="btn btn-neon-outline btn-sm">
                        Admin Login
                    </a>
            
                    <a href="{{ route('company.login') }}"
                       class="btn btn-neon-outline btn-sm">
                        Company Login
                    </a>
            
                   
            
                </div>
            
            </div>
        </div>
        <div class="text-center mt-3 small text-muted-neon">
             Ezead Support Chat System • Admin Guard
        </div>
    </div>
</div>
@endsection