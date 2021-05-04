<li class="@if (!empty($childs)) nav-parent @endif">
    <a class="nav-link @isset($active) {{active($active)}} @endisset" href="{{$route ?? '#'}}">
        <i class="{{$icon}} m-r-xs"></i>
        <span>{{ __($label) }}</span>        
    </a>
    @if($childs)
    <ul class="nav nav-children">
        {!! Dashboard::menu()->render($slug,'platform::partials.icpacdropdownMenu') !!}
    </ul>
    @endif
</li>
@if($divider)
<hr class="separator">
@endif
