@extends('layouts.app')

@section('title','Scroll Infinite Data ')

@section('content')
<div class="container my-3">
    <h2 class="text-center">Scroll Infinite Data By Ajax</h2>
    <hr>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
             <div id="data-wrapper">
            <!-- Results -->
        </div>
             <!-- Data Loader -->
        <div class="auto-load text-center">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>
        </div>
    </div>
</div>

@stop

@push('script')
    <script>
        console.log($(window).scrollTop());
        console.log($(document).height());
        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);

        $(window).scroll(function() { //detect page scroll
      if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
      page++; //page number increment
      infinteLoadMore(page); //load content
      }
    });

        $(window).on('scroll', function () {
            if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                page++; //page number increment
                infinteLoadMore(page);
                   console.log($(window).scrollTop());
        console.log($(document).height());
            }
        }).scroll();

        function infinteLoadMore(page) {
            console.log(ENDPOINT,page);
            axios.get(`${ENDPOINT}/load-infinite?page=${page}`)
            .then(res =>{
                $("#data-wrapper").append(res.data);
               // console.log(res);
            })
            .catch(err =>{
                console.log(err);
            })

        }
    </script>
@endpush
