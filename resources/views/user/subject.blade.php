@extends('../user/userMaster')
@section('content')
    <!-- Subject Start -->
    <section class="row categories text-center  mx-auto py-5 px-2 px-lg-5">
        <a class="mb-4" href="javascript:history.back()"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
        @if(count($subjects))
            @foreach ($subjects as $s)
               <div class="col-6  col-lg-4  mt-4 mt-lg-4">
               <a href="{{route('user#book',[$categoryId,$gradeId,$s->id])}}" class="my-4">
            <img class="rounded subjectImage"  src="{{asset('storage/'.$s->subject_image)}}" alt="">

                <h6 class="mt-2 mb-4 text-black">{{$s->subject_name}} </h6>
               </a>
            </div>

            @endforeach
        @else
           <h3 class="text-black mt-5">Coming soon.Thank you...</h3>
        @endif
    </section>
    <!-- Subject End -->
@endsection
