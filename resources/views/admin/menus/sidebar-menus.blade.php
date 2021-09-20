<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
    data-accordion="false">
    @foreach($menus as $menu1)
        @if(empty($menu1['is_header']))
            <li class="nav-item has-treeview @if(!empty($menu1['isActive'])) menu-open @endif">
                <a href="{{ isset($menu1['routes']) ? route($menu1['routes']['name']) : @$menu1['url'] }}"
                   class="nav-link @if(!empty($menu1['isActive'])) active @endif" title="{{ $menu1['name'] }}"
                   target="{{ @$menu1['target'] ? $menu1['target'] : '_self' }}">
                    <i class="nav-icon fas fa-{{ $menu1['icon'] }}"></i>
                    <p>
                        {{ $menu1['name'] }}
                        @if(is_array(@$menu1['children']) && count($menu1['children']))
                            <i class="right fas fa-angle-left"></i>
                        @endif
                    </p>
                </a>
                @if(is_array(@$menu1['children']) && count($menu1['children']))
                    <ul class="nav nav-treeview">
                        @foreach($menu1['children'] as $menu2)
                            <li class="nav-item">
                                <a href="{{ isset($menu2['routes']) ? route($menu2['routes']['name']) : @$menu2['url'] }}"
                                   class="nav-link @if(!empty($menu2['isActive'])) active @endif"
                                   target="{{ @$menu2['target'] ? $menu2['target'] : '_self' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ $menu2['name'] }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @else
            <li class="nav-header">{{ $menu1['name'] }}</li>
        @endif
    @endforeach
</ul>
