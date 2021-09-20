@if($menuItem->isActive())
    <li class="@if($menuItem->isCurrentUrl()) active @endif @if($hasSubMenu) has-sub-menu @endif">
        <a href="{{ $menuItem->getUrl() }}" target="{{ $menuItem->getOpenTarget() }}"
           title="{{ $menuItem->getName() }}">
            {{ $menuItem->getName() }}
        </a>

        {!! $childrenLayout !!}

    </li>
@endif
