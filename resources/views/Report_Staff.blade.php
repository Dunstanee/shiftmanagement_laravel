@extends('layout.app')
@section('content')
<div class="page-heading">
    <button  onclick="printDiv('StaffData')" class="m-1 btn btn-primary float-right"><i class="fa fa-print"></i>  Print Report</button>
    <button  id="BtnexportExcel" class="m-1 btn btn-success float-right"><i class="fa fa-table"></i>  Export Report</button>
    <h1 class="page-title">Staff Report</h1>
    <hr>
</div>
<div id="StaffData" class="page-content fade-in-up">
    <div class="ibox">
        <div class="p-2 text-center">
            <img class="login-title" src="{{asset('logos/'.session('company')->logo)}}" height="100" alt="" srcset="">
            <h3 class="p-2 page-title">{{session('company')->company_name}} - Staff Report </h3>
            <hr>
        </div>
        <div class="ibox-body">
            <div class="table-responsive">
                <table class="table  table-bordered table-hover" id="StaffTable" cellspacing="0" width="100%">
                    <thead class="thead-default">
                        <tr>
                            <th>Sno</th>
                            <th>Staff Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Reg Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                          $i=1;  
                        @endphp
                        @foreach ($Staffs as $staff)
                             <tr>
                                <td>{{$i++}}</td>
                                <td>{{$staff->first_name.' '.$staff->last_name}}</td>
                                <td>0{{$staff->contact}}</td>
                                <td>{{$staff->email}}</td>
                                <td>{{date('d M, Y',strtotime($staff->created_at))}}</td>                                
                            </tr>   
                        @endforeach
                       </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')
    <script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }


        document.getElementById('BtnexportExcel').onclick=function(){
        var tableId= document.getElementById('StaffData').id;
        htmlTableToExcel(tableId, filename = 'Staff Report');
        }

    // Export to excell 


    </script>

@endsection