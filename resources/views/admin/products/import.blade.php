<x-admin-master>
    @section('content')
        <h1>Imports</h1>

        @if (Session::has('product_upload_fail_message'))
            <div class="alert alert-danger">{{Session::get('product_upload_fail_message')}}</div>
        @else
            
        @endif


        <div class="container mt-5">
            <form action="{{route('product_upload')}}" method="post" enctype="multipart/form-data">
              <h3 class="text-center mb-5">Upload File and Import Products</h3>
                @csrf
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{--
                <div class="custom-file">
                    <label class="custom-file-label" for="chooseFile">Select import file</label>
                    <input type="file"
                           name="file"
                           class="form-control-file"
                           id="chooseFile">
                </div>
                --}}

                <div class="form-group">
                    <label for="chooseFile">Select import file</label>
                    <input type="file"
                            name="file"
                            class="form-control-file"
                            id="chooseFile">
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    Upload Files
                </button>
            </form>
        </div>

{{--

custom-file-input << form-control-file

    <form action="{{route('product_upload')}}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="product_import">Select File to import</label>
                <input type="file"
                        name="product_import"
                        class="form-control-file"
                        id="product_import"
                        multiple>
            </div>
            <button type="submit" class="btn btn-primary">Upload and import</button>
        </form>
--}}

    @endsection
</x-admin-master>