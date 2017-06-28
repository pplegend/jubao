<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<!-- Header -->
@include('layouts.header')

<body>
    <!-- Menu -->
    @include('layouts.menu')

    <main class="bs-docs-masthead" id="content">
        <div id="app" class="container-fluid">
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    @include('layouts.js')
    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>
