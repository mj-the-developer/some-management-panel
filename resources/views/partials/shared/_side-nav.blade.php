<div class="admin-marketer-sidebar">
    <div class="admin-marketer-header">
        <div class="row align-items-center">
            <div class="col-9">
                <h3 class="mb-0 font-weight-normal">پنل مدیریت</h3>
            </div>
            <div class="col-3 d-block d-lg-none text-left">
                <span class="fa fa-bars" style="font-size:25px;cursor:pointer;" id="sidebar-toggler"></span>
            </div>
        </div>
    </div>
    <div class="sidebar-wrapper">
        <div class="text-center m-3 border-bottom pb-3">
            <img src={{ asset('images/favicon.png') }} alt="لوگوی صاحب الزمان"/>
        </div>
        <ul class="navigation">
            <li class="nav-item">
                <a href="{{ route('poors.index') }}">
                    <span class="fa fa-heart"></span>
                    <span class="menu-item mr-1">
                        لیست نیازمندان
                    </span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#">
                    <span class="fa fa-money"></span>
                    <span class="menu-item mr-1">
                        پرداخت ها
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <span class="fa fa-gift"></span>
                    <span class="menu-item mr-1">
                        کمک های غیر نقدی
                    </span>
                </a>
            </li> --}}
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item">
                        <span class="fa fa-sign-out"></span>
                        <span class="menu-item mr-1">
                            خروج
                        </span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
