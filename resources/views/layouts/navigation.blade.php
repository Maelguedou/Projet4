@if (request()->is('module3/*'))
    @include('components.nav-module3')
@else
    @include('components.nav-module2')
@endif
