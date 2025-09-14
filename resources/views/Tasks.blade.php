<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
p
    <x-sidebar/>
    <div class="main-content">


    </div>

    
</body>
</html>

<style>
    /* Main Content */
.main-content { margin-left:200px; padding:80px 20px 20px 20px; }
h1 { font-size:1.8rem; margin-bottom:20px; color:#6C63FF; display:flex; align-items:center; gap:10px; }
h1 i { color:#00C9A7; }

@media(max-width:768px) { .main-content { margin-left:0; padding:100px 10px 20px 10px; } .sidebar { width:55px; } .sidebar h2 { display:none; } .sidebar a span { display:none; } .top-header { left:55px; } }

</style>