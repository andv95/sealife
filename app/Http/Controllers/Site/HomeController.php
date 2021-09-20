<?php

namespace App\Http\Controllers\Site;

use App\Facade\CacheStatic;
use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Traits\JsonResponseTrait;
use App\Mail\Site\SendMail;
use App\Models\Page;
use App\Models\ZBanner;
use App\Models\ZContact;
use App\Models\ZCruise;
use App\Models\ZDestination;
use App\Models\ZDuration;
use App\Models\ZEvent;
use App\Models\ZGalleryType;
use App\Models\ZInquiry;
use App\Models\ZInsPhoto;
use App\Models\ZNewsletter;
use App\Models\ZNewsPost;
use App\Models\ZNewsType;
use App\Models\ZPackage;
use App\Models\ZPopularKey;
use App\Models\ZProperty;
use App\Models\ZReview;
use App\Models\ZSpecialOffer;
use App\Models\ZTransfer;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class HomeController extends BaseController
{
    use JsonResponseTrait, SEOTools;

    public function __construct()
    {
//        $this->middleware('minifyHtml')->only('home');
        $this->middleware('page-cache')->only(
            'home',
            'getPackage',
            'getCruise',
            'getPage',
            'getGalleries'
        );
//        $this->middleware('xhprof')->only('home');
    }

    private function setSeo($title, $description, $keywords)
    {
        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->metatags()->setKeywords($keywords);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->addImages(['https://www.sealifegroup.com/storage/files/Banner_homepage_sunset_sealife.jpg']);
        $this->seo()->jsonLd()->addValue('headline', $title);
        $this->seo()->jsonLd()->addValue('author', 'Sealifegroup');
        $this->seo()->jsonLd()->setType('Article');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory|mixed
     */
    function checkStaticFile(Request $request)
    {
        if (!$request->user() && CacheStatic::accessCache($request)) {
            $request_path = CacheStatic::buildFilename($request);
            $cache_html   = public_path(config('site_config.static_cache.cache_path_prefix') . '/' . $request_path . '.html');
            if (file_exists($cache_html)) {
                return response(file_get_contents($cache_html))->withHeaders(['cache-file' => true]);
            }
        }
        return false;
    }

    public function home(Request $request)
    {
//        if ($cache_html = $this->checkStaticFile($request)) {
//            return $cache_html;
//        }

        $zProperties = ZProperty::getEloquentList([], ['zCruisesActiveAtHome'])->withTranslation()->active()->showAtHome()->get();
        $insPhotos   = ZInsPhoto::getArrayActiveAndKeyByPosition();

        $zBanner      = ZBanner::getListActiveByType(ZBanner::TYPE_HOME);
        $zPopularKeys = ZPopularKey::getCustomList();
        $zReviews     = cache()->remember('home', now()->addDay(), function () {
            return ZReview::getEloquentList()->withTranslation()->active()->showAtHome()->get();
        });
        $isHome       = true;

        //Search
        $zDurations    = ZDuration::getEloquentList()->withTranslation()->active()->get();
        $zDestinations = ZDestination::getListToSearch();

        if ($page = Page::getByFixedSlug(Page::PAGE_FIXED_HOME)) {
            $this->setSeo($page->getSeoTitle(), $page->getSeoKeywords(), $page->getSeoDesc());
        }
//        return '';

        return view("site.pages.home", compact("zProperties", "insPhotos", 'zDurations', 'zDestinations', 'zBanner', 'zPopularKeys', 'zReviews', 'isHome'));
    }

    public function getCruise(Request $request, $slug)
    {
        if ($cache_html = $this->checkStaticFile($request)) {
            return $cache_html;
        }

        $zCruise = ZCruise::getBySlug($slug, ["zRoomsActive", "zPostsActive", "zPackagesActive"]);

        if (!$zCruise) {
            abort(Helper::HTTP_NOT_FOUND);
        }

        $insPhotos  = ZInsPhoto::getArrayActiveAndKeyByPosition();
        $zRooms     = $zCruise->zRoomsActive;
        $zPosts     = $zCruise->zPostsActive;
        $zPackages  = $zCruise->zPackagesActive;
        $zBanner    = ZBanner::getListActiveByType(ZBanner::TYPE_CRUISE, $zCruise->getKey());
        $bannerMenu = true;

        $this->setSeo($zCruise->getSeoTitle(), $zCruise->getSeoDesc(), $zCruise->getSeoKeywords());

        return view(
            "site.pages.cruise",
            compact('insPhotos', 'zCruise', 'zRooms', "zPosts", "zPackages", "zBanner", 'bannerMenu')
        );
    }

    public function getPackage(Request $request, $slug = null)
    {
        if ($cache_html = $this->checkStaticFile($request)) {
            return $cache_html;
        }

        $zPackage = ZPackage::getBySlug(
            $slug,
            ['zPostsActive', 'zDestinationsActive', 'zOffersActive', 'zReviewsActive']
        );

        if (!$zPackage) {
            abort(Helper::HTTP_NOT_FOUND);
        }

        $id_pk_nha_hang = (int)setting('site_package.pk_nha_hang');

        $zDestinations = $zPackage->zDestinationsActive;
        $zOffers       = $zPackage->zOffersActive;
        $zPosts        = $zPackage->zPostsActive;
        $images        = $zPackage->getImages();
        $itineraries   = $zPackage->getItineraries();

        $zReviews         = $zPackage->getZReviewsPaginate();
        $zReviewsNextPage = !!$zPackage->getZReviewsPaginate(2)->count();

        $date = date_create_from_format('Y-m-d', $request->get('date'));
        $date = ($date ? $date->format('Y-m-d') : null);
        $date = ($date && $date > date('Y-m-d') ? $date : null);

        $apiRoomsWithZRooms = $zPackage->getApiRoomsByDateWithZRoom($date);

        $this->setSeo($zPackage->getSeoTitle(), $zPackage->getSeoDesc(), $zPackage->getSeoKeywords());

        return view(
            'site.pages.package',
            compact(
                'zPackage', 'zDestinations', 'zPosts',
                'zOffers', 'images', 'itineraries', 'zReviews',
                'zReviewsNextPage', 'date', 'apiRoomsWithZRooms',
                'id_pk_nha_hang'
            )
        );
    }

    public function getPackagePriceAndRoomsByDate(Request $request)
    {
        try {
            $zPackage       = ZPackage::getById($request->get("package_id"));
            $id_pk_nha_hang = (int)setting('site_package.pk_nha_hang');

            if (!$zPackage || !$zPackage->isActive() || !$zPackage->hasTranslation()) {
                return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND);
            }

            $date = date_create_from_format("Y-m-d", $request->get('date'));
            $date = ($date ? $date->format("Y-m-d") : null);
            $date = ($date && $date > date("Y-m-d") ? $date : null);

            $apiRoomsWithZRooms = $zPackage->getApiRoomsByDateWithZRoom($date);

            $priceHtml = view(
                'site.pages.sub.package-detail-price',
                ['date' => $date, 'zPackage' => $zPackage, 'id_pk_nha_hang' => $id_pk_nha_hang]
            )->render();

            $roomsHtml = view(
                'site.includes.room-slider',
                [
                    'rooms'       => $apiRoomsWithZRooms,
                    'date'        => $date,
                    'zPackage'    => $zPackage,
                    'pk_nha_hang' => $id_pk_nha_hang == $zPackage->id,
                ]
            )->render();

            return $this->ajaxSuccessResponse([
                'price'     => $priceHtml,
                'rooms'     => $roomsHtml,
                'roomApiId' => $zPackage->getMinPriceByDate($date)['roomApiId']
            ]);
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function getPackageReviews(Request $request)
    {
        try {
            if (!$page = $request->get("page")) {
                return $this->ajaxErrorResponse(Helper::HTTP_BAD_REQUEST);
            }

            $zPackage = ZPackage::getById($request->get("package_id"));

            if (!$zPackage || !$zPackage->isActive() || !$zPackage->hasTranslation()) {
                return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND);
            }

            $zReviews = $zPackage->getZReviewsPaginate($page);
            $nextPage = !!$zPackage->getZReviewsPaginate($page + 1)->count();

            $html = view("site.includes.package-review-items", [
                "zReviews" => $zReviews
            ])->render();

            return $this->ajaxSuccessResponse(["html" => $html, "hasNextPage" => $nextPage]);
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function getNewsTypes()
    {
        $rootZNewsTypes     = ZNewsType::getShowList();
        $latestZNewsPosts   = ZNewsPost::getLatestList(3, [], true);
        $featured1ZNewsPost = ZNewsPost::getFeaturedPost(1);
        $featured2ZNewsPost = ZNewsPost::getFeaturedPost(2);

        /*
        $excerptZNewsPostIds = Collection::make()
            ->merge($latestZNewsPosts);

        if ($featured1ZNewsPost) {
            $excerptZNewsPostIds = $excerptZNewsPostIds->push($featured1ZNewsPost);
        }

        if ($featured2ZNewsPost) {
            $excerptZNewsPostIds = $excerptZNewsPostIds->push($featured2ZNewsPost);
        }

        $excerptZNewsPostIds = $excerptZNewsPostIds->pluck("id")->toArray();
        */
        $excerptZNewsPostIds = [];

        if ($page = Page::getByFixedSlug(Page::PAGE_FIXED_NEWS_TYPE_LIST)) {
            $this->setSeo($page->getSeoTitle(), $page->getSeoKeywords(), $page->getSeoDesc());
        }

        return view(
            'site.pages.news-type-list',
            compact(
                "rootZNewsTypes", "latestZNewsPosts",
                "featured1ZNewsPost", "featured2ZNewsPost",
                "excerptZNewsPostIds"
            )
        );
    }

    public function getNewsType($slug)
    {
        if (!$data = ZNewsType::getBySlug($slug, ["zNewsTypesChildren"])) {
            abort(Helper::HTTP_NOT_FOUND);
        }

        $rootZNewsTypes     = ZNewsType::getShowList();
        $featured1ZNewsPost = ZNewsPost::getFeaturedPost(1);

        $dataPosts = $data->getPostListPaginate(1, ZNewsPost::POST_PAGE_SIZE);
        $nextPage  = !!$data->getPostListPaginate(2, ZNewsPost::POST_PAGE_SIZE)->count();

        $this->setSeo($data->getSeoTitle(), $data->getSeoDesc(), $data->getSeoKeywords());

        return view(
            'site.pages.news-type-detail',
            compact("rootZNewsTypes", "featured1ZNewsPost", "data", "dataPosts", "nextPage")
        );
    }

    public function getNewsTypePosts(Request $request)
    {
        try {
            if (!$page = $request->get("page")) {
                return $this->ajaxErrorResponse(Helper::HTTP_BAD_REQUEST);
            }

            $zNewsType = ZNewsType::getById($request->get("news_type_id"));

            if (!$zNewsType || !$zNewsType->isActive()) {
                return $this->ajaxErrorResponse(Helper::HTTP_NOT_FOUND);
            }

            $zNewsPosts = $zNewsType->getPostListPaginate($page, ZNewsPost::POST_PAGE_SIZE);
            $nextPage   = !!$zNewsType->getPostListPaginate($page + 1, ZNewsPost::POST_PAGE_SIZE)->count();

            $html = view("site.includes.news-post-items", [
                "zNewsPosts" => $zNewsPosts
            ])->render();

            return $this->ajaxSuccessResponse(["html" => $html, "hasNextPage" => $nextPage]);
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function getNewsPost($slug)
    {
        if (!$data = ZNewsPost::getBySlug($slug, ['rates'])) {
            abort(Helper::HTTP_NOT_FOUND);
        }

        $rates = $data->rate_avg();

        $dataZNewsType     = $data->getZNewsType();
        $relatedZNewsPosts = ZNewsPost::getListByTypeIds(
            $dataZNewsType ? $dataZNewsType->getKey() : [],
            $data->getKey(),
            4
        );
        $relatedZPackages  = $data->getRelatedPackages();

        $this->setSeo($data->getSeoTitle(), $data->getSeoDesc(), $data->getSeoKeywords());

        return view(
            'site.pages.news-post-detail',
            compact("data", 'rates', "dataZNewsType", "relatedZNewsPosts", "relatedZPackages")
        );
    }

    public function getGalleries(Request $request, $slug = '')
    {
        if ($cache_html = $this->checkStaticFile($request)) {
            return $cache_html;
        }

        if (!$slug) {
            $zGalleryTypeFirst = ZGalleryType::getEloquentList()->active()->first();
            $slug              = $zGalleryTypeFirst->slug;
        }

        if (!$zGalleryType = ZGalleryType::getBySlug($slug, ['zGalleriesActive'])) {
            abort(Helper::HTTP_NOT_FOUND);
        }

        $zGalleryTypes = ZGalleryType::getRootList();
        $zGallery      = $zGalleryType->zGalleriesActive->first();
        $insPhotos     = ZInsPhoto::getArrayActiveAndKeyByPosition();

        $this->setSeo($zGalleryType->getSeoTitle(), $zGalleryType->getSeoDesc(), $zGalleryType->getSeoKeywords());

        return view('site.pages.gallery', compact('insPhotos', 'zGallery', 'zGalleryTypes'));
    }

    public function getSpecialOffers(Request $request)
    {
        $zSpecialOffers = ZSpecialOffer::getEloquentList()
            ->orderBy("order_no", "asc")
            ->active()
            ->get();

        //Search
        $zDurations             = ZDuration::getEloquentList()->active()->get();
        $zDestinations          = ZDestination::getListToSearch();
        $selectedDestinationIds = $request->get("destinations", []);
        $selectedDurationIds    = array_filter($request->get("durations", []));
        $selectedSpecialOfferId = $request->get("special_offer");

        //Date
        $date = date_create_from_format("Y-m-d", $request->get('date'));
        $date = ($date ? $date->format("Y-m-d") : null);

        if ($date) {
            $date = ($date && $date > date("Y-m-d") ? $date : now()->addDay()->format("Y-m-d"));
        }

        //zPackages filters.
        $zPackages = ZPackage::getPackagesFilter([
            "destination_ids"   => array_filter($selectedDestinationIds),
            "duration_ids"      => array_filter($selectedDurationIds),
            "special_offer_ids" => $selectedSpecialOfferId ? [$selectedSpecialOfferId] : []
        ]);

        if ($page = Page::getByFixedSlug(Page::PAGE_FIXED_SPECIAL_OFFERS)) {
            $this->setSeo($page->getSeoTitle(), $page->getSeoKeywords(), $page->getSeoDesc());
        }

        return view(
            'site.pages.special-offer',
            compact(
                "zSpecialOffers", "zDestinations", "zDurations",
                "selectedDestinationIds", "selectedDurationIds", "zPackages",
                "selectedSpecialOfferId", "date"
            )
        );
    }

    public function getFilterPackages(Request $request)
    {
        try {
            $specialOfferId = $request->get("special_offer");

            //zPackages filters.
            $zPackages = ZPackage::getPackagesFilter([
                "destination_ids"   => array_filter($request->get("destinations", [])),
                "duration_ids"      => array_filter($request->get("durations", [])),
                "special_offer_ids" => $specialOfferId ? [$specialOfferId] : []
            ]);

            $html = "";

            //Date
            $date = date_create_from_format("Y-m-d", $request->get('date'));
            $date = ($date ? $date->format("Y-m-d") : null);

            if ($date) {
                $date = ($date && $date > date("Y-m-d") ? $date : now()->addDay()->format("Y-m-d"));
            }

            foreach ($zPackages as $item) {
                $html .= view(
                    "site.includes.offer-package-item",
                    ["item" => $item, "date" => $date]
                )->render();
            }

            return $this->ajaxSuccessResponse($html);
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function getPage(Request $request, $slug)
    {
        if ($cache_html = $this->checkStaticFile($request)) {
            return $cache_html;
        }

        $page = Page::getPageBySlug($slug);

        if (!$page) {
            abort(Helper::HTTP_NOT_FOUND);
        }

        //Set seo
        $this->setSeo($page->getSeoTitle(), $page->getSeoKeywords(), $page->getSeoDesc());

        return view($page->getViewName(), compact("page"));
    }

    public function ajaxNewsLetter(Request $request)
    {
        try {
            $data = $request->only("mail_address", 'g-recaptcha-response', 'name');

            $validate = Validator::make(
                $data,
                [
                    "mail_address" => "required|email|max:50",
                    //'g-recaptcha-response' => 'required|captcha',
                ]
            );

            if ($validate->fails()) {
                return $this->ajaxErrorResponse(Helper::HTTP_BAD_REQUEST, $validate->errors()->all());
            }
            Log::debug(sprintf('newsletter: %s - %s - %s - %s', $data['mail_address'], $data['name'], $request->ip(), $request->header('referer')));

            if (ZNewsletter::storeUpdate($data)) {
                if (empty($data['name'])) {
                    //Send mail.
                    Mail::to($data["mail_address"])->send(
                        new SendMail(
                            'site.mails.newsletter',
                            ['email' => $data['mail_address']],
                            ["subject" => __("site_global.mails_subject_newsletter")]
                        )
                    );
                }

                return $this->ajaxSuccessResponse([], __("site_global.message_store_newsletter_success"));
            }

            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, "Something went wrong :(");
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function ajaxContact(Request $request)
    {
        try {
            $data = $request->only(
                "first_name", "last_name",
                "email", "phone",
                "looking_for", "interested_in",
                "something_else",
                "g-recaptcha-response"
            );

            $validate = Validator::make(
                $data,
                [
                    "first_name"           => "required|string|max:50",
                    "last_name"            => "required|string|max:50",
                    "email"                => "required|email|max:50",
                    "phone"                => "required|string|max:20",
                    "looking_for"          => "required|string|max:500",
                    "interested_in"        => "required|string|max:500",
                    "something_else"       => "required|string|max:500",
                    'g-recaptcha-response' => 'required|captcha',
                ]
            );

            if ($validate->fails()) {
                return $this->apiErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    $validate->errors()->toArray()
                );
            }

            if ($zContact = ZContact::storeUpdate($data)) {
                Mail::to($data["email"])->send(
                    new SendMail(
                        'site.mails.contact-us',
                        compact("zContact"),
                        ["subject" => __("site_global.mails_subject_contact")]
                    )
                );

                return $this->ajaxSuccessResponse([
                    'redirectUrl' => localeRoute("thank_you", ["type" => "contact-us"])
                ], __("site_global.message_store_contact_success"));
            }

            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, "Something went wrong :(");
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function getSendInquiry(Request $request)
    {
        try {
            $dateConvert = date_create_from_format("Y-m-d", $request->get('date'));
            $date        = ($dateConvert ? $dateConvert->format("Y-m-d") : null);
            $date        = ($date && $date > date("Y-m-d") ? $date : null);

            if (!$date) {
                return "Date is invalid. Please try again later.";
            }

            if (!$roomId = $request->get("room_id")) {
                $page_contact = Page::getById(2);
                return redirect(url($page_contact->translate()->slug) . '?looking_for=' . $date);
                //return "RoomId has not found.";
            }

            $zPackage = ZPackage::getById(
                $request->get('package_id'),
                ["zDurationActive", "zTransfersActive"]
            );

            if (!$zPackage || !$zPackage->isActive() || !$zPackage->hasTranslation()) {
                return "Package has not found.";
            }

            if (!$zDuration = $zPackage->zDurationActive) {
                return "Package 's duration has not found";
            }

            if (!$apiRoom = $zPackage->getApiInfoByRoomIdAndDateWithZRoom($roomId, $date)) {
                return "Api room or room has not found.";
            }

            $dateFormat       = Carbon::parse($date)->translatedFormat(ZInquiry::FORMAT_START_DATE);
            $returnDateFormat = Carbon::parse($date)
                ->addDays($zDuration->getPointNight())
                ->translatedFormat(ZInquiry::FORMAT_START_DATE);

            $zRooms              = $zPackage->getApiRoomsByDateWithZRoom($date)->pluck("z_room");
            $titles              = ZInquiry::TITLES;
            $transfers           = $zPackage->zTransfersActive;
            $selectingZRoom      = $apiRoom["z_room"];
            $promotionText       = __("site_global.label_promotion_flexible");
            $priceFloatPerRoom   = $apiRoom["price"];
            $isFlexiblePromotion = !empty($request->get("is_flexible_promotion"));
            $countries           = Helper::getCountriesByLocale();

            $numberOfRoomText = $request->get("number_of_room", "01");
            $numberOfRoom     = (int)$numberOfRoomText;
            $numberOfRoom     = ($numberOfRoom > 0 ? $numberOfRoom : 1);

            if (!$isFlexiblePromotion && array_key_exists("promotion", $apiRoom)) {
                $promotionText     = $apiRoom["promotion"]["title"];
                $priceFloatPerRoom = $apiRoom["promotion"]["price"];
            }

            $promotionPrice = $zPackage->getPriceTextDisplay([
                'prefix' => @$apiRoom["price_prefix"],
                'price'  => $priceFloatPerRoom * $numberOfRoom,
                'unit'   => ""
            ]);

            if ($page = Page::getByFixedSlug(Page::PAGE_FIXED_SEND_INQUIRY)) {
                $this->setSeo($page->getSeoTitle(), $page->getSeoKeywords(), $page->getSeoDesc());
            }

            return view('site.pages.send-inquiry',
                compact(
                    'date', 'zPackage', 'dateFormat',
                    'zRooms', 'titles', 'transfers', "roomId", "apiRoom",
                    "selectingZRoom", "promotionText", "promotionPrice",
                    "isFlexiblePromotion", "returnDateFormat", "countries",
                    "priceFloatPerRoom", "numberOfRoomText"
                )
            );
        } catch (Throwable $exception) {
            abort(Helper::HTTP_SERVER_ERROR);
        }
    }

    public function postSendInquiry(Request $request)
    {
        try {
            $data = $request->only(
                "z_package_id", "start_date",
                "quantity_adults", "quantity_children",
                "quantity_infants", "transfer",
                "title", "name", "country",
                "email", "phone", "special_request", 'confirm_email',
                "z_room_api_id", "is_flexible_promotion", "number_of_room",
                "g-recaptcha-response"
            );

            $validate = Validator::make(
                $data,
                [
                    "z_package_id"          => "required",
                    "start_date"            => "required|date_format:Y-m-d",
                    "title"                 => ["required", Rule::in(ZInquiry::TITLES)],
                    "transfer"              => ["nullable", Rule::in(ZTransfer::getList()->pluck("id")->toArray())],
                    "name"                  => "required|string|max:100",
                    "country"               => "required|string|max:100",
                    "email"                 => "required|email|max:50",
                    "confirm_email"         => "required|same:email|max:50",
                    "phone"                 => "nullable|string|max:20",
                    "special_request"       => "nullable|string|max:2000",
                    "quantity_adults"       => "required|regex:/^[0-9]*$/|numeric|min:1|max:9",
                    "quantity_children"     => "required|regex:/^[0-9]*$/|numeric|min:0|max:9",
                    "quantity_infants"      => "required|regex:/^[0-9]*$/|numeric|min:0|max:9",
                    "z_room_api_id"         => "required",
                    "number_of_room"        => "required|min:1|max:99|numeric",
                    "is_flexible_promotion" => "boolean",
                    'g-recaptcha-response'  => 'required|captcha',
                ]
            );

            if ($validate->fails()) {
                return $this->apiErrorResponse(Helper::HTTP_BAD_REQUEST, $validate->errors()->toArray());
            }

            $date = $request->get("start_date");
            if ($date < date("Y-m-d")) {
                return $this->ajaxErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    __("site_global.message_send_inquiry_none_date")
                );
            }

            $zPackage = ZPackage::getById($request->get('z_package_id'));
            if (!$zPackage || !$zPackage->isActive() || !$zPackage->hasTranslation()) {
                return $this->ajaxErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    __("site_global.message_send_inquiry_none_package")
                );
            }

            $roomApiId = $request->get("z_room_api_id");
            if (!$apiRoom = $zPackage->getApiInfoByRoomIdAndDateWithZRoom($roomApiId, $date)) {
                return $this->ajaxErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    __("site_global.message_send_inquiry_none_room_api_id")
                );
            }

            $promotionText       = __("site_global.label_promotion_flexible");
            $price               = $apiRoom["price"];
            $isFlexiblePromotion = !empty($request->get("is_flexible_promotion"));

            if (!$isFlexiblePromotion && array_key_exists("promotion", $apiRoom)) {
                $promotionText = $apiRoom["promotion"]["title"];
                $price         = $apiRoom["promotion"]["price"];
            }

            $price = (int)$price * (int)$request->get("number_of_room");

            $zRoom                   = $apiRoom["z_room"];
            $data["z_room_id"]       = $zRoom->getKey();
            $data["promotion_text"]  = $promotionText;
            $data["promotion_price"] = $apiRoom["price_prefix"] . $price;

            if ($zInquiry = ZInquiry::storeUpdate($data)) {
                Mail::to($data["email"])->send(
                    new SendMail(
                        'site.mails.send-inquiry',
                        compact("zInquiry", "zPackage", "zRoom"),
                        ["subject" => __(
                            "site_global.mails_subject_send_inquiry",
                            ["packageName" => $zPackage->name, "date" => $zInquiry->getStartDateDisplay()]
                        )]
                    )
                );

                return $this->ajaxSuccessResponse([
                    'redirectUrl' => localeRoute("thank_you", ["type" => "send-inquiry"])
                ], __("site_global.message_store_inquiry_success"));
            }

            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, "Something went wrong :(");
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function refreshSendInquiry(Request $request)
    {
        try {
            $dateConvert = date_create_from_format("Y-m-d", $request->get('start_date'));
            $date        = ($dateConvert ? $dateConvert->format("Y-m-d") : null);
            $date        = ($date && $date > date("Y-m-d") ? $date : null);

            if (!$date) {
                return $this->ajaxErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    __("site_global.message_send_inquiry_none_date")
                );
            }

            $zPackage = ZPackage::getById($request->get('z_package_id'));
            if (!$zPackage || !$zPackage->isActive() || !$zPackage->hasTranslation()) {
                return $this->ajaxErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    __("site_global.message_send_inquiry_none_package")
                );
            }

            if (!$zDuration = $zPackage->zDurationActive) {
                return "Package 's duration has not found";
            }

            $roomApiId = $request->get("z_room_api_id");
            if (!$apiRoom = $zPackage->getApiInfoByRoomIdAndDateWithZRoom($roomApiId, $date)) {
                return $this->ajaxErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    __("site_global.message_send_inquiry_none_room_api_id")
                );
            }

            $dateFormat       = Carbon::parse($date)->translatedFormat(ZInquiry::FORMAT_START_DATE);
            $returnDateFormat = Carbon::parse($date)
                ->addDays($zDuration->getPointNight())
                ->translatedFormat(ZInquiry::FORMAT_START_DATE);

            $promotionText       = __("site_global.label_promotion_flexible");
            $priceFloatPerRoom   = $apiRoom["price"];
            $isFlexiblePromotion = !empty($request->get("is_flexible_promotion"));

            $numberOfRoom = (int)$request->get("number_of_room");
            $numberOfRoom = ($numberOfRoom > 0 ? $numberOfRoom : 1);

            if (!$isFlexiblePromotion && array_key_exists("promotion", $apiRoom)) {
                $promotionText     = $apiRoom["promotion"]["title"];
                $priceFloatPerRoom = $apiRoom["promotion"]["price"];
            }

            $promotionPrice = $zPackage->getPriceTextDisplay([
                'prefix' => $apiRoom["price_prefix"],
                'price'  => $priceFloatPerRoom * $numberOfRoom,
                'unit'   => "",
            ]);

            $data["z_room_id"]       = $apiRoom["z_room"]->getKey();
            $data["promotion_text"]  = $promotionText;
            $data["promotion_price"] = $promotionPrice;

            return $this->ajaxSuccessResponse([
                "promotionText"       => $promotionText,
                "promotionPrice"      => $promotionPrice,
                "isFlexiblePromotion" => (int)$isFlexiblePromotion,
                "returnDateFormat"    => $returnDateFormat,
                "dateFormat"          => $dateFormat,
                "roomName"            => $apiRoom["z_room"]->name,
                "price"               => $priceFloatPerRoom
            ]);
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function ajaxEvent(Request $request)
    {
        try {
            $data = $request->only(
                "service", "group_size", "email", "event_detail", "g-recaptcha-response"
            );

            $validate = Validator::make(
                $data,
                [
                    "service"              => "required|string|max:100",
                    "group_size"           => "required|string|max:255",
                    "email"                => "required|email|max:100",
                    "event_detail"         => "nullable|string|max:500",
                    'g-recaptcha-response' => 'required|captcha',
                ]
            );


            if ($validate->fails()) {
                return $this->apiErrorResponse(
                    Helper::HTTP_BAD_REQUEST,
                    $validate->errors()->toArray()
                );
            }

            if ($zEvent = ZEvent::storeUpdate($data)) {
                Mail::to($data["email"])->send(
                    new SendMail(
                        'site.mails.event',
                        compact("zEvent"),
                        ["subject" => __("site_global.mails_subject_event")]
                    )
                );

                return $this->ajaxSuccessResponse([
                    'redirectUrl' => localeRoute("thank_you", ["type" => "mice"])
                ], __("site_global.message_store_event_success"));
            }

            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, "Something went wrong :(");
        } catch (Throwable $exception) {
            return $this->ajaxErrorResponse(Helper::HTTP_SERVER_ERROR, $exception->getMessage());
        }
    }

    public function getThankYou($type)
    {
        if (!in_array($type, ['send-inquiry', 'contact-us', 'mice'])) {
            abort(Helper::HTTP_NOT_FOUND);
        }

        $zBanner = ZBanner::getListActiveByType(ZBanner::TYPE_THANK_YOU);

        return view("site.pages.thank-you", [
            "slug"    => Str::of($type)->studly()->snake(),
            "zBanner" => $zBanner
        ]);
    }

    function optimize_clear()
    {
        Artisan::call("optimize:clear");

        return "php artisan optimize:clear is done !";
    }
}
