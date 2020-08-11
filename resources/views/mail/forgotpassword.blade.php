<h3>Hey {{ $user->name }}</h3>
<p>We received your request to reset your password. Just click on the link to continue</p>
<p>
    <a href="{{ $link }}">{{ $link }}</a>
</p>