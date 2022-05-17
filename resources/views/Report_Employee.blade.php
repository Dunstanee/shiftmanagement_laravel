@extends('layout.app')
@section('content')
<div class="page-heading">
    <button  onclick="printDiv('StaffData')" class="m-1 btn btn-primary float-right"><i class="fa fa-print"></i>  Print Report</button>
    <button  id="BtnexportExcel" class="m-1 btn btn-success float-right"><i class="fa fa-table"></i>  Export Report</button>
    <h1 class="page-title">Employee Report</h1>
    <hr>
</div>
<div id="StaffData" class="page-content fade-in-up">
    <div class="ibox">
        <div class="p-2 text-center">
            <img class="login-title" src="{{asset('logos/'.session('company')->logo)}}" height="100" alt="" srcset="">
            <h3 class="p-2 page-title">{{session('company')->company_name}} - Employee Report </h3>
            <hr>
        </div>
        <div class="ibox-body">
            <div class="table-responsive">
                <table class="table  table-bordered table-hover" id="StaffTable" cellspacing="0" width="100%">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Sno</th>
                            <th>Employee Name</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th>Date of Birth</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>National ID/Passport</th>
                            <th>REg Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                          $i=1;  
                        @endphp
                        @foreach ($Employees as $employee)
                             <tr>
                                <td>{{$i++}}</td>
                                <td>{{$employee->first_name.' '.$employee->last_name}}</td>
                                <td>{{$employee->gender}}</td>
                                <td>{{$employee->city}}</td>
                                <td>{{date('d M, Y',strtotime($employee->dob))}}</td>
                                <td>0{{$employee->contact}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->national_id}}</td>
                                <td>{{date('d M, Y',strtotime($employee->created_at))}}</td>                                
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
        htmlTableToExcel(tableId, filename = 'Employee Report');
        }

    // Export to excell 


    </script>

@endsection