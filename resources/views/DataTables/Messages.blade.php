<style>
    *{
        font-size: 12px;
    }
</style>
@php
$output = "";
    $output .='
    <link href="assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <div class="mailbox-header">
        <div class="d-flex justify-content-between">
            <h5 class="d-none d-lg-block inbox-title"><i class="fa fa-envelope-o m-r-5"></i> Message Sent (15)</h5>
        </div>
        
    </div>
    <div class="mailbox clf">
        <table class="table table-hover table-inbox" id="example-table">
            <thead class="thead-default">
                        <tr>
                            <th>Sno</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th></th>
                            <th>Date</th>
                            <th>Time</th>
                            
                        </tr>
                    </thead>
            <tbody class="rowlinkx" data-link="row">';
                foreach ($Messages as $item) {
                    $output .=' <tr data-id="1">
                    <td class="check-cell rowlink-skip">
                        <label class="ui-checkbox ui-checkbox-info check-single">
                            <input class="mail-check" type="checkbox">
                            <span class="input-span"></span>
                        </label>
                    </td>
                    <td>
                        <a data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Click to View"><i class="fa fa-users text-success"></i> '.$item->employee_count.'</a>
                    </td>
                    <td class="mail-message">'.$item->message.'</td>
                    <td class="mail-label hidden-xs"><i class="fa fa-circle text-success"></i></td>
                    ';
                        if(date("Y-m-d",strtotime($item->created_at)) == date('Y-m-d'))
                        {
                            $output .='<td class="text-right">Today</td>';
                        }else if(date("Y-m-d",strtotime($item->created_at)) == date("Y-m-d",strtotime(date('Y-m-d').'- 1 day'))){
                            $output .='<td class="text-right">Yesterday</td>';
                        }else{
                            $output .='<td class="text-right">'.date("d M, Y",strtotime($item->created_at)).'</td>' ;
                        }
                        $output .='
                    <td class="text-right">'.date(" h:i:sa",strtotime($item->created_at)).'</td>
                </tr>';
                }
                
                $output .='
            </tbody>
        </table>
    </div>
    <script src="assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="assets/js/app.min.js" type="text/javascript"></script>';


    echo $output;

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
