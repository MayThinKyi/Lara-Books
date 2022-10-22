@extends('../admin/layouts/categoryMaster')
@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content ">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Book List</h2>

                                    </div>
                                </div>
                                <div class="table-data__tool-right">
                                    <a href="{{route('product#createPage')}}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add book
                                        </button>
                                    </a>

                                </div>
                            </div>
                          <div class="row ">
                              <form action="{{route('product#list')}}" method="get" class="offset-8 text-end">
                                @csrf
                               <div class="d-flex">
                                 <input value="{{request('searchKey')}}" type="text" name="searchKey"  class="p-2 form-contorl" placeholder="Search Book...">
                                <button class="btn btn-primary text-white">Search</button>
                               </div>
                            </form>

                          </div>
                          <div class="row">
                             @if(session('updateSuccess'))
                                <div class="offset-6 col-lg-6 mt-3 text-dark alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('updateSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if(session('deleteSuccess'))
                                <div class="offset-6 col-lg-6 mt-3 text-dark alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{session('deleteSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                          </div>
                           @if(count($products))
                            <div class="table-responsive table-responsive-data2 ">
                                <table class="table table-data2" style="margin:0 -30px">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                           <th>Book Name</th>
                                            <th>Book Image</th>
                                             <th>Book Description</th>
                                              <th>Book Category</th>
                                               <th>Book Grade</th>
                                                <th>Book Subject</th>
                                                <th>View Count</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $p)
                                        <tr class="tr-shadow ">
                                            <td class="" style="padding-top:48px">{{$p->id}}</td>
                                            <td>{{$p->book_name}}</td>
                                            <td>
                                               <img src="{{asset('storage/'.$p->book_image)}}">
                                            </td>
                                            <td>{{Str::limit($p->book_description, 20,)}}</td>
                                            <td>{{$p->book_category}}</td>
                                            <td>{{$p->book_grade}}</td>
                                            <td>{{$p->book_subject}}</td>
                                            <td>{{$p->view_count}}</td>
                                            <td >
                                                <div class="table-data-feature">

                                                   
                                                   <a href="{{route('product#delete',$p->id)}}">
                                                 <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button></a>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h3 class="text-dark">There is no data...</h3>
                           @endif
                            <!-- END DATA TABLE -->
                         {{$products->appends(request()->query())->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection
