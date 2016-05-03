<header class="main-header">
    {{-- UPPER LEFT LOGO --}}
    <a href="/home" class="logo" style="background-color: #f4f4f4">
        <span class="logo-mini">{!! HTML::image('storage/logoxs.png') !!}</span>
        <span class="logo-lg">{!! HTML::image('storage/logosm.png') !!}</span>
    </a>
    {{-- LOAD TEMPLATE NAVIGATION --}}
    @include('admin.partials.dashboard-nav')
</header>