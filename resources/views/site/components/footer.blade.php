<!--    Footer of site-->
<footer>
    <div class="container container-ft">
        <div class="list-menu-footer">
            <img loading="lazy" src="{{ @setting('site.logo')['url'] }}" alt="{{ setting("site.shop_name") }}"
                 title="{{ setting("site.shop_name") }}" class="footer-logo" width="160" height="44">
        </div>
        <div class="row list-main-menu-footer">
            <div
                class="col-sm-7 {{ (\App\Models\Language::getCurrentLanguageKey() == 'vi') ? 'col-md-8' : 'col-md-6'}}">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-6">
                        {!! menu("footer_menu_1", ['start_tag' => '<ul class="list-menu-footer">', 'end_tag' => '</ul>']) !!}
                    </div>
                    <div class="col-md-4 col-sm-4 col-6">
                        {!! menu("footer_menu_2", ['start_tag' => '<ul class="list-menu-footer">', 'end_tag' => '</ul>']) !!}
                    </div>
                    <div class="col-md-4 col-sm-4">
                        {!! menu("footer_menu_3", ['start_tag' => '<ul class="list-menu-footer">', 'end_tag' => '</ul>']) !!}
                    </div>
                </div>
            </div>
            <div
                class="{{ (\App\Models\Language::getCurrentLanguageKey() == 'vi') ? 'col-md-4' : 'col-md-6'}} col-sm-5 footer-right">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        {!! menu("footer_menu_4", ['start_tag' => '<ul class="list-menu-footer">', 'end_tag' => '</ul>']) !!}
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        {!! menu("footer_menu_5", ['start_tag' => '<ul class="list-menu-footer">', 'end_tag' => '</ul>']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row list-main-contact-footer">
            <div class="row">
                @php
                    $zDistributors = site_footer_distributor();
                    $dc = $zDistributors->count();
                    $tmp = [1=>12,2=>6,3=>4];
                    $column_number = isset($tmp[$dc]) ? $tmp[$dc] : 3;
                @endphp
                @foreach($zDistributors as $zDistributor)
                    @if($zDistributor->hasTranslation())
                        <div class="col-md-6 col-lg-{{ $column_number }} col-sm-6 contact-footer">
                            <h5>{{ $zDistributor->name }}</h5>
                            <p>
                                H: {!! $zDistributor->getPhone() !!}</p>
                            <p> E: <a href="mailto:{{ $zDistributor->email }}"
                                      title="Email">{{ $zDistributor->email }}</a></p>
                            <p> A: {{ $zDistributor->address }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</footer>
<div class="copy-right">
    <p>{{ setting('site.copy_right') }} </p>
</div>
