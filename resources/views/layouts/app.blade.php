<!DOCTYPE html>
<html lang="en">

<head>
    
    @include('layouts.partials.meta')

    <!-- App css -->
    @include('layouts.partials.css')

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #fffefe;
            border: 1px solid #408c37;
            border-radius: 15px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove,
        .select2-container .select2-selection--multiple .select2-selection__choice {
            color: #408c37;
        }

        .select2-container .select2-selection--multiple .select2-selection__choice {
            font-size: 14px;
        }

        .loader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(0, 0, 0, 0.5);
            z-index: 999;
        }
        .loader img {
            position: fixed;
            width: 150px;
            top: 30%;
            left: 45%;
        }

        mark {
            background:#3ba330;
            color:#eee;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="loader">
        <img src="{{ asset('assets/img/loader.gif') }}" alt="">
    </div>

    <!-- begin::wrapper-->
    <div id="wrapper">        
        <!-- begin::navbar  -->
        @include('layouts.partials.navbar')
        <!-- end::navbar --> 
        
        <!-- begin::sidebar -->
        @include('layouts.partials.sidebar')
        <!--end::sidebar -->
      
        <div class="content-page">

            <!-- begin::content -->
            <div class="content">

              @yield('content')  

            </div>
            <!-- end::content -->

            <!-- begin::footer -->
            @include('layouts.partials.footer')
            <!-- end::footer -->
        </div>
    </div>
    <!-- end::wrapper -->

   

    <!-- begin::overlay-->
    <div class="rightbar-overlay"></div>

    <!--begin::scripts -->
    @include('layouts.partials.script')
    <!--end::scripts -->

    {{-- @stack('scripts') --}}

    <script>
        window.addEventListener('load', (event) => {
            var loader = document.querySelector(".loader");
            loader.remove();
        });

        $(document).ready(function () {
            $('.select2').select2();
        });

        let token = document.head.querySelector('meta[name="csrf-token"]');
        if(token) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token.content
                }
            });
        } else {
            console.log('CSRF Token not found');
        }

        function setPosition(input, pos) {
            // Modern browsers
            if (input.setSelectionRange) {
                input.focus();
                input.setSelectionRange(pos, pos);
            } 
        }

        function toggleActive(table, id) {
            $.ajax({
                url: '/admin/toggle-active',
                data: {
                    table,
                    id
                },
                dataType: 'JSON',
                success: function(res) {
                    if (res.status == 'success') {
                        toastr.success(res.message);
                    }
                    else {
                        toastr.error(res.message);
                    }
                    table.ajax.reload();
                },
            });
        }

    </script>
</body>

</html>