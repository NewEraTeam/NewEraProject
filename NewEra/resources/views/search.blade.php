<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
</head>
<body>
    <h1>Search for User</h1>

    <form action="{{ route('search.result') }}" method="POST">
        @csrf
        <label for="name">Enter Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <button type="submit">Search</button>
    </form>

    @if(isset($users))
        <h2>Search Results:</h2>
        @if($users->isEmpty())
            <p>No users found.</p>
        @else
            <ul>
                @foreach($users as $user)
                    <li>{{ $user->name }} - {{ $user->email }}</li>
                @endforeach
            </ul>
        @endif
    @endif

    <br>
    <a href="{{ route('form.page') }}">Go to Form Page</a>
</body>
</html>
