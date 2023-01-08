<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYPETT</title>
    <link rel="shortcut icon" type="image" href="./image/MYPETT.jpg"> 
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="{{asset('css/home.css') }}">
    <!-- bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Uchen&display=swap" rel="stylesheet">
    <!-- fonts links -->
    <!-- icons links -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- icons links -->
</head>
<body>
  
    <div class="all-content">
    
        <!-- navbar -->
 
        <nav class="navbar navbar-expand-md sticky-top" id="navbar">
        <a href="#" class="logohome"><img src="{{ asset('img/mypet.png') }}" style="width: 114px; height: 114px;" alt=""></a>
            <!-- Brand -->
            <!-- <a class="navbar-brand" href="#" id="logo"><img src="./image/MYPETT.jpg" alt="" width="40px">&nbspMYPETT</a> -->
          
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span><img src="{{ asset('img/menu.png') }}" alt="" width="30px"></span>
            </button>
          
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">Home</a>
                </li>
                <!-- dropdown -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                     Service
                    </a>
                    <div class="dropdown-menu">
                        <a  href="#" onclick="location.href='{{ url('/member')}}'" class="dropdown-item">package</a> 
                        <a href="#" class="dropdown-item"></a>

                    </div>
                </li>
                <!-- dropdown -->
                <li class="nav-item">
                  <a class="nav-link" href="#">Privillage</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>
            </div>
            <div class="icons">
                <img  onclick="location.href='{{ url('/login')}}'" src="{{ asset('img/user.png') }}" alt="" width="20px">
                <img src="{{ asset('img/heart.png') }}" alt="" width="20px">
                <img src="{{ asset('img/add.png') }}" alt="" width="24px">
                <!--     -->
            </div>
          </nav>
        <!-- navbar end -->
      


        <!-- home section -->
        <div class="home">
            <div class="content" data-aos="zoom-out-right">
                <h3>Use Our MYPETT <br> Insurance
                </h3>
                <h2><span class="changecontent"></span></h2>
                <p>Website For PET Insurance
                </p>
                <a href="#" class="btn">See Now</a>
            </div>
            <div class="img"  data-aos="zoom-out-left">
                <!-- <img src="{{ asset('img/MYPETT.') }}" alt=""> -->
            </div>
        </div>
        <!-- home section end -->

      <!-- footer -->
      <footer id="footer"    data-aos="fade-up"
      data-aos-duration="1500">
        <h1 class="text-center">MYPETT</h1>
        <p class="text-center">Website for PET Insurance.</p>
        <div class="icons text-center">
            <i  class="bx bxl-twitter"></i>
            <i class="bx bxl-facebook"></i>
            <i class="bx bxl-google"></i>
            <i class="bx bxl-skype"></i>
            <i class="bx bxl-instagram"></i>
        </div>
        <div class="copyright text-center">
            &copy; Copyright <strong>MYPETT</strong> .All Rights Reserved
        </div>
        <!-- <div class="credite text-center">
            Designed By <a href="#"><span>SA coding</span></a>
        </div> -->
      </footer>
      <!-- footer -->
      <a href="#" class="arrow"><i><img src="{{ asset('img/upp-arrow.png') }}" alt="" width="50px"></i></a>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
</body>
</html>