@extends('../user/userMaster')
@section('content')
    <!-- Category Start -->
    <section class="row categories py-5 px-3 px-lg-5 text-center mx-auto">
        @if($categories)

            @foreach ($categories as $c)

                <div class="col-lg-4  mt-3 mt-lg-4">
                     <a href="{{route('user#gradePage',$c->id)}}" class="my-4">
               <div class="card">
                <div class="card-body d-flex align-items-center">
                    <p class="fs-3 text-white bg-primary me-1 d-flex flex-colum justify-content-center align-items-center" style="width:50px;height:50px;border-radius:50%;object-position:center" >{{$c->id}}</p>
                       <p class=" text-dark card-title" style="font-size:18px">{{$c->category_name}} </p>

                </div>
                </div>
               </a>


              </div>
            @endforeach

        @else
            <h3 class="text-black">Coming soon.Thank you...</h3>
        @endif
    </section>
    <!-- Category End -->
@endsection


