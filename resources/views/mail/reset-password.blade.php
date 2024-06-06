<!-- resources/views/emails/reset-password.blade.php -->
<html>
<p> Hi {{$user->userName }},</p>
<br />
<p>You recently requested to reset the password for your {{ $host }} account. Click the button below to proceed.</p>
<br />
<a href="{{ $resetLink }}">reset password</a>
<br />
<p>If you did not request a password reset, please ignore this email or reply to let us know. This password reset link is only valid for the next 30 minutes.</p>
<br />
<p>Thanks,</p>
<p>MEO SHOES</p>

</html>