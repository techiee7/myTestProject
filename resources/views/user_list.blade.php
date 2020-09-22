@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel Demo</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('userData.create') }}"> Create New User</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered datatable-colvis-multi">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>email</th>
            <th width="280px">Action</th>
        </tr>
        <!-- @foreach ($userData as $uData)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $uData->name }}</td>
            <td>{{ $uData->email }}</td>
            <td>
                <form action="{{ route('userData.destroy',$uData->id) }}" method="POST">
                   
                    <a class="btn btn-info" href="{{ route('userData.show',$uData->id) }}">Show</a>

 
    
                    <a class="btn btn-primary" href="{{ route('userData.edit',$uData->id) }}">Edit</a>
                    <!-- SUPPORT ABOVE VERSION 5.5 -->
                    {{-- @csrf
                    @method('DELETE') --}} 
                    
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                  
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach -->
    </table>
  
    {!! $userData->links() !!}

    <script type="text/javascript">
        $(function() {
         
       DatatableObj = $('.datatable-colvis-multi').DataTable({
//        "sDom": '<"top"i>rt<"bottom"lp><"clear">',
        "dom": "Blrtip",
        "scrollY": 170,
        "scrollX": true,
        'responsive': false,
        "info": true,
        "bFilter": true,   
        "processing"  : true, 
        "serverSide"  : true, 
        "order"       : [],
        "oLanguage": {
                        "sEmptyTable": "No data avaliable"
                    },
        "pageLength"  : 10, 
        "lengthChange" : true,
        "lengthMenu"  : [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                      ],
        "ajax"        : {
                        "url"       : {{ route("viewUsers") }},
                        "type"      : "POST",
                        "dataType"  : "json",
                        "data"      : {"_token": "{{ csrf_token() }}" },
                    }
          
        });
   });
    </script>
      
@endsection 