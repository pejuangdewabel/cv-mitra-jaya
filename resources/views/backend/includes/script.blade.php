<!-- Vendor JS Files -->
<script src="{{ asset('assets/backend/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/backend/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script>
    $(document).ready(function() {
        $('#dateNow').text(moment().format('YYYY'));
    });
</script>
