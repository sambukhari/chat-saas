<h2>Hello {{ $agent->name }}</h2>

<p>Your account has been created.</p>

<p><strong>Email:</strong> {{ $agent->email }}</p>
<p><strong>Password:</strong> {{ $plainPassword }}</p>

<p>
    <a href="{{ url('/agent/login') }}">Click here to login</a>
</p>

<p>Thank you.</p>