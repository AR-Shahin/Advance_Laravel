@extends('layouts.app')

@section('title','Load Data')

@section('content')
<div class="container my-3">
    <h2 class="text-center">Load More Data By Ajax</h2>
    <hr>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div id="loadData"></div>
        </div>
    </div>
</div>
@stop

@push('script')
    <script>
        function loadMoreData(id=0){
            axios.post('{{ route("load-data") }}',{ id : id})
            .then(res => {
               //console.log(res.data);
                   $('#load_more_button').remove();
                   $('#loadData').append(res.data);
            })
            .catch(err => {
                console.log(err);
            })
        }
        loadMoreData(0);
        $(document).on('click', '#load_more_button', function(){
        var id = $(this).data('id');
        //console.log(id);
        $('#load_more_button').html('<b>Loading...</b>');
        loadMoreData(id);
    });

    </script>
@endpush
