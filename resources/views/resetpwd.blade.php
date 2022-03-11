<h3>Halo, {{ $nama }} !</h3>

<p>Kamu telah melakukan permintaan reset password di Web {{ $website }}</p>
<p>Klik link reset password ini untuk melanjutkan : <a
    href="{{$link}}">Link Reset Password</a></p>
    {{-- <form id="pwd-form" action="{{ route('password.reset', ['token' => $token]) }}" method="POST" class="d-none">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{$token}}">
        <input type="hidden" name="id" value="{{$id}}">
    </form> --}}
