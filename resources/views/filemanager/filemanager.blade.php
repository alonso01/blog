@extends('app')

@section('content')

    <div id="filemanager1" class="filemanager"></div>   

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('/')}}/bower_components/filemanager-ui/dist/js/filemanager-ui.min.js"></script>   
    <script type="text/javascript">
        $(function() {
            $("#filemanager1").filemanager({
                url:'{{url("/")}}/filemanager/connection',
                languaje: "ES",
                upload_max: 5,
                views:'thumbs',
                insertButton:true,
                token:"{{csrf_token()}}"
            });
        });
    </script>

@endsection