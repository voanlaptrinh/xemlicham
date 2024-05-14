<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
    <meta name="description" content="Document">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="shortcut icon" type="image/png" href="{{ asset('/img/icons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/icons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('/img/android-chrome-144x144.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/img/android-chrome-192x192.png') }}">

    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/img/icons/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/img/icons/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/img/icons/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/img/icons/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/icons/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/img/icons/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/img/icons/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/img/icons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/icons/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('/img/icons/apple-touch-icon-180x180.png') }}" />

    <meta property="og:image" content="{{ asset('/img/icons/512x512.png') }}">
    <meta property="og:locale" content="vi">
    <meta itemprop="image" content="{{ asset('/img/icons/512x512.png') }}">
    <!-- Dark mode -->
    <script>
        const storedTheme = localStorage.getItem('theme')

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
        }

        const setTheme = function(theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if (el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })

                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })

            }
        })
    </script>


    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/apexcharts/css/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/vendor/overlay-scrollbar/css/overlayscrollbars.min.css') }}">
    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">

</head>

<body>


    <main>


        @include('admin.slidebar')



        <div class="page-content">

            @include('admin.topbar')


            @yield('content')

        </div>




    </main>
    <script src="{{ asset('/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <!-- Toastr JS -->
    <script src="{{ asset('/js/toastr.min.js') }}"></script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>

    <script type="text/javascript">
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap print preview anchor table',
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help | image | table',
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            images_upload_url: "{{ route('upload-image') }}",
            images_upload_credentials: true,
            relative_urls: false,
            document_base_url: "{{ url('/') }}",
        });
    </script>



    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById('preview-image');
                imgElement.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
    </div>

    <script src="{{ asset('/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/vendor/overlay-scrollbar/js/overlayscrollbars.min.js') }}"></script>



</body>

</html>
