@php
    $output = "";


    $output .='
    <link href="assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
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
                            <th>Employee Name</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th>Date of Birth</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>National ID/Passport</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sno</th>
                            <th>Employee Name</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th>Date of Birth</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>National ID/Passport</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>';
                        $i=1;
                        foreach ($Employees as  $employee) 
                        {
                        
                            $output .='<tr>
                                <td>'.$i++.'</td>
                                <td>'.$employee->first_name.' '.$employee->last_name.'</td>
                                <td>'.$employee->gender.'</td>
                                <td>'.$employee->city.'</td>
                                <td>'.date('d M, Y',strtotime($employee->dob)).'</td>
                                <td>0'.$employee->contact.'</td>
                                <td>'.$employee->email.'</td>
                                <td>'.$employee->national_id.'</td>
                                <td>
                                    <div class="text-center">
                                        <button id="'.$employee->id.'" class=" btn BtnEdit btn-primary btn-sm"><i class="fa fa-pencil font-14"></i></button>
                                        <button id="'.$employee->id.'" class=" btn btn-danger btn-sm"><i class="fa fa-trash font-14"></i> </button>
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
<script src="assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="assets/js/app.min.js" type="text/javascript"></script>';
echo  $output;
@endphp
<script>
    $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
            });
        })
        $('.BtnEdit').on('click',function(event){
             var employeeid = $(this).attr('id');
             location.href = '/Employee/'+employeeid;
             
           });

</script>