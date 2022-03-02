<script src="{{ asset('assets/js/vendor.min.js')}}"></script>


<script src="{{ asset('js/toast.min.js')}}"></script>

<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets/js/mark.js')}}"></script>
<script src="{{ asset('assets/js/datatables.mark.js')}}"></script>

<script src="{{ asset('assets/libs/select2/select2.min.js')}}"></script>

<script src="{{ asset('assets/libs/switchery/switchery.min.js')}}"></script>
<script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/form-advanced.init.js')}}"></script>


<!-- App js -->
<script src="{{ asset('assets/js/app.min.js')}}"></script>

 <!-- Laravel Javascript Validation -->
 <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

 <!-- Datatable -->
{{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script> --}}

<!-- Sweetalert 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.3.10/sweetalert2.all.min.js" integrity="sha512-IG3jJs+NhoPszr+n3I3AHLii1LFFGEVZoorGJFkrd+flS4dgdAVL0AAGiPHlXB0ZD5mgPmcpVKm4KBybCeXLLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- Select2 --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

<!-- DOM Buttons -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

{{-- Daterange Picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

{{-- File pond  --}}
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<!-- Laravel Javascript Validation -->
 {{-- <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script> --}}

 
<script>
      toastr.options.progressBar = true;

      @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
      @endif


      @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
      @endif


      @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
      @endif


      @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
      @endif

      function setPosition(input, pos) {
            // MODERM BROWSER 
            if (input.setSelectionRange) {
                  input.focus();
                  input.setSelectionRange(pos, pos);
            } 
      }



</script>

@yield('script')
