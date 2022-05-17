@extends('layout.app')
@section('content')
@if (empty($Employees))
    <div class="page-heading">
        <h1 class="page-title">No Employee Found</h1>
        <hr>
    </div>
@endif

@empty(!$Employees)
    

<div class="page-heading">
    <h1 class="page-title">Update Employee</h1>
    <hr>
</div>
<div id="messagebox" class="alert messagebox alert-dismissable fade show">
    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
    <span id="message"></span> 
</div>
<form id="UpdateEmployeeForm" class="form-horizontal" >
<div class="row">
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Employee Update</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">First  Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" value="{{$Employees->first_name}}" type="text" name="first_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Last Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" value="{{$Employees->last_name}}" type="text" name="last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">City From:</label>
                    <div class="col-sm-8">
                        <input class="form-control" value="{{$Employees->city}}" type="text" name="city" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Gender</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="gender">
                            @foreach ($Gender as $item)
                               <option @php
                                   if ($item->gender == $Employees->gender) {
                                       echo 'selected';
                                   }
                               @endphp value="{{$item->gender}}">{{$item->gender}}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input class="form-control" value="{{$Employees->email}}" type="email" name="email">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">.</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">National/Passport ID</label>
                    <div class="col-sm-8">
                        <input class="form-control" value="{{$Employees->national_id}}" type="number" name="national_id">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Contact</label>
                    <div class="col-sm-8">
                        <input class="form-control" value="0{{$Employees->contact}}"  type="text" name="contact">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Date of Birth</label>
                    <div class="col-sm-8">
                        <div class="form-group" id="date_3">
                            <div class="input-group date">
                                <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" value="{{$Employees->dob}}" type="text" name="dob">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 ml-sm-auto">
                        <button  class="btn BtnCancel btn-danger" type="button">Cancel</button>
                        <button id="btndeposit" class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endempty
@endsection
@section('scripts')
@empty(!$Employees)
    

 
            <script type="text/javascript">
        $(document).ready(function (argument) {
            $('#messagebox').attr("style", "display:none");
            $('#depositshow').attr("style", "display:none");
      
           $('#UpdateEmployeeForm').on('submit',function(event){
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
                        url: "/UpdateEmployee/"+{{$Employees->id}},
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
                                $('#message').text(response.message);  
                               setTimeout(() => {
                                   $('#UpdateEmployeeForm')[0].reset();
                                   location.href = '../Employee' 
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

           $('.BtnCancel').on('click',function(event){
              location.href = '../Employee'      
             
           });
        });
    </script>
@endempty
@endsection