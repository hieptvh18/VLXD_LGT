<!-- END: Footer-->
<!-- BEGIN VENDOR JS-->
<script src="{{asset('app-assets/js/vendors.min.js')}}"></script>

{{--editor js--}}
<script src="../../../app-assets/vendors/quill/katex.min.js"></script>
<script src="../../../app-assets/vendors/quill/highlight.min.js"></script>
<script src="../../../app-assets/vendors/quill/quill.min.js"></script>

<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('app-assets/vendors/chartjs/chart.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/chartist-js/chartist.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/chartist-js/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('app-assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js')}}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('app-assets/js/plugins.js')}}"></script>
<script src="{{asset('app-assets/js/search.js')}}"></script>
<script src="{{asset('app-assets/js/custom/custom-script.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/customizer.js')}}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('app-assets/js/scripts/dashboard-modern.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/intro.js')}}"></script>

{{--js upload file--}}
{{--<script src="{{ asset('app-assets/vendors/dropify/js/dropify.min.js') }}"></script>--}}
{{--<script src="{{ asset('app-assets/js/scripts/form-file-uploads.js') }}"></script>--}}

{{--js editor--}}
<script src="../../../app-assets/js/scripts/form-editor.js"></script>

{{-- js select2 --}}
<script src="{{ asset('app-assets/vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/form-select2.js') }}"></script>

{{--custom js file--}}
<script src="{{ asset('app-assets/custom/scripts.js') }}"></script>
<!-- END PAGE LEVEL JS-->
@stack('js')
