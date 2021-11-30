<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quản trị Web Sách truyện</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                   Admin Sách Truyện
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        {{-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                           @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript">
        function ChangetoSlug()
        {
            var slug;
            
            //lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi kí tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ã|ạ|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi,'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ế|ề|ể|ễ|ệ/gi,'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi,'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ớ|ờ|ở|ỡ|ợ/gi,'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ứ|ừ|ử|ữ|ự/gi,'u')
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi,'y');
            slug = slug.replace(/đ/gi,'d');
            //xóa các kí tự đặc biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*\(|\)|\+|\=|\,|\.|\/|\?|\<|\>|\'|\"|\:|\;|_/gi,'');
            //đổi khoảng trắng thành kí tự gạch ngang
            slug = slug.replace(/ /gi,'-');
            //đổi nhiều kí tự gạch ngang liên tiếp thành 1 kí tự gạch ngang 
            //phòng trường hợp người nhập quá nhiều kí tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi,'-');
            slug = slug.replace(/\-\-\-\-/gi,'-');
            slug = slug.replace(/\-\-\-/gi,'-');
            slug = slug.replace(/\-\-/gi,'-');
            //xóa kí tự gạch ngang ở đầu và cuối
            slug = '@' + slug +'@';
            slug = slug.replace(/\@\-|\-\@|\@/gi,'');
            //in slug ra textbox có id "slug"
            document.getElementById('convert_slug').value= slug;
        }
    </script>
    <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor_noidung_chapter');
        CKEDITOR.replace('ckeditor_tomtat_truyen');
        CKEDITOR.replace('ckeditor_noidung_sach');
    </script>
    <script type="text/javascript">
        $('.truyennoibat').change(function(){
            const truyennoibat = $(this).val();
            const truyen_id = $(this).data('truyen_id');
            var _token = $('input[name="_token"]').val();
            var thongbao = '';
            if(truyennoibat == 0){
                var thongbao = 'Thay đổi thành truyện mới thành công';
            }else if(truyennoibat == 1){
                var thongbao = 'Thay đổi thành truyện nổi bật thành công';
            }else{
                var thongbao = 'Thay đổi thành truyện xem nhiều thành công';
            }
            $.ajax({
                url:"{{url('/truyennoibat')}}",
                method:"POST",
                data:{truyennoibat:truyennoibat,truyen_id:truyen_id,_token:_token},
                success:function(data){
                    alert(thongbao);
                }
            })
        })
    </script>
</body>
</html>