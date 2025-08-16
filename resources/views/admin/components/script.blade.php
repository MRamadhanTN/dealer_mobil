<!-- Bootstrap core JavaScript-->
<script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('sb-admin-2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('sb-admin-2/js/demo/datatables-demo.js') }}"></script>

{{-- <script src="{{ asset('sb-admin-2/vendor/chart.js/Chart.min.js') }}"></script> --}}
<!-- Page level custom scripts -->
{{-- <script src="{{ asset('/sb-admin-2/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('/sb-admin-2/js/demo/chart-pie-demo.js') }}"></script> --}}

<script>
    document.addEventListener('DOMContentLoaded', async function ()  {
        await new Promise(resolve => setTimeout(resolve, 250));

        tablefilter = document.getElementById('dataTable_filter')
        if (tablefilter) {
            tablefilter.classList.add('row', 'justify-content-end', 'pr-3')
        }

        tablePaginate = document.getElementById('dataTable_paginate')
        if (tablePaginate) {
            tablePaginate.classList.add('row', 'justify-content-end', 'pr-3')
        }
    })

    function showImage(url) {
        var image = document.getElementById('showImage');
        image.src = url
    }
</script>
