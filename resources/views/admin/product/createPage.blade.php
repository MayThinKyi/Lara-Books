 @extends('../admin/layouts/categoryMaster')
@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Create Book </h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('product#create')}}" method="post" enctype='multipart/form-data' novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Book Name</label>
                                            <input id="cc-pament" value='{{old('bookName')}}' name="bookName" type="text" class="form-control @error('bookName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="ကျောင်းသုံးစာအုပ်...">
                                             @error('bookName')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Book Category</label>
                                            <select name="bookCategory" value="{{old('bookCategory')}}" class="form-control @error('bookCategory') is-invalid @enderror">
                                                @foreach ($categories as $c)
                                                    <option value="{{$c->id}}">{{$c->category_name}}</option>
                                                @endforeach
                                            </select>
                                             @error('bookCategory')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror


                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Book Grade</label>
                                             <select name="bookGrade" value="{{old('bookGrade')}}" class="form-control @error('bookGrade') is-invalid @enderror">
                                                @foreach ($grades as $g)
                                                    <option value="{{$g->id}}">{{$g->grade_name}}</option>
                                                @endforeach
                                            </select>
                                             @error('bookGrade')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Book Subject</label>
                                             <select name="bookSubject" value="{{old('bookSubject')}}"  class="form-control @error('bookSubject') is-invalid @enderror">
                                                @foreach ($subjects as $s)
                                                    <option value="{{$s->id}}">{{$s->subject_name}} ({{$s->grade_name}})</option>
                                                @endforeach
                                            </select>
                                             @error('bookSubject')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Book Cover Image</label>
                                            <input type="file" name="bookImage" class="form-control @error('bookImage') is-invalid @enderror">
                                             @error('bookImage')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">PDF Book</label>
                                            <input type="file" name="bookPdf" class="form-control @error('bookPdf') is-invalid @enderror">
                                             @error('bookPdf')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Book Description</label>
                                            <textarea name="bookDescription"  class="form-control @error('bookDescription') is-invalid @enderror" id="" cols="30" rows="10">{{old('bookDescription')}}</textarea>
                                            @error('bookDescription')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Create</span>
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
