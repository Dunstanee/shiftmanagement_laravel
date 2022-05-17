@extends('layout.app')
@section('content')
<div class="page-heading">
    <h1 class="page-title">New Staff</h1>
    <hr>
</div>
<div id="messagebox" class="alert messagebox alert-dismissable fade show">
    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
    <span id="message"></span> 
</div>
<form id="NewEmployeeForm" class="form-horizontal" >
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Staff Registration</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">First  Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="first_name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="last_name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="email" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 ml-sm-auto">
                        <button id="btndeposit" class="btn btn-info" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>
</form>

@endsection
@section('scripts')
 <script type="text/javascript">
        $(document).ready(function (argument) {
            $('#messagebox').attr("style", "display:none");
            $('#depositshow').attr("style", "display:none");
      
           $('#NewEmployeeForm').on('submit',function(event){
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
                        var form_data = $(this).serialize();
                      $.ajax({
                        url: "/NewEmployee",
                        method: "POST",
                        dataType : 'json',
                        data: form_data,
                        success:function(response)
                        {
                            if(response.status == 200)
                            {
                              $('#messagebox').removeClass('alert alert-warning'); 
                                $('#messagebox').addClass('alert alert-success'); 
                                $('#messagebox').attr("style", "display:block");
                                $('#message').text(response.message+'. Thank you. default password is national Id, security UUID : national Id.');  
                               setTimeout(() => {
                                   $('#NewEmployeeForm')[0].reset();
                                   
                               }, 100);
      
                            }
                            if(response.status == 400)
                            {
                              $('#messagebox').removeClass('alert alert-warning'); 
                                $('#messagebox').addClass('alert alert-danger'); 
                                $('#messagebox').attr("style", "display:block");
                                $('#message').text(response.message);
                                
                            }
                            $("#btndeposit").attr("disabled", false);
        
                        }
                    });  
             
           });
        });
    </script>

@endsection