<section class="high-light {{ !empty($class) ? $class : '' }}">
    <div class="container">
        <h2 class="head-high-light head-high-light-uppercase">{{ $data->long_name }}</h2>
        <p class="sub-head-high-light">{{ $data->sub_name }}</p>
        <div class="content-text-high-light">
            {!! $data->description !!}
        </div>
    </div>
</section>
