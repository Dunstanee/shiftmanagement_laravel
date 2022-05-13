<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Register</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="{{asset('assets/css/pages/auth-light.css')}}" rel="stylesheet" />
</head>
<style>
    button{
        cursor: pointer;
    }
</style>

<body class="bg-silver-500">
    <div class="content">
        <div class="brand">
            <a class="link" href="Company">New Company</a>
        </div>
        <div id="messagebox" class="alert messagebox alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            <span id="message"></span> 
        </div>
        <form id="CompanyForm"  method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
            <h2 class="login-title"> Registration Form</h2>
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label for="">Company Name</label>
                    <input class="form-control" type="text" name="company_name" >
                </div>
                <div class=" col-lg-6 form-group">
                    <label for="">City</label>
                    <input class="form-control" type="text" name="city"  autocomplete="off">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="email" name="email"  autocomplete="off">
                </div>
                <div class="col-lg-6 -group">
                    <label for="">Contact</label>
                    <input class="form-control" type="number" name="contact"  autocomplete="off">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="">Slogan</label>
                    <input class="form-control" type="text" name="tag"  autocomplete="off">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="">logo</label>
                    <input id="logo" class="form-control" type="file" name="image"  >
                </div>
                <div class=" col-lg-6 form-group">
                    <label for="">address</label>
                    <input class="form-control" type="text" name="addess"  autocomplete="off">
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label for="">Password</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(document).ready(function (argument) {
            $('#messagebox').attr("style", "display:none");
            $('#depositshow').attr("style", "display:none");
      
           $('#CompanyForm').on('submit',function(event){
             event.preventDefault();
             $("#btndeposit").attr("disabled", true);
             $('#messagebox').removeClass('alert alert-danger');
             $('#messagebox').removeClass('alert alert-success');
                $('#messagebox').addClass('alert alert-warning');
                $('#messagebox').attr("style", "display:block");
                $('#message').text('Please wait. Loading...');
                  
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                        var form_data = new FormData(this);
                      $.ajax({
                        url: "/NewCompany",
                        method: "POST",
                        dataType : 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: form_data,
                        success:function(response)
                        {
                            console.log(response);
  
                            if(response.status == 200)
                            {
                              $('#messagebox').removeClass('alert alert-warning'); 
                                $('#messagebox').addClass('alert alert-success'); 
                                $('#messagebox').attr("style", "display:block");
                                $('#message').text(response.message+'.  Redirecting...');  
                               setTimeout(() => {
                                   $('#CompanyForm')[0].reset();
                                   location.href = '/';
                               }, 100);
      
                            }
                            if(response.status == 400)
                            {
                              $('#messagebox').removeClass('alert alert-warning'); 
                                $('#messagebox').addClass('alert alert-danger'); 
                                $('#messagebox').attr("style", "display:block");
                                $('#message').text(response.message);
                                
                            }
        
                        }
                    });  
             
           });
        });
    </script>
</body>

</html>
