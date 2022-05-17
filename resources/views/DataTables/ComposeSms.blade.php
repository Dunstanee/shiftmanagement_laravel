<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
<link href="{{asset('assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet" />
<link href="{{asset('assets/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" />

@php
    $output = "";


$output .='
<div id="messagebox" class="alert messagebox alert-dismissable fade show">
    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
    <span id="message"></span> 
</div>
<div class="mailbox-header d-flex justify-content-between">
 
        <h5 class="inbox-title">New Message</h5>
     
</div>
<hr>
    <div class="mailbox-body">
        <form class="form-horizontal"  method="POST" id="NewMessage">
            <div class="form-group row">
                <label class="col-sm-2 control-label">To:</label>
                <div class="col-sm-10">
                    <select class="form-control select2_demo_1" multiple="" name="employee_id[]">';
                            foreach ($Employees as $item)
                            {
                            $output .='<option  value="'.$item->id.'">'.$item->first_name.' '.$item->last_name.'</option>'; 
                            }
               $output .='</select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label">Message:</label>
                <div class="col-sm-10">
                    <textarea  class="form-control" name="message">
                
                    </textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button class="btn btn-primary m-t-20" type="submit"><i class="fa fa-send"></i> Send</button>
                </div>
            </div>
            
            
        </form>
    </div>';
echo  $output;
@endphp
<script src="{{asset('assets/vendors/summernote/dist/summernote.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/scripts/form-plugins.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#summernote').summernote();
        $('#summernote_air').summernote({
            airMode: true
        });
    });
</script>
@section('scripts')
 <script type="text/javascript">
        $(document).ready(function (argument) {
            $('#messagebox').attr("style", "display:none");
            $('#depositshow').attr("style", "display:none");
      
           $('#NewMessage').on('submit',function(event){
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
                        url: "/SendSms",
                        method: "POST",
                        dataType : 'json',
                        data: form_data,
                        success:function(response)
                        {
                            console.log(response)
                            if(response.status == 200)
                            {
                              $('#messagebox').removeClass('alert alert-warning'); 
                                $('#messagebox').addClass('alert alert-success'); 
                                $('#messagebox').attr("style", "display:block");
                                $('#message').text(response.message+'. Thank you.');  
                               setTimeout(() => {
                                   $('#NewMessage')[0].reset();
                                   
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