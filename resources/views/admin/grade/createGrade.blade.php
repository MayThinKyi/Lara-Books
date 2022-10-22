 @extends('../admin/layouts/categoryMaster')
@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('grade#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Create Grade </h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('grade#create')}}" method="post" novalidate="novalidate">
                                        @csrf
                                       
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="gradeName" type="text" class="form-control @error('gradeName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="တတိယတန်း...">
                                              @error('gradeName') 
                                            <small class="text-danger">{{$message}}</small> @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Grade Category</label>
                                            <select name="gradeCategory"  class="form-control">
                                                @foreach ($categories as $c)
                                                    <option value="{{$c->id}}">{{$c->category_name}}</option>
                                                @endforeach
                                            </select>
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
 