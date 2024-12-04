<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMS Registration </title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Importing Google Fonts - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }
    .container {
      max-width: 700px;
      width: 100%;
      background-color: #fff;
      padding: 25px 30px;
      border-radius: 5px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }
    .container .title {
      font-size: 25px;
      font-weight: 500;
      position: relative;
    }
    .container .title::before {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 30px;
      border-radius: 5px;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }
    .content form .user-details {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin: 20px 0 12px 0;
    }
    form .user-details .input-box {
      margin-bottom: 15px;
      width: calc(100% / 2 - 20px);
    }
    form .input-box span.details {
      display: block;
      font-weight: 500;
      margin-bottom: 5px;
    }
    .user-details .input-box input,
    .user-details .input-box select {
      height: 45px;
      width: 100%;
      outline: none;
      font-size: 16px;
      border-radius: 5px;
      padding-left: 15px;
      border: 1px solid #ccc;
      border-bottom-width: 2px;
      transition: all 0.3s ease;
    }
    .user-details .input-box input:focus,
    .user-details .input-box input:valid,
    .user-details .input-box select:focus,
    .user-details .input-box select:valid {
      border-color: #9b59b6;
    }
    .user-details .input-box select {
      appearance: none;
      background-color: #f9f9f9;
      padding-right: 30px;
      position: relative;
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-chevron-down" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg>');
      background-position: right 10px center;
      background-repeat: no-repeat;
    }
    form .button {
      height: 45px;
      margin: 35px 0;
    }
    form .button input {
      height: 100%;
      width: 100%;
      border-radius: 5px;
      border: none;
      color: #fff;
      font-size: 18px;
      font-weight: 500;
      letter-spacing: 1px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }
    form .button input:hover {
      background: linear-gradient(-135deg, #71b7e6, #9b59b6);
    }
    .alert {
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 5px;
}

.alert-danger {
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}

.alert-success {
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}
    @media (min-width: 1024px) {
  .body_form {
    margin-top: 450px; /* Adjust this value to move the form below the header */
    display: flex;
    justify-content: center;
    align-items: center;
    
  }
}

/* Style for smaller screens (mobiles and tablets) */
@media (max-width: 1023px) {
  .body_form {
    margin-top: 20px; /* Minimal margin for smaller devices */
    padding: 10px;
    display: block; /* Ensures no centering issues on small screens */
  }
}
    /* Responsive media query code for mobile devices */
    @media(max-width: 584px) {
      .container {
        max-width: 100%;
      }
      form .user-details .input-box {
        margin-bottom: 15px;
        width: 100%;
      }
      form .category {
        width: 100%;
      }
      .content form .user-details {
        max-height: 300px;
        overflow-y: scroll;
      }
      .user-details::-webkit-scrollbar {
        width: 5px;
      }
    }
  </style>
  
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-softy-pinko.css') }}">
</head>

<body>
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="#" class="logo" style="margin-top:5px">
                        <img src="{{ Storage::url($app_logo) }}" alt="Inventory Management" style="width: 150px; height: auto;" />
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="{{ url('/') }}#welcome">Home</a></li>
                      <li><a href="{{ url('/') }}#features">About</a></li>
                      <li><a href="{{ url('/') }}#work-process">Work Process</a></li>
                      <li><a href="{{ url('/') }}#testimonials">Testimonials</a></li>
                      <li><a href="{{ url('/') }}#pricing-plans">Pricing Tables</a></li>
                      {{-- <li><a href="{{ url('/') }}#blog">Blog Entries</a></li> --}}
                      <li><a href="{{ url('/') }}#contact-us">Contact Us</a></li>
                        <li><a href="{{ asset('/login') }}">Sign In</a></li>
                        <li><a href="{{ asset('/customer_signup') }}" class="active">Sign Up</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <section class="body_form">
    <div class="container mt-4">
      <!-- Title section -->
      <div class="title">IMS Signup</div>
      <div class="content">
        <!-- Messages for validation errors and success -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
  
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
  
        <!-- Registration form -->
        <form action="{{ route('customer.register') }}" method="POST">
          @csrf
          <div class="user-details">
            <div class="input-box">
              <span class="details">First Name</span>
              <input type="text" name="first_name" placeholder="Enter your first name" required value="{{ old('first_name') }}">
            </div>
            <div class="input-box">
              <span class="details">Last Name</span>
              <input type="text" name="last_name" placeholder="Enter your last name" required value="{{ old('last_name') }}">
            </div>
            <div class="input-box">
              <span class="details">Username</span>
              <input type="text" name="username" placeholder="Enter your username" required value="{{ old('username') }}">
            </div>
            <div class="input-box">
              <span class="details">Email</span>
              <input type="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
            </div>
            <div class="input-box">
              <span class="details">Phone Number</span>
              <input type="text" name="phone" placeholder="Enter your phone number" required value="{{ old('phone') }}">
            </div>
            <div class="input-box">
              <span class="details">Password</span>
              <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="input-box">
              <span class="details">Confirm Password</span>
              <input type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <div class="input-box">
              <span class="details">Subscription Type</span>
              <select name="subscription_type" required>
                <option value="standard" {{ old('subscription_type') == 'standard' ? 'selected' : '' }}>Standard</option>
                <option value="premium" {{ old('subscription_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                <option value="advance" {{ old('subscription_type') == 'advance' ? 'selected' : '' }}>Advance</option>
              </select>
            </div>
            <div class="input-box">
              <span class="details">Company Name</span>
              <input type="text" name="company_name" placeholder="Enter your company name" required value="{{ old('company_name') }}">
            </div>
            <div class="input-box">
              <span class="details">Company Location</span>
              <input type="text" name="company_location" placeholder="Enter your company location" required value="{{ old('company_location') }}">
            </div>
            <div class="input-box">
              <span class="details">Company Phone Number</span>
              <input type="text" name="company_phone" placeholder="Enter your company phone number" required value="{{ old('company_phone') }}">
            </div>
          </div>
          <!-- Submit button -->
          <div class="button">
            <input type="submit" value="Register">
          </div>
        </form>
        
      </div>
    </div>
  </section>
  
</body>
</html>