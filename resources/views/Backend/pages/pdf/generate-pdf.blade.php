<!DOCTYPE html>
<html>
<head>
    <title>Books List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Books List</h1>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Cover</th>
                </tr>
            </thead>
            <tbody>
                @foreach($book as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ \Illuminate\Support\Str::words($book->description, 10, '...') }}</td>
                    <td>{{ $book->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
