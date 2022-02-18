<link href="{{asset('cork1/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('cork1/assets/js/loader.js')}}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{asset('cork1/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default' && $page_name != 'register')
<link href="{{asset('cork1/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('cork1/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
@endif

<link href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<link rel="stylesheet" type="text/css" href="{{asset('cork1/assets/css/elements/alert.css')}}">