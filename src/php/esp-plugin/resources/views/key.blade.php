<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/site.css"/>
</head>
<body>
<header>
    <x-header />
</header>
<div class="container">
    <main role="main" class="pb-3">

        <div class="text-center">
            <span>AuthnKey JWT Claims (What is a JWT Claims? <a href="https://datatracker.ietf.org/doc/html/rfc7519#section-4.1">Learn more</a>)</span>
            @foreach ($authnKeyProps as $k=>$v)
            <div class="row">
                <div class="col-6">{{$k}}</div>
                <div class="col-6">{{$v}}</div>
            </div>
            @endforeach

            <a class="btn btn-primary" href="{{$loginUrl}}">Login with Spid</a>

        </div>

    </main>
</div>

<footer class="border-top footer text-muted">
    <div class="container">
        &copy; 2022 - ESP <a class="navbar-brand" href="https://namirialgroup.github.io/esp-docs/">Check the latest Documentation.</a>
    </div>
</footer>

<script src="lib/jquery/dist/jquery.min.js"></script>
<script src="lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/site.js"></script>

</body>
</html>
