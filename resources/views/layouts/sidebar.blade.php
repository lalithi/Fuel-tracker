<!-- ========== Left Sidebar Start ========== -->
<style>
#sidebar-menu li.active > a > span.menu-arrow{
    transform: none;
}
</style>
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ url('/home')}}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                  
                </li>
                @if(Auth::user()->isadmin())
                <li>
                    <a href="{{ url('/brands') }}">
                        <i class="fe-pocket"></i>
                        <span> Vehicle Brands </span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/models') }}">
                        <i class="fe-pocket"></i>
                        <span> Vehicle Models </span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ url('/vehicles') }}">
                        <i class="fe-pocket"></i>
                        <span> My Vehicles </span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/fuel-records') }}">
                        <i class="fe-pocket"></i>
                        <span> Fuel Records </span>
                        <span class="menu-arrow"></span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->