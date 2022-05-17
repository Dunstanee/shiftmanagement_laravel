
@extends('layout.app')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Manage Staff</h1>
    <hr>
</div>

<div id="dataEmployee"></div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function (argument) {
            
           $('.BtnEdit').on('click',function(event){
             var employeeid = $(this).attr('id');
             alert(employeeid);
             
           });

           fetch_data();
    
            function fetch_data() 
            {
            $.ajax({
                url:"/GetStaffs",
                success:function(data)
                {
                $('#dataEmployee').html(data);
                }
            })
            }
            
        });
        
    </script>

@endsection