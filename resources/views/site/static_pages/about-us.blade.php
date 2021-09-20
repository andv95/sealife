@extends('site.layouts.master_full_content')
@section('content-full')
    <div id="about-us-page">
        <div class="container">
            <p class="sub-page-title">{{ @$page->titles[0] }}</p>
            <h1 class="page-title" itemprop="headline name">{{ @$page->titles[1] }}</h1>
        </div>
        <div class="about-us-1">
            <div class="container-small">
                <div class="row">
                    <div class="col-md-6 about-us-image-wrapper">
                        <div class="about-us-image">
                            <img src="{{ $page->getImageUrl('about-us-main', $page->images[0]['url']) }}"
                                 alt="{{ @$page->images[0]['alt'] }}"
                                 title="{{ @$page->images[0]['title'] }}"
                                 class="about-us-main-image">
                            <img src="{{ site_asset('image/background_about_us.png') }}" alt="background image"
                                 title="background image"
                                 class="about-us-background">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-us-1-content">
                            <h2 class="section-title">{{ @$page->titles[2] }}</h2>
                            <div class="section-content">
                                {!! @$page->contents[0] !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-us-list">
            <div class="container">
                <h2 class="section-title">{{ @$page->titles[3] }}</h2>
                @for($i=4; $i<20; $i++)
                    @if(!empty($page->images[$i-3]) && !empty($page->titles[$i+1]))
                        <div
                            class="about-us-list-item {{ $i%2==0 ? 'about-us-list-item-image-left' : 'about-us-list-item-image-right' }}">
                            <div class="about-us-image-list about-us-height">
                                <img src="{{ $page->getImageUrl('about-us-list', @$page->images[$i-3]['url']) }}"
                                     title="{{ @$page->images[$i-3]['title'] }}"
                                     alt="{{ @$page->images[$i-3]['alt'] }}">
                            </div>
                            <div class="about-us-content about-us-height">
                                <div class="about-us-center">
                                    @php
                                        $title = $page->titles[$i+1];
                                        $titleArr = explode(',', $title);
                                    @endphp
                                    <h2 class="about-us-title-love">{{ @$titleArr[0] }}</h2>
                                    <h2 class="about-us-title">{{ @$titleArr[1] }}</h2>
                                    <div class="about-us-content-detail">
                                        {!! @$page->contents[$i-3] !!}
                                    </div>
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>

        <div class="meet-our-team">
            <div class="container">
                <h2 class="section-title">{{ @$page->titles[4] }}</h2>
                <div class="meet-our-team-tab">
                    {{--                    <ul class="nav nav-tabs">--}}
                    {{--                        @php--}}
                    {{--                            $branches = \App\Models\ZTeam::BRANCHES;--}}
                    {{--                        @endphp--}}
                    {{--                        @foreach($branches as $branch)--}}
                    {{--                            <li><a data-toggle="tab" href="#branch-{{ $branch }}"--}}
                    {{--                                   class="{{ $loop->first ? 'active' : '' }}">{{ __('admin_table.z_teams.option_branch_'. $branch) }}</a>--}}
                    {{--                            </li>--}}
                    {{--                        @endforeach--}}
                    {{--                    </ul>--}}
                    <div class="tab-content">
                        {{--                        @foreach($branches as $branch)--}}
                        @php
                            //$teams = \App\Models\ZTeam::getListByBranch($branch);
                            $teams = \App\Models\ZTeam::getList();
                        @endphp
                        {{--                            <div id="branch-{{ $branch }}"--}}
                        {{--                                 class="tab-pane fade in {{ $loop->first ? 'active show' : '' }}">--}}
                        <div class="owl-custom-button owl-custom-button-remove">
                            <div class="owl-carousel slider-5 owl-theme meet-our-team-slide">
                                @foreach($teams as $team)
                                    @if($team->hasTranslation())
                                        <div class="item">
                                            <img src="{{ $team->getImageURL() }}"
                                                 alt="{{ $team->image['alt'] }}"
                                                 title="{{ $team->image['title'] }}">
                                            <div class="meet-our-team-item-content">
                                                <h3>{{ @$team->name }}</h3>
                                                <p>{{ @$team->position }}</p>
                                                <div class="meet-our-team-detail">
                                                    {{ @$team->content }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if($teams->count()>5)
                                <button class="custom-back disabled">‹</button>
                                <button class="custom-next">›</button>
                            @endif
                        </div>
                        {{--                            </div>--}}
                        {{--                        @endforeach--}}
                    </div>
                </div>
            </div>
        </div>
        @include('site.includes.newsletter')
    </div>
@endsection


