    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.js') }}"></script>
    <script src="{{ asset('js/bootstrapconfirmation.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    @yield('scriptfile')