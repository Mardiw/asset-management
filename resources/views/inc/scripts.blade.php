<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('cork1/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('cork1/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('cork1/bootstrap/js/bootstrap.min.js')}}"></script>

@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')
<script src="{{asset('cork1/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('cork1/assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('cork1/assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('cork1/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('cork1/assets/js/custom.js')}}"></script>
@endif
<!-- END GLOBAL MANDATORY SCRIPTS -->