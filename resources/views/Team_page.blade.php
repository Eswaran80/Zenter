<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teams</title>
</head>
<body>
    <x-sidebar/>
    <div class="main-content">
       <h1>team page</h1>
    </div>

    
</body>
</html>

<style>

     .main-content { margin-left:200px; padding:80px 20px 20px 20px; }
    @media(max-width:768px) {
      .main-content { margin-left:0; padding:100px 10px 20px 10px; }
    }
</style>
<script>
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            // Force reload if coming from back/forward cache
            window.location.reload();
        }
    });
</script>