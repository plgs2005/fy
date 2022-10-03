<script>
    @if (session()->has('message'))
        $(document).ready( function(){
            toastr.success('{{session()->get('message')}}', "Success");
        });
    @elseif (session()->has('error'))
        $(document).ready( function(){
            toastr.error('{{session()->get('error')}}', "Error");
        });
    @endif

    @if ($errors->any())
        $(document).ready( function(){
            @foreach ($errors->all() as $error)
                toastr.error('{{$error}}', "Error");
            @endforeach
        });
    @endif
</script>
