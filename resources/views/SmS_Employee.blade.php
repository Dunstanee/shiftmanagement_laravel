@extends('layout.app')
@section('content')
<div class="page-heading">
    <h1 class="page-title">SMS Dashboard</h1>
    <hr>
</div>

<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <a class="btn BtnCompose btn-info btn-block" ><i class="fa fa-edit"></i> New Message</a><br>
            <h6 class="m-t-10 m-b-10">FOLDERS</h6>
            <ul class="list-group list-group-divider inbox-list">
                <li class="list-group-item">
                    <a class=" BtnEmployees"><i class="fa fa-inbox"></i> Employees 
                        <span class="badge badge-warning badge-square pull-right">{{$EmployeesNo}}</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class=" BtnMessages"><i class="fa fa-envelope-o"></i> Sent Messages
                        <span class="badge badge-primary badge-square pull-right">{{$SmsNo}}</span>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="javascript:;"><i class="fa fa-file-text-o"></i> Bulk Sms</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="ibox" id="mailbox-container">
                
                    <div id="dataEmployee"></div>
                
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')
    <script>
    $(document).ready(function (argument) {
        Messages();
        $('.BtnEmployees').on('click',function(event){
            fetch_data();
        });
        $('.BtnCompose').on('click',function(event){
            ComposeSms();
        });
        $('.BtnMessages').on('click',function(event){
            Messages();
        });
        function fetch_data() 
        {
            $.ajax({
                url:"/GetEmployeesSms",
                success:function(data)
                {
                $('#dataEmployee').html(data);
                }
            })
        }
        function ComposeSms() 
        {
            $.ajax({
                url:"/GetComposeSms",
                success:function(data)
                {
                $('#dataEmployee').html(data);
                }
            })
        }
        function Messages() 
        {
            $.ajax({
                url:"/GetMessages",
                success:function(data)
                {
                $('#dataEmployee').html(data);
                }
            })
        }
    });
    </script>

@endsection