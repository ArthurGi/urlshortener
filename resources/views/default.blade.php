<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>UrlShortener</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"/>
</head>
<body>

<div class="container">
    <h1>UrlShortener</h1>

    <div class="card">
        <div class="card-header">
            <form method="POST" action="{{ route('save.link') }}">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                    <input type="text" name="url" class="form-control" placeholder="Enter URL"
                           aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Generate Shorten Link</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <p>{{ $error }}</p>
                </div>
            @endforeach
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th>Url</th>
                    <th>Alias</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shortLinks as $row)
                    <tr>
                        <td>{{ $row->url }}</td>
                        <td><a href="{{ route('shorten.link', $row->alias) }}"
                               target="_blank">{{ route('shorten.link', $row->alias) }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>