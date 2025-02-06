<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Laravel Candidate Testing')</title>
</head>
<body>

  <div style="display: flex; height: 100vh;">
    <!-- Sidebar -->
    <div style="width: 200px; background-color: #333; color: white; padding: 15px;">
      <ul style="list-style-type: none; padding: 0;">
        <li><a href="{{route('profile')}}" style="color: white; text-decoration: none;">Profile</a></li>
        <li><a href="{{route('authors.index')}}" style="color: white; text-decoration: none;">Author</a></li>
        <li><a href="{{route('books.index')}}" style="color: white; text-decoration: none;">Books</a></li>
        <li><a href="{{route('logout')}}" style="color: white; text-decoration: none;">Logout</a></li>
      </ul>
    </div>

    <!-- Main Content Section -->
    <div style="flex-grow: 1; padding: 15px;">
      
      <!-- Navbar -->
      <nav style="background-color: #f8f9fa; padding: 10px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span style="font-size: 24px;">Kalvin Project</span>
          <a href="{{route('logout')}}" style="color: #dc3545; text-decoration: none;">Logout</a>
        </div>
      </nav>

      <!-- Page Content -->
      <div style="padding: 20px;">
        @if(session('success'))
        <div style="color: green; padding: 10px; background-color: #d4edda; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div style="color: red; padding: 10px; background-color: #d4edda; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
        @endif

        

    <!-- Display Error Message -->
    @if($errors->any())
        <div style="color: red; padding: 10px; background-color: #f8d7da; margin-bottom: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @yield('content')
      </div>

    </div>
  </div>

</body>
</html>
