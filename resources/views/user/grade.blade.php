@extends('../user/userMaster')
@section('content')
    <!-- Grade Start -->
    <section class="categories row text-center py-5 px-3 px-lg-5">
        <a href="javascript:history.back()"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>

        @if(count($grades))
            @foreach ($grades as $g)
               <a href="{{route('user#grade',[$categoryId,$g->id])}}" class="col-lg-4 ">

               <div class="card   mt-3 mt-lg-4">
                <div class="card-body d-flex align-items-center">
                    <p class="fs-3 text-white bg-primary me-1 d-flex flex-colum justify-content-center align-items-center" style="width:50px;height:50px;border-radius:50%;object-position:center" >
                   <i class='bx bxs-book-bookmark'></i>
                    </p>
                       <p class=" text-dark card-title" style="font-size:18px">{{$g->grade_name}} </p>

                </div>



              </div>

               </a>

            @endforeach
        @else
           <h3 class="text-black mt-5">Coming soon.Thank you...</h3>
        @endif
    </section>
    <!-- Grade End -->
@endsection
