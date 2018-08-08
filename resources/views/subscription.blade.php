<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{!! csrf_token() !!}" />
        <title>Laravel</title>

        <!-- Load Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="container">
        <!-- Content here -->
        <form name="subscription-form">
            <div class="form-group">
                <label for="user-name">Name</label>
                <input type="text" class="form-control" id="user-name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="user-email">Email address</label>
                <input type="email" class="form-control" id="user-email" aria-describedby="emailHelp" placeholder="Enter email">
                {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Success. Please check your email for confirmation
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="{{asset('js/subscription.js')}}"></script>
    </body>
</html>
