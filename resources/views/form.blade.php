<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<!--     
    Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{asset('css/form.css') }}">
     <!-- <link rel="stylesheet" href="{{asset('js/login.js') }}"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js ">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">



</head>
<body>

<div class="container">
    <h1>Registration Form</h1>
    <div class="box">
        <!-- Start Registration From -->
        <form action="" class="form-line" id="registrationForm">
            <!-- First name field -->
            <div class="form-group">
                <label for="Name" class="control-label required">Name</label>
                <section>
                <input type="text" id="Name" class="form-control inp-v" data-rule="required|alpha|min:3|max:25" placeholder=" Name"/>
                <div class="form-help">
                    <span class="help"></span>
                </div>
                </section>
            </div>
            <!-- Username field -->
            <div class="form-group">
                <label for="Alamat" class="control-label required">Alamat</label>
                <section>
                <input type="text" id="Alamat" class="form-control inp-v" data-rule="required|string|min:3|max:25" placeholder="Alamat"/>
                <div class="form-help">
                    <span class="help"></span>
                </div>
                </section>
            </div>
            <!-- Email field -->
            <div class="form-group">
                <label for="email" class="control-label required">E-mail</label>
                <section>
                <input type="text" id="email" class="form-control inp-v" data-rule="required|email|max:255"  placeholder="E-mail Address"/>
                <div class="form-help">
                    <span class="help"></span>
                </div>
                </section>
            </div>
            <!-- No Hp -->
            <div class="form-group">
                <label for="No Tlp" class="control-label required">No Tlp</label>
                <section>
                <input type="tel" id="No Tlp" class="form-control inp-v" data-rule="required|min:9"  placeholder="No Tlp"/>
                <div class="form-help">
                    <span class="help"></span>
                </div>
                </section>
            </div>
           
               
          
            <!-- id KTP -->
            <div class="form-group">
                <label for="ID Ktp" class="control-label required">ID Ktp</label>
                <section>
                <input type="text" id="ID Ktp" class="form-control inp-v" data-rule="required|min:9"  placeholder="ID Ktp"/>
                <div class="form-help">
                    <span class="help"></span>
                </div>
                </section>
            </div>
       

            <!-- tgl lahir -->
            <div class="form-group">
                <label for="Tgl lahir" class="control-label required">Tgl lahir</label>
                <section>
                <input type="date" id="Tgl lahir" class="form-control inp-v" data-rule="required|min:9"  placeholder="Tgl lahir"/>
                <div class="form-help">
                    <span class="help"></span>
                </div>
                </section>
            </div>
            <!-- No rek -->
            <div class="form-group">
                <label for="No rekening" class="control-label required">No rekening</label>
                <section>
                <input type="text" id="No rekening" class="form-control inp-v" data-rule="required|min:9"  placeholder="No rekening"/>
                <div class="form-help">
                    <span class="help"></span>
                </div>
                </section>
            </div>
            <!-- Submit button -->
            <div class="form-group submit">
                <p class="required-asterisk">* Required Fields</p>
                <input type="submit" name="register" value="Register" class="primary-button pull-right"/>
                <div class="clearFloat"></div>
            </div>





        </form> <!-- ./ Registration From -->
        <div class="success-alert" id="successMessage">Registration Successful</div>
    </div>
</div>
</body>

 
  <script>



  </script>
  
</html>