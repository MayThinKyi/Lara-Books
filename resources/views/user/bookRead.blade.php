@extends('../user/userMaster')
@section('content')
    <!-- Book Start -->
    <section class="categories text-center py-5  px-2 px-lg-5">
        <a class="mb-5" href="javascript:history.back()"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
        @if($book!=null)

              <h6 class="mt-3 text-primary p-2 " style="line-height:30px;background: #ECEEEF">{{$book->book_category}} / {{$book->book_grade}} / {{$book->book_subject}}</h6>
              <div class="row mt-5 mx-lg-auto">
                <div class="col-lg-1 col-6">  <img style="width:100%" src="{{asset('storage/'.$book->book_image)}}" alt=""></div>
                <div class="col-lg-6 col-6 d-flex flex-column">
                   <input type="hidden" name="bookId" class="bookId" value="{{$book->id}}">
                    <p class=" text-black">{{$book->book_name}}  </p>

                <p class=" text-black"><i class="fa-solid fa-eye me-1"></i> <span class="viewCount">{{$book->view_count}}</span> </p>
                    <a href="#pdf" class="">
             <button class="btn btn-primary py-2 px-4 text-white">Read <i class="fa-sharp fa-solid fa-book-open-reader"></i></button>

                    </a>
            </div>
            </div>
               <p class="mt-4 text-black">{{$book->book_description}} </p>

             <div>
                <iframe src ="{{ asset('/laraview/#../storage/'.$book->book_pdf) }}" width="100%" height="100vh" ></iframe>
</iframe>

        </div>

        @else
           <h3 class="text-black mt-5">Coming soon.Thank you...</h3>
        @endif
    </section>
    <!-- Book End -->
@endsection
@section('myScript')
<script>
   $(document).ready(function(){
    $viewCount=Number($('.viewCount').text());
    $bookId=$('.bookId').val();
    $data={
            'viewCount':$viewCount,
            'bookId':$bookId
        }
    $.ajax({
        type:"get",
        url:'/user/bookPage/view',
        data:$data,
        dataType:'json',
        success:function(){

        }
    })
    $('.viewCount').html($viewCount+1);
   })
    </script>
@endsection
