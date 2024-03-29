<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css"/>
 
    
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.4.0/css/autoFill.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/> -->

    <link rel="stylesheet" href="{{ url('frontend/style/styles.css') }}" />

    <title>Paduan Suara Universitas Pancasila | Home</title>
</head>
<body>
    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
        <div class="container">
            <a class="navbar-brand" href="#">PSUP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/inventaris">Inventaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/report">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center d-flex py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
              <img src="{{asset('img/logo.png')}}" style="width: 50px" />
              {{-- <i class="fas fa fa-music me-2"></i> --}}
              <div class="">
                <div style="color: black;font-size: 12pt">Paduan Suara </div>
                <div style="color: black;font-size: 8pt">Universitas Pancasila</div>
              </div>
            </div>
            <div class="list-group list-group-flush my-3">
              @php($user = Auth::user()->getRoleNames()[0])
                <a href="{{ route('dashboard') }}"
                    class="list-group-item list-group-item-action bg-transparent second-text {{ request()->is('/') ? 'active' : '' }}"><i
                        class="fa-solid fa-house-chimney me-2"></i>Beranda</a>
              @if($user != 'Ukm')
                <a href="{{ route('kategori.index') }}"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('kategori') ? 'active' : '' }}"><i
                        class="fas fa-stream me-2"></i>Kategori</a>
                <a href="{{ route('barang.index') }}"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('barang') ? 'active' : '' }}"><i
                        class="fa fa-shopping-bag me-2"></i>Barang</a>
                <a href="{{ route('stok.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('stok') ? 'active' : '' }}"><i class="fas fa-paperclip me-2"></i>History Pengembalian</a>
                <a href="{{ route('pemakaian.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('pemakaian') ? 'active' : '' }}"><i class="fas fa-user-clock me-2"></i>Pemakaian</a>
                <a href="{{ route('komplain.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('komplain') ? 'active' : '' }}"><i class="fas fa-comment me-2"></i>Komplain</a>
                <a href="{{ route('perawatan.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('perawatan') ? 'active' : '' }}"><i class="far fa-calendar-check me-2"></i>Perawatan</a>
                <a href="{{ route('pembelian.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('pembelian') ? 'active' : '' }}"><i class="fa-solid fa-cart-shopping me-2"></i>Pembelian</a>
                {{-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-gift me-2"></i>Products</a> --}}
                <a href="{{ route('event.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('event') ? 'active' : '' }}"><i class="fas fa-calendar me-2"></i>Event</a>
                <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('user') ? 'active' : '' }}"><i class="fas fa-user me-2"></i>User</a>
                <a href="{{ route('penanggungjawab')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('penanggungjawab') ? 'active' : '' }}"><i class="fas fa-cog me-2"></i>Penanggungjawab</a>
                {{-- <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-map-marker-alt me-2"></i>Outlet</a> --}}
                {{-- <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a> --}}
              @elseif ($user == 'Ukm')
                <a href="{{ route('pemakaian.create') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('pemakaian/create') ? 'active' : '' }}"><i class="fas fa-user-clock me-2"></i>Peminjaman</a>
                <a href="{{ route('komplain.create') }}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold {{ request()->is('komplain/create') ? 'active' : '' }}"><i class="fas fa-comment me-2"></i>Komplain</a>
              @endif
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Menu</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" type="button" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>{{ auth()->user()->name }}
                          </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                                <form action="{{ route('logout') }}" method="post" id="logout-form"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">

                <div class="container mt-4">
                    @yield('container')
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>


    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.4.0/js/dataTables.autoFill.min.js"></script> -->

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
    @stack('script')

</body>

</html>
