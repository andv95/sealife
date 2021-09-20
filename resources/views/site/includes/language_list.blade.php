<div class="dropdown dropdown-language my-dropdown">
    <button class="btn my-dropdown-button dropdown-toggle">
        {{ strtoupper(\App\Models\Language::getCurrentLanguageKey()) }}
        <i class="fa2 fa-chevron-down2">
            <svg class="icon">
                <use xlink:href="#down-chevron"></use>
            </svg>
        </i>
    </button>
    <div class="dropdown-menu my-dropdown-menu" aria-labelledby="dropdownMenuButton">
        @php
            $allowLanguages = \App\Models\Language::getSupportedLanguageKeys();
        @endphp

        @foreach($allowLanguages as $item)
            @php
                $translatedUrl = \App\Models\Language::getTranslatedUrlOfCurrentUrl($item);
            @endphp

            <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($item, $translatedUrl, [], true) }}"
               title="{{ $item }}">{{ strtoupper($item) }}</a>
        @endforeach
    </div>
</div>
