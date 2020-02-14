@extends('layouts.tab')


@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-11">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-lg-left">
                                    <h1 class="h4 text-gray-900 mb-4">Multiple Acount Details</h1>

                                    <hr>
                                </div>

                                <script>
                                    $("document").ready(function(){
                                        setTimeout(function(){
                                            $("div.alert").remove();
                                        },3000 ); // 5 secs

                                    });
                                </script>
                                @if ($flash = session('error'))
                                    <div  class="alert alert-danger" role="alert">
                                      <center>{{$flash}}</center>
                                    </div>
                                @endif


                                <br>

                                <div class="box-body">

                                    <!-- /.table-responsive -->

                                    <table class="table-responsive" id="example" width="100%" cellspacing="-20">

                                        <thead>
                                        <tr>

                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Account Number</th>
                                            <th>Created</th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record => $values)
                                            <tr class="odd gradeX">

                                                <td>{{$values->id}}</td>
                                                <td>{{session('name')}}</td>
                                                <td>{{$values->account_type}}</td>
                                                <td>{{$values->account_id}}</td>
                                                <td>{{$values->created_at}}</td>


                                                <td>
                                                    <form role="form" action="/multiple/add" method="POST">
                                                        @csrf
                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->user_id}}"  name="id" >

                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();
                                                               $transactions = $role->ib_change_status;

                                                                if(!isset($transactions)|| trim($transactions) == ''){
                                                                    echo '';

                                                                    }else{

                                                                   echo $display = '<center><button type="submit" class="btn btn-primary">&nbsp Add  &nbsp</button></center>';
                                                                   }
                                                        @endphp
                                                    </form>
                                                </td>

                                                <td>  <form role="form" action="/multiple/remove" method="POST">

                                                        @csrf

                                                        <input type="hidden" class="form-control"  placeholder="Company Name" value="{{$values->id}}"  name="id" >

                                                        @php
                                                            $id = Auth::user()->role_permissions_id;
                                                            $role = \App\Role_User::where('id', $id)->get()->first();

                                                             $transactions = $role->ib_change_status;

                                                              if(!isset($transactions)|| trim($transactions) == ''){
                                                                  echo '';

                                                                  }else{

                                                                 echo $display = '<center><button type="submit" class="btn btn-success">Remove</i></button></center>';
                                                                 }
                                                        @endphp
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

