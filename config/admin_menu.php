<?php

return [
    [
        "name" => "Cửa hàng",
        "is_header" => true
    ],
    [
        "name" => "Dashboard",
        "icon" => "home",
        "routes" => [
            "name" => "admin.home"
        ]
    ],
    [
        "name" => "Đi tới CRS",
        "target" => "_blank",
        "icon" => "cog",
        "url" => "https://crs.wowme.vn/admin/login",
    ],
    [
        "name" => "Quản lý chung",
        "icon" => "folder",
        "url" => "javascript:void(0);",
        "children" => [
            [
                "name" => "Properties",
                "routes" => [
                    "name" => "admin.z_properties.index",

                ]
            ],
            [
                "name" => "Cruises",
                "routes" => [
                    "name" => "admin.z_cruises.index",

                ]
            ],
            [
                "name" => "Rooms - Suites",
                "routes" => [
                    "name" => "admin.z_rooms.index",

                ]
            ],
            [
                "name" => "Destinations",
                "routes" => [
                    "name" => "admin.z_destinations.index",

                ]
            ],
            [
                "name" => "Durations",
                "routes" => [
                    "name" => "admin.z_durations.index",

                ]
            ],
            [
                "name" => "Offers",
                "routes" => [
                    "name" => "admin.z_offers.index",

                ]
            ],
            [
                "name" => "Special Offers",
                "routes" => [
                    "name" => "admin.z_special_offers.index",

                ]
            ],
            [
                "name" => "Distributors",
                "routes" => [
                    "name" => "admin.z_distributors.index",

                ]
            ],
            [
                "name" => "Popular keys",
                "routes" => [
                    "name" => "admin.z_popular_keys.index",

                ]
            ],
            [
                "name" => "Transfer services",
                "routes" => [
                    "name" => "admin.z_transfers.index",

                ]
            ],
            [
                "name" => "Teams",
                "icon" => "users",
                "routes" => [
                    "name" => "admin.z_teams.index",

                ]
            ],
        ]
    ],
    [
        "name" => "Packages",
        "icon" => "gift",
        "routes" => [
            "name" => "admin.z_packages.index",

        ]
    ],
    [
        "name" => "Banners",
        "icon" => "image",
        "routes" => [
            "name" => "admin.z_banners.index",

        ]
    ],
    [
        "name" => "Experiences",
        "icon" => "newspaper",
        "routes" => [
            "name" => "admin.z_posts.index",

        ]
    ],
    [
        "name" => "Ảnh Instagram",
        "icon" => "images",
        "routes" => [
            "name" => "admin.z_ins_photos.index"
        ]
    ],
    [
        "name" => "Reviews",
        "icon" => "users",
        "routes" => [
            "name" => "admin.z_reviews.index",

        ]
    ],
    [
        "name" => "News",
        "icon" => "building",
        "children" => [
            [
                "name" => "Categories",
                "routes" => [
                    "name" => "admin.z_news_types.index",

                ]
            ],
            [
                "name" => "News Posts",
                "routes" => [
                    "name" => "admin.z_news_posts.index",

                ]
            ]
        ]
    ],
    [
        "name" => "Galleries",
        "icon" => "images",
        "children" => [
            [
                "name" => "Gallery Category",
                "routes" => [
                    "name" => "admin.z_gallery_types.index",

                ]
            ],
            [
                "name" => "Gallery",
                "routes" => [
                    "name" => "admin.z_galleries.index",
                ]
            ]
        ]
    ],
    [
        "name" => "Quản lý form",
        "icon" => "folder",
        "url" => "javascript:void(0);",
        "children" => [
            [
                "name" => "Received Inquiries",
                "icon" => "gift",
                "routes" => [
                    "name" => "admin.z_inquiries.index",

                ]
            ],
            [
                "name" => "Đăng ký nhận tin",
                "icon" => "envelope",
                "routes" => [
                    "name" => "admin.z_newsletters.index"
                ]
            ],
            [
                "name" => "Customer contact",
                "icon" => "address-book",
                "routes" => [
                    "name" => "admin.z_contacts.index",
                ]
            ],
            [
                "name" => "Charter Events",
                "icon" => "envelope",
                "routes" => [
                    "name" => "admin.z_events.index"
                ]
            ],
        ],
    ],
    [
        "name" => "Hệ thống",
        "is_header" => true
    ],
    [
        "name" => "Cài đặt",
        "icon" => "cog",
        "children" => [
            [
                "name" => "Add new",
                "routes" => [
                    "name" => "admin.settings.index"
                ]
            ],
            [
                "name" => "Configs",
                "routes" => [
                    "name" => "admin.settings.configs"
                ]
            ]
        ]
    ],
    [
        "name" => "Quản lý Menu",
        "icon" => "building",
        "children" => [
            [
                "name" => "Menus",
                "routes" => [
                    "name" => "admin.menus.index"
                ]
            ],
            [
                "name" => "Menu items",
                "routes" => [
                    "name" => "admin.menu_items.index"
                ]
            ]
        ]
    ],
    [
        "name" => "Trang nội dung",
        "icon" => "desktop",
        "routes" => [
            "name" => "admin.pages.index"
        ]
    ],
    [
        "name" => "Ngôn ngữ",
        "icon" => "globe",
        "routes" => [
            "name" => "admin.languages.index"
        ]
    ],
    [
        "name" => "Người dùng",
        "icon" => "user",
        "routes" => [
            "name" => "admin.users.index"
        ]
    ],
];
