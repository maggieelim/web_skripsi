@php
$menu = config('sidebar');
$host = request()->getHost(); // ambil domain aktif
@endphp

<aside id="sidenav-main"
    class="sidenav navbar navbar-vertical navbar-expand-xs bg-white border-0 border-radius-xl fixed-start h-100">
    <div class="sidenav-sticky-header sticky-top bg-white">
        <div class="sidenav-header text-center">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0 d-flex justify-content-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/Logo-kedokteran-untar.png') }}" class="navbar-brand-img h-100"
                    alt="Logo">
            </a>
        </div>

    </div>
    <div id="sidenav-collapse-main" class="navbar-collapse"
        style="height: calc(100% - 140px); overflow-y: auto; -webkit-overflow-scrolling: touch;">
        <ul class="navbar-nav">
            @foreach($menu as $section)
            @if(
            (
            !isset($section['roles']) ||
            auth()->user()->hasAnyRole($section['roles'])
            )
            )
            @if($section['title'])
            <x-sidebar-title title="{{ $section['title'] }}" />
            @endif

            @foreach($section['items'] as $item)
            @if(
            !isset($item['roles']) ||
            auth()->user()->hasAnyRole($item['roles'])
            )

            @php
            $pattern = $item['pattern'] ?? '';
            @endphp

            @if(isset($item['route']))
            <x-sidebar-item :route="$item['route']" :params="$item['params'] ?? []" :pattern="$pattern"
                :icon="$item['icon']" :label="$item['label']" />
            @elseif(isset($item['url']))
            <x-sidebar-item :url="$item['url']" :pattern="$pattern" :icon="$item['icon']" :label="$item['label']" />
            @endif

            @endif
            @endforeach
            @endif
            @endforeach

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt text-danger"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>