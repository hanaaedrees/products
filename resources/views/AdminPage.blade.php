@extends('layouts.app')

@section('content')
@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-warning">
                        <li class="breadcrumb-item active " aria-current="page"> CUSTOMER ORDER </li>
                    </ol>
                </nav>

                <div class="card ">
                    <div class="card-header">
                        <a style="float:right;" href="{{ route('cat.show') }}"><button class="bnt btn-success btn-default"
                                style="margin-left:6px ;"> Add New Category </button></a>

                        <a style="float:right;" href="{{ route('product.create') }}"><button class="bnt btn-danger btn-default"
                                style="margin-left:6px ;"> Add product </button></a>
                        <a style="float:right;" href="{{ route('product.index') }}"><button class="bnt btn-info btn-default"
                                style="margin-left:6px ;">  Browse Products </button></a>

                    </div>
                    <div class="card-body text-center">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">PHONE NUMBER</th>

                                    <th scope="col">HISTORY</th>
                                    <th scope="col">TIME</th>
                                    <th scope="col">PRODUCT NAME </th>
                                    <th scope="col">NUMBER(S)</th>
                                    <th scope="col">PRICE ($)</th>
                                    <th scope="col">TOTAL PRICE ($)</th>
                                    <th scope="col">ADRESS</th>
                                    <th scope="col">STATUS </th>
                                    <th scope="col">ACCEPT</th>
                                    <th scope="col">REJECT ORDER</th>
                                    <th scope="col"> DONE </th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($order as $row)
                                    <tr>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->user->email }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>{{ $row->date }}</td>
                                        <td>{{ $row->time }}</td>

                                        <td>{{ $row->product->name }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>${{ $row->product->price }}</td>
                                        <td>${{ $row->product->price * $row->qty }}</td>
                                        <td>{{ $row->address }}</td>




                                        @if ($row->status == 'LODING ORDER')

                                            <td class="text-light bg-secondary">{{ $row->status }}</td>

                                        @endif

                                        @if ($row->status == 'REJECT')

                                            <td class="text-light bg-danger">{{ $row->status }}</td>

                                        @endif

                                        @if ($row->status == 'ACCEPT')

                                            <td class="text-light bg-primary">{{ $row->status }}</td>

                                        @endif

                                        @if ($row->status == 'DONE')

                                            <td class="text-light bg-success">{{ $row->status }}</td>

                                        @endif


                                        <form action="{{ route('order.status', $row->id) }}" method="post">
                                            @csrf


                                            <td>
                                                <input name="status" type="submit" value="ACCEPT"
                                                    class="btn btn-primary btn-sm">
                                            </td>

                                            <td>
                                                <input name="status" type="submit" value="REJECT"
                                                    class="btn btn-danger btn-sm">
                                            </td>
                                            <td>
                                                <input name="status" type="submit" value="DONE"
                                                    class="btn btn-success btn-sm">
                                            </td>

                                        </form>





                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@endsection
