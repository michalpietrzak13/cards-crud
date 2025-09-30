<form method="POST" action="/login">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div><input name="email" type="email" placeholder="email@example.com" /></div>
  <div><input name="password" type="password" placeholder="password" /></div>
  <button type="submit">Login</button>
</form>
