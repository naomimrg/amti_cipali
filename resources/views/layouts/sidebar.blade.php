<!-- resources/views/layouts/sidebar.blade.php -->
<div id="sidebar"
    style="width:80px; height:100vh; background:#ffffff; border-radius:12px; padding:10px; box-shadow:0 2px 8px rgba(0,0,0,0.04); position:relative; transition: width 0.25s ease; display:flex; flex-direction:column;">

    <div style="text-align:center; margin-top:20px; margin-bottom:15px;">
        <img id="sidebarLogo" src="{{ url('/assets/img/amti-logo-transparent.png') }}" alt="AMTI Logo"
            style="width:40px; transition: width 0.25s ease;">
    </div>

    <ul id="menuList" style="list-style:none; padding:0; margin:0; flex-grow:1;">
        @php
        $menus = [
        ['name' => 'Home', 'icon' => 'bx bx-home-circle', 'url' => url('/dashboard')],
        ['name' => 'Default Sensor', 'icon' => 'bx bx-cog', 'url' => url('/parameter')],
        ['name' => 'Sensor Client', 'icon' => 'bx bx-list-check', 'url' => url('/client_sensor')],
        ['name' => 'Manage User', 'icon' => 'bx bxs-user-detail', 'url' => url('/vendor')],
        ['name' => 'Manage Account', 'icon' => 'bx bx-grid', 'url' => url('/user')],
        ['name' => 'Manage Admin', 'icon' => 'bx bxs-user-badge', 'url' => url('/admin')],
        ['name' => 'Download Data', 'icon' => 'bx bx-download', 'url' => url('/report')],
        ];
        $current = request()->path();
        @endphp

        @foreach ($menus as $menu)
        @php
        $isActive = str_contains($current, trim(parse_url($menu['url'], PHP_URL_PATH), '/'));
        @endphp
        <li style="margin-bottom:6px;">
            <a href="{{ $menu['url'] }}" class="menu-link" style="
                       display:flex;
                       align-items:center;
                       padding:10px;
                       border-radius:8px;
                       color:{{ $isActive ? '#f37d14' : '#333' }};
                       background:{{ $isActive ? 'rgba(243,125,20,0.1)' : 'transparent' }};
                       text-decoration:none;
                       font-size:14px;
                       font-weight:500;
                       transition: all 0.2s ease;
                   " onmouseover="this.style.background='rgba(243,125,20,0.1)'"
                onmouseout="if(!this.classList.contains('active'))this.style.background='transparent'">
                <i class="{{ $menu['icon'] }}" style="font-size:20px; min-width:24px;"></i>
                <span class="menu-text"
                    style="margin-left:10px; display:none; white-space:nowrap;">{{ $menu['name'] }}</span>
            </a>
        </li>
        @endforeach
    </ul>
    <div id="sidebarFooter" style="text-align:center; padding-bottom:10px;">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            style="display:flex; align-items:center; justify-content:center; text-decoration:none; background:#f37d14; color:#fff; padding:8px 10px; border-radius:20px; font-size:14px; transition: all 0.2s ease;">
            <i class="bx bx-power-off" style="font-size:18px;"></i>
            <span class="menu-text" style="margin-left:8px; display:none;">Log Out</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
    <button id="sidebarToggle" type="button"
        style="position:absolute; top:35%; right:-10px; transform:translateY(-50%); width:34px; height:34px; border-radius:50%; border:1px solid #e6e6e6; background:#fff; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
        <i class="bx bx-chevron-right" aria-hidden="true"></i>
    </button>
</div>

<script>
    (function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const menuTexts = document.querySelectorAll('#menuList .menu-text, #sidebarFooter .menu-text');
        const logo = document.getElementById('sidebarLogo');
        let collapsed = true;

        function applyState() {
            if (collapsed) {
                sidebar.style.width = '80px';
                logo.style.width = '40px';
                menuTexts.forEach(el => el.style.display = 'none');
                toggleBtn.innerHTML = '<i class="bx bx-chevron-right"></i>';
            } else {
                sidebar.style.width = '250px';
                logo.style.width = '100px';
                menuTexts.forEach(el => el.style.display = 'inline');
                toggleBtn.innerHTML = '<i class="bx bx-chevron-left"></i>';
            }
        }

        toggleBtn.addEventListener('click', () => {
            collapsed = !collapsed;
            applyState();
        });

        applyState();
    })();
</script>