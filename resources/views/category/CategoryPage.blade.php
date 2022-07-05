@extends('layouts.app')

@section('content')

<h1>Category Page</h1>
<div class="container">
     <div class="row justify-content-center">


         <div class="col-md-4">
             <div class="card">
                 <div class="card-header text-center">CATEGORY</div>
                 <form action="{{ route('cat.store') }}" method="post">
                     @csrf
                     <div class="card-body text-right">
                         <div class="form-group">
                             <label for="name"> CATOGERY NAME </label>
                             <input type="text" class="form-control" name="cat_name" placeholder="CATEGORY NAME ">
                         </div>
                         <br>

                         <div class="form-group text-center">
                             <button class="btn btn-danger" type="submit">SAVE</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>



         <div class="col-md-8">
             <div class="card">
                 <div class="card-header text-center"> CATEGORIES </div>
                

                 <div class="card-body">
                     @if (session('message'))
                         <div class="alert alert-success" role="alert">
                             {{ session('message') }}
                         </div>
                     @endif
                     <table class="table table-bordered text-center">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">CATEGORY NAME </th>
                                 <th scope="col">EDITE</th>
                                 <th scope="col">DELETE</th>

                             </tr>
                         </thead>
                      <tbody>

                        @foreach ($cats as $key=> $row)
                        <tr>
                          

                            <td scope="row" style="width: 12%">{{ $key=$key+1 }}</th>
                                <td hidden >{{ $row->id}}</td>
                            <td>{{ $row->cat_name }}</td>

                            <td style="width: 15%"><button class="btn btn-primary editbtn">Edite</button></td>

                            <td style="width: 15%">
                                 <a href="{{ route('cat.delete',$row->id) }}" class="btn btn-danger" id="delete">Delete</a>
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




 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Category Name</h5>
       
        </div>
        <div class="modal-body">
          <form action="{{ route('cat.update') }}" method="POST"> 
            @csrf

            <input type="hidden" class="form-control" id="id" name="id">

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label"> Category Name</label>
              <input type="text" class="form-control" id="cat_name" name="cat_name">
            </div>
            
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Edite</button>
        </div>
    </form>
      </div>
    </div>
  </div>
 

  <script>
    $(document).ready(function(){
        $('.editbtn').on('click',function(){
            $('#exampleModal').modal('show');

            $tr=$(this).closest('tr');

        var data=$tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#id').val(data[1]);
        $('#cat_name').val(data[2]);


                });
            });

</script>

@endsection
