<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.components.header')
</head>
<body>

    <div id="wrapper">
        @include('admin.components.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.components.navbar')

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            @include('admin.components.footer')
        </div>
    </div>



    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                    </button>
                </div> --}}
                <div class="modal-body">
                    <img src="" width="100%" height="100%" alt="" id="showImage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.components.script')
    @yield('addon-script')
</body>
</html>
