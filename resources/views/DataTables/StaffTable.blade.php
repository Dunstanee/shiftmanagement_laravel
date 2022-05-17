

<style>
    *{
        font-size: 12px;
    }
</style>

@php
    $output = "";


    $output .='
    <div id="messagebox" class="alert messagebox alert-dismissable fade show">
    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
    <span id="message"></span> 
</div>
    <div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Staff List</div>
        </div>
        <div class="ibox-body">
            <div class="table-responsive">
                <table class="table  table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead class="thead-default">
                        <tr>
                            <th>Sno</th>
                            <th>Staff Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Reg Date</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sno</th>
                            <th>Staff Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Reg Date</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>
                    <tbody>';
                        $i=1;
                        foreach ($Staffs as  $staff) 
                        {
                        
                            $output .='<tr>
                                <td>'.$i++.'</td>
                                <td>'.$staff->first_name.' '.$staff->last_name.'</td>
                                <td>0'.$staff->contact.'</td>
                                <td>'.$staff->email.'</td>
                                <td>'.date('d M, Y',strtotime($staff->created_at)).'</td>
                                <td>
                                    <div class="text-center">
                                        <button id="'.$staff->id.'" class=" btn BtnDelete btn-danger btn-sm"><i class="fa fa-trash font-14"></i> </button>
                                    </div>
                                </td>
                                
                            </tr>';
                        }
                        
                    $output .='</tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>


';
echo  $output;
@endphp
<script>
   $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
            });
        });
        $(document).ready(function (argument) {
            $('#messagebox').attr("style", "display:none");
            $('#depositshow').attr("style", "display:none");
      
           $('.BtnDelete').on('click',function(event){
             event.preventDefault();
             $(".BtnDelete").attr("disabled", true);
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
                        var staffid = $(this).attr('id');
                      $.ajax({
                        url: "/Staff/"+staffid,
                        method: "PUT",
                        dataType : 'json',
                        success:function(response)
                        {
                            console.log(response);
                            if(response.status == 200)
                            {
                              $('#messagebox').removeClass('alert alert-warning'); 
                                $('#messagebox').addClass('alert alert-success'); 
                                $('#messagebox').attr("style", "display:block");
                                $('#message').text(response.message);  
                               setTimeout(() => {
                                   location.href = 'Staff';
                               }, 100);
      
                            }
                            if(response.status == 400)
                            {
                              $('#messagebox').removeClass('alert alert-warning'); 
                                $('#messagebox').addClass('alert alert-danger'); 
                                $('#messagebox').attr("style", "display:block");
                                $('#message').text(response.message);
                                
                            }
                            $(".BtnDelete").attr("disabled", false);
        
                        }
                    });  
             
           });
        });

</script>