<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ now()->format('Y') }}.  OrkhaN . Bütün müəllif hüquqları qorunur.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">AzMart & made with <i class="ti-heart text-danger ml-1"></i></span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('backend/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/vendors/datatables.net/jquery.dataTables.js') }}"></script>

<script src="{{ asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('backend/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('backend/js/off-canvas.js') }}"></script>
<script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('backend/js/template.js') }}"></script>
<script src="{{ asset('backend/js/settings.js') }}"></script>
<script src="{{ asset('backend/js/todolist.js') }}"></script>
<script src="{{ asset('backend/js/file-upload.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('backend/js/dashboard.js') }}"></script>
<script src="{{ asset('backend/js/Chart.roundedBarCharts.js') }}"></script>

<script src="{{ asset('backend/js/alertify.min.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('js')
<!-- End custom js for this page-->
</body>

</html>

