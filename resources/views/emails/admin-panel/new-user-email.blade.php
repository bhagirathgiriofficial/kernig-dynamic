Hello {{ $name }} <br/>
Welcome to {{ config('app.name') }} <br/>
Your account has been created successfully! <br/><br/>

<b>Email:</b> {{ $email }} <br/>
<b>Password:</b> {{ $password }} <br/>

Please click here to <a href="{{ url('/') }}"> login. </a>