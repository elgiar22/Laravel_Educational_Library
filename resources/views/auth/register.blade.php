<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:"Poppins",sans-serif;}
body{
display:flex;justify-content:center;align-items:center;
min-height:100vh;background:#f0f2f5;transition:0.5s;
}
body.dark{background:#1e1e2f;color:#ddd;}

.container{
width:400px;background:#fff;padding:40px;border-radius:15px;
box-shadow:0 0 25px rgba(0,0,0,0.15);transition:0.5s;
}
body.dark .container{background:#2c2c3c;}

.container h2{text-align:center;margin-bottom:20px;}

.logo{
text-align:center;margin-bottom:25px;
}
.logo img{
width:80px;height:80px;border-radius:50%;box-shadow:0 5px 15px rgba(0,0,0,0.2);
transition:0.3s;
}
.logo img:hover{transform:scale(1.1);box-shadow:0 8px 25px rgba(0,0,0,0.3);}
body.dark .logo img{box-shadow:0 5px 15px rgba(255,255,255,0.1);}
body.dark .logo img:hover{box-shadow:0 8px 25px rgba(255,255,255,0.2);}

.container input{
width:100%;padding:12px;margin:10px 0;border-radius:8px;
border:1px solid #ccc;font-size:14px;outline:none;
transition:0.3s;
}
body.dark .container input{background:#444;border:1px solid #666;color:#eee;}
.container input:focus{border-color:#4a74f5;box-shadow:0 0 5px #4a74f5;}

.container button{
width:100%;padding:12px;margin-top:15px;
border:none;border-radius:8px;cursor:pointer;
background:#4a74f5;color:#fff;font-weight:bold;transition:0.3s;
}
.container button:hover{background:#3456c5;}

.container a{display:block;text-align:center;margin-top:10px;color:#4a74f5;text-decoration:none;font-size:13px;}
.container a:hover{text-decoration:underline;}

.dark-toggle{
position:absolute;top:20px;right:20px;
padding:8px 15px;border-radius:20px;border:none;
background:#4a74f5;color:#fff;cursor:pointer;
transition:0.3s;font-size:14px;font-weight:bold;
}
.dark-toggle:hover{background:#3456c5;transform:scale(1.05);}
body.dark .dark-toggle{background:#ffbb33;color:#333;}
body.dark .dark-toggle:hover{background:#ffaa00;}

.error-msg {
  color: #ff4d4d;
  font-size: 13px;
  margin-top: -8px;
  margin-bottom: 8px;
  display: block;
}

body.dark .dark-toggle{background:#ffbb33;color:#333;}
</style>

</head>
<body>
<button class="dark-toggle" id="darkToggle">🌙 Dark</button>

<div class="container">
<div class="logo">
    <a href="{{route('home')}}">
        <img src="https://img.icons8.com/color/96/000000/book-shelf.png" alt="Logo" title="Go to Home">
    </a>
</div>
<h2>Register</h2>
<form action="{{route('register')}}" method="post">
    @csrf
<input type="text" placeholder="Username" name="name" value="{{ old('name') }}">
@error('name')
    <span class="error-msg">{{$message}}</span>
@enderror

<input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
@error('email')
    <span class="error-msg">{{$message}}</span>
@enderror

<input type="password" placeholder="Password" name="password">
@error('password')
    <span class="error-msg">{{$message}}</span>
@enderror
 
<input type="password" placeholder="Confirm Password" name="password_confirmation">
<button type="submit">Register</button>
</form>
<a href="{{route('loginForm')}}">Already have an account? Login</a>
</div>

<script>
const body = document.body;
const darkToggle = document.getElementById('darkToggle');
if (localStorage.getItem("theme") === "dark") {
  body.classList.add("dark");
  darkToggle.textContent = "☀ Light";
} else {
  darkToggle.textContent = "🌙 Dark";
}
darkToggle.addEventListener('click', () => {
  body.classList.toggle('dark');
  if (body.classList.contains('dark')) {
    localStorage.setItem("theme", "dark");
    darkToggle.textContent = "☀ Light";
  } else {
    localStorage.setItem("theme", "light");
    darkToggle.textContent = "🌙 Dark";
  }
});
</script>

</body>
</html>
