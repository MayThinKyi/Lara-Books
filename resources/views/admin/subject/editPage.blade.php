 @extends('../admin/layouts/categoryMaster')
@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('subject#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Edit Subject </h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('subject#update')}}" enctype='multipart/form-data' method="post" novalidate="novalidate">
                                        @csrf
                                        <input type="hidden" name="subjectId" value="{{$subject->id}}">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Subject Name</label>
                                            <input  value={{old('subjectName',$subject->subject_name)}} name="subjectName" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="မြန်မာဖတ်စာ...">
                                        </div>
                                         <div class="my-2">
                                        <img style="width:250px;height:250px" src="{{asset('storage/'.$subject->subject_image)}}" style="width:350px;height:230px">

                                        </div>
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Subject Image</label>
                                            <input  name="subjectImage" type="file" class="form-control @error('subjectImage') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                            @error('subjectImage')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>

                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Subject Category</label>
                                            <select name="subjectCategory"  class="form-control">
                                                @foreach ($categories as $c)
                                                    <option value="{{$c->id}}" @if($c->id==$subject->subject_category) selected @endif>{{$c->category_name}}</option>
                                                @endforeach
                                            </select>
                                              @error('subjectCategory')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror


                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Subject Grade</label>
                                             <select name="subjectGrade"  class="form-control">
                                                @foreach ($grades as $g)
                                                    <option value="{{$g->id}}"  @if($g->id==$subject->subject_grade) selected @endif>{{$g->grade_name}}</option>
                                                @endforeach
                                            </select>
                                              @error('subjectGrade')
                                            <small class="text-danger">{{$message}}</small>
                                             @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Update Subject</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
 <!-- END MAIN CONTENT-->
@endsection
