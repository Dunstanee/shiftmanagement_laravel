

<style>
    *{
        font-size: 12px;
    }
</style>

@php
    $output = "";


    $output .='
    <div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Employee List</div>
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
                                        <button id="'.$staff->id.'" class=" btn BtnEdit btn-primary btn-sm"><i class="fa fa-pencil font-14"></i></button>
                                        <button id="'.$staff->id.'" class=" btn btn-danger btn-sm"><i class="fa fa-trash font-14"></i> </button>
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
        $('.BtnEdit').on('click',function(event){
             var employeeid = $(this).attr('id');
             location.href = '/Employee/'+employeeid;
             
           });

</script>