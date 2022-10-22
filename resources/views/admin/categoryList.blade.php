@extends('../admin/layouts/categoryMaster')
@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Category List</h2>

                                    </div>
                                </div>
                                <div class="table-data__tool-right">
                                    <a href="{{route('category#createPage')}}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add category
                                        </button>
                                    </a>

                                </div>
                            </div>
                          <div class="row ">
                              <form action="{{route('category#list')}}" method="get" class="offset-8 text-end">
                                @csrf
                               <div class="d-flex">
                                 <input value="{{request('searchKey')}}" type="text" name="searchKey"  class="p-2 form-contorl" placeholder="Search Category...">
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
                           @if(count($categories))
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $c)
                                        <tr class="tr-shadow">
                                            <td>{{$c->id}}</td>
                                            <td>{{$c->category_name}}</td>
                                            
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{route('category#editPage',$c->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button></a>
                                                   <a href="{{route('category#delete',$c->id)}}">
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
                            {{$categories->appends(request()->query())->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection
