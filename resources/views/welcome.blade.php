<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>URL Shortener - short.dev</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
    </script>
</head>
<body>
<div class="site-wrapper">

    <div class="site-wrapper-inner">

        <div class="main-container">

            <div class="inner cover">
                <span class="glyphicon glyphicon-link"></span>
                <h1>URL Shortener</h1>
                <h4>short.dev</h4>

                <div class="row">

                    <form id="url-form" class="col-lg-12">
                        <div class="input-group input-group-lg">
                            <input name="url" type="text" class="form-control" placeholder="Paste a link...">
                            <span class="input-group-btn">
                                <button class="btn btn-shorten" type="submit">SHORTEN</button>
                            </span>
                        </div>
                    </form>

                    <div class="col-lg-12">
                        <div id="link"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    const $link = $("#link")

    $('#url-form').on('submit', (e) => {
        e.preventDefault()
        const form = new FormData(e.target)
        axios.post("/api/shorten", form).then((response) => {
            $link.html(`<a class="result" href="${response.data}"> ${response.data}</a>`)
            $link.hide().fadeIn('slow')
        }).catch(error => {
            console.log(error.response.data)
            $link.html(`<h3 class="result"> ${error.response.data}</h3>`)
            $link.hide().fadeIn('slow')
        })
    })
</script>
<!-- Scripts -->
</body>
</html>

