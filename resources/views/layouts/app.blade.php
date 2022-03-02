<!DOCTYPE html>
<html lang="en">

<head>
    
    @include('layouts.partials.meta')

    <!-- App css -->
    @include('layouts.partials.css')

    <style>
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
            width: 50px;
            top: 30%;
            left: 50%;
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

        $('#ajaxModal').on('shown.bs.modal', function() {
            let input = document.getElementById('text');
            setPosition(input, input.value.length);
        });

    </script>
</body>

</html>