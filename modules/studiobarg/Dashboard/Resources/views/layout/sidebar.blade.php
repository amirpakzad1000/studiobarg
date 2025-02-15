
<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="/vendors/images/deskapp-logo.svg" alt="" class="dark-logo"/>
            <img
                src="/vendors/images/deskapp-logo-white.svg"
                alt=""
                class="light-logo"
            />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                @php
                    use Illuminate\Support\Str;
                @endphp

                @if(is_array(config('sidebar.items')) && count(config('sidebar.items')))
                    @foreach(config('sidebar.items') as $sidebarItem)
                        @php
                            $currentUrl = url()->current(); // دریافت URL فعلی
                            $sidebarUrl = url($sidebarItem['url']); // اطمینان از کامل بودن آدرس

                            // بررسی اینکه آیا مسیر فعلی با مسیر آیتم منو شروع می‌شود
                            $isActive = Str::startsWith($currentUrl, $sidebarUrl);
                        @endphp
                        <li class="dropdown {{ $isActive ? 'show' : '' }}">
                            <a href="{{ $sidebarItem['url'] }}" class="dropdown-toggle no-arrow">
                                <span class="{{ $sidebarItem['icon'] }}"></span>
                                <span class="mtext">{{ $sidebarItem['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    <p>هیچ آیتمی در سایدبار موجود نیست.</p>
                @endif

            </ul>
        </div>
    </div>
</div>
