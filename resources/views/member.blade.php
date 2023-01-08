<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="{{asset('css/member.css') }}">
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
    


</body>
</html><div class="container-fluid pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 text-center mb-5">
                    <small class="d-inline bg-warning text-white text-uppercase font-weight-bold px-1">Our Pricing Plan</small>
                    <h1 class="mt-2 mb-3">We Offer Our Insurance Member Packages</h1>
                    {{-- <h4 class="font-weight-normal text-muted mb-4">We also open payments other than Dollars, You Can Request Payments with Contact Us With E-mail</h4>
                    <h5 class="font-weight-bold mb-4">Need A Custom Package?</h5> --}}
                    <a href="" class="btn btn-success py-md-2 px-md-4 font-weight-semi-bold">Contact Now</a>
                </div>
            </div>
            <div class="row">
           
                <div class="col-md-4 mb-5">
                <div class="warna-silver">
                    <div class="d-flex flex-column align-items-center justify-content-center  p-4">
                        <h3>Silver</h3>
                        <h1 class="display-4 mb-0">
                            <small class="align-top"
                                style="font-size: 22px; line-height: 45px;">$</small>49<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                Month</small>
                          </div>
                        </h1>
                    </div>
                    <div class="border border-top-0 d-flex flex-column align-items-center py-4">
                        <p>Insurance Silver Member Exclusive Package</p>
                        <p>Insurance Silver Member Exclusive Package</p>
                        <p>Insurance Silver Member Exclusive Package</p>
                        <p>Insurance Silver Member Exclusive Package</p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        
                        <a href="#" class="  text-warna warna-silver btn py-md-2 px-md-4 font-weight-semi-bold my-2">Order Now</a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-5">
               
                    <div class="d-flex flex-column align-items-center justify-content-center bg-warning p-4">
                        <h3>Gold</h3>
                        <h1 class="display-4 mb-0">
                            <small class="align-top"
                                style="font-size: 22px; line-height: 45px;">$</small>99<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                Month</small>
                            
                        </h1>
                    </div>
                    <div class="border border-top-0 d-flex flex-column align-items-center py-4">
                        <p>Insurance Gold Member Exclusive Package</p>
                        <p>Insurance Gold Member Exclusive Package</p>
                        <p>Insurance Gold Member Exclusive Package</p>
                        <p>Insurance Gold Member Exclusive Package</p>
                        <p></p>
                        <p></p>
                        <p><p>
                        <p><p>
                          
                        <a href="" class="btn btn-warning py-md-2 px-md-4 font-weight-semi-bold my-2">Order Now</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                <div class="warna-plat">
                    <div class="d-flex flex-column align-items-center justify-content-center  p-4">
                        <h3>Platinum</h3>
                        <h1 class="display-4 mb-0">
                            <small class="align-top"
                                style="font-size: 22px; line-height: 45px;">$</small>150<small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                Month</small>
                                </div>
                        </h1>
                    </div>
                    <div class="border border-top-0 d-flex flex-column align-items-center py-4">
                        <p>Insurance Platinum Member Exclusive Package</p>
                        <p>Insurance Platinum Member Exclusive Package</p>
                        <p>Insurance Platinum Member Exclusive Package</p>
                        <p>Insurance Platinum Member Exclusive Package</p>
                        <p></p>
                        <p></p>
                        <p><p>
                        <p><p>
                        <a href="#"  onclick="location.href='{{ url('/form')}}'" class=" text-warna warna-plat btn  py-md-2 px-md-4 font-weight-semi-bold my-2">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>