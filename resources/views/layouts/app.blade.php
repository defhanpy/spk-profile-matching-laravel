<!DOCTYPE html>
<html lang="en">

@include('components.header')

<body id="page-top">

<div id="wrapper">

    {{-- Sidebar --}}
    @include('components.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            {{-- Topbar --}}
            @include('components.topbar')

            {{-- CONTENT --}}
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

        {{-- Footer --}}
        @include('components.footer')
    </div>

</div>

{{-- Scripts --}}
@include('components.scripts')

@stack('scripts')

</body>
</html>
