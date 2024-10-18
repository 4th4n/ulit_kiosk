<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk Ordering System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f0f4f8;
        }
        .navbar {
            background-color: #f0f4f8;
            padding: 0.5rem 1rem; /* Adjusted padding for taller navbar */
            height: 100%; /* Set a specific height for the navbar */
        }
        .navbar-brand {
            font-size: 1.5rem; /* Increased font size */
            font-weight: bold;
            color: #ffc107;
        }
        .nav-link {
            color: white !important;
            font-weight: bold;
            padding: 0.5rem 1rem; /* Increased padding for nav links */
            font-size: 1rem; /* Adjusted font size for nav links */
        }
        .nav-link:hover {
            color: #ffc107 !important;
        }
        .search-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }
        .search-input-group {
            display: flex;
            align-items: center;
            border-radius: 30px;
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.2rem 0.5rem; /* Adjusted padding for search bar */
            max-width: 400px; /* Adjust width for better fit */
            width: 100%;
            height: 40px; /* Set height for search bar */
        }
        .search-input-group input {
            border: none;
            outline: none;
            box-shadow: none;
            flex-grow: 1;
            font-size: 1rem; /* Font size for input */
            height: 100%; /* Make input take full height */
        }
        .search-input-group .icon-btn {
            background: none;
            border: none;
            color: #666;
            font-size: 1.2rem;
            height: 100%; /* Align icon button height with search bar */
        }
        .search-input-group .icon-btn:hover {
            color: #000;
        }
        .search-input-group .search-mic-btn {
            background-color: #f0f0f0;
            border-radius: 50%;
            padding: 6px; /* Smaller padding for icon button */
            margin-left: 10px;
            height: 100%; /* Align mic button height with search bar */
        }
        .custom-offcanvas-bg {
      background-color: black;
      color: white;
    }

    .custom-offcanvas-bg {
    background-color: black; /* Set background color to black */
    color: white; /* Set text color to white */
}

.custom-offcanvas .nav-link {
    color: white !important; /* White text color for links */
    font-weight: bold;
}

.custom-offcanvas .nav-link:hover {
    color: #cccccc !important; /* Lighter color on hover */
}

.custom-offcanvas .nav-link.active {
    color: #ffcc00 !important; /* Yellow color for active link */
}
    /* Custom style for black navbar-toggler-icon */
.navbar-dark .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(0, 0, 0, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

    </style>
</head>
<body>
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Search Bar in the Center -->
            <div class="search-container">
                <form class="search-input-group" action="{{ url('/search') }}" method="GET">
                    <input class="form-control" type="search" name="query" placeholder="Search" aria-label="Search">
                    <button type="submit" class="icon-btn">
                        <i class="bi bi-search"></i>
                    </button>
                    <button type="button" class="icon-btn search-mic-btn">
                        <i class="bi bi-mic"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
   
    <div class="offcanvas offcanvas-start custom-offcanvas custom-offcanvas-bg" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
          <!-- Navigation Links -->
          <ul class="nav flex-column">
              <li class="nav-item">
                  <a class="nav-link active" href="{{ url('/') }}">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('orders.view') }}">Orders History</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('items.create') }}">Add Item</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('items.index') }}">Remove Item</a>
              </li>
          </ul>
      </div>
  </div>
    <!-- Main Content -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">&copy; {{ date('Y') }} Kiosk Ordering System</span>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
