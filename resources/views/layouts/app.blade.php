<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row min-vh-100">

        <!-- Sidebar -->
        @auth
        <div class="col-md-2 bg-dark text-white p-3">
            <h5 class="mb-4">{{ auth()->user()->name }}</h5>

            <ul class="nav flex-column">
                

                {{-- Super Admin --}}
                @role('super_admin')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
                            Manage Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.companies.index') }}">
                            Companies
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.roles.index') }}">
                            Roles & Permissions
                        </a>
                    </li>
                @endrole


                {{-- Company Admin --}}
                @role('company_admin')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('agent.dashboard') }}">
                            Chat Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('app.users.index') }}">
                            Manage Agents
                        </a>
                    </li>
                @endrole


                {{-- Agent --}}
                @role('agent')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('agent.dashboard') }}">
                            Chat Dashboard
                        </a>
                    </li>
                @endrole


                <hr class="bg-light">

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('profile.edit') }}">
                        Profile
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-link nav-link text-white">
                            Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>
        @endauth

        <!-- Main Content -->
        <div class="@auth col-md-10 @else col-md-12 @endauth p-4">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>