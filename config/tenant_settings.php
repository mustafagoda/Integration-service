<?php

use App\Domain\Shared\Enum\AttributeTypeEnum;
use App\Models\Currency;
use App\Models\Language;

return [
    'languages' => [
        'slug' => 'languages',
        'name' => 'messages.dynamic_settings.languages',
        'description' => 'messages.dynamic_settings.languages_settings',
        'icon' => 'from ui template icons',
        'categories' => [
            [
                'slug' => 'default-language',
                'name' => 'messages.dynamic_settings.default_language',
                'description' => 'messages.dynamic_settings.default_language',
                'icon' => 'from ui template icons',
                'attributes' => [
                    [
                        'slug' => 'default-language',
                        'name' => 'messages.dynamic_settings.default_language',
                        'type' => AttributeTypeEnum::SELECT->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.select_default_language',
                        'placeholder' => null,
                        'options' => Language::class,
                        'value' => config('app.locale'),
                    ]
                ]
            ],
        ]

    ],

    'currencies' => [
        'slug' => 'currencies',
        'name' => 'messages.dynamic_settings.currencies',
        'description' => 'messages.dynamic_settings.currencies_settings',
        'icon' => 'from ui template icons',
        'categories' => [
            [
                'slug' => 'default-currency',
                'name' => 'messages.dynamic_settings.default_currency',
                'description' => 'messages.dynamic_settings.default_currency',
                'icon' => 'from ui template icons',
                'attributes' => [
                    [
                        'slug' => 'default-currency',
                        'name' => 'messages.dynamic_settings.default_currency',
                        'type' => AttributeTypeEnum::SELECT->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.select_default_currency',
                        'placeholder' => null,
                        'options' => Currency::class,
                        'value' => config('app.currency'),
                    ]
                ]
            ],
        ],
    ],

    'basic_settings' => [
        'slug' => 'basic-settings',
        'name' => 'messages.dynamic_settings.basic_settings',
        'description' => 'messages.dynamic_settings.basic_settings',
        'icon' => 'from ui template icons',
        'categories' => [
            [
                'slug' => 'basic-info',
                'name' => 'messages.dynamic_settings.basic_info',
                'description' => 'messages.dynamic_settings.basic_info',
                'icon' => 'from ui template icons',
                'attributes' => [
                    [
                        'slug' => 'logo',
                        'name' => 'messages.dynamic_settings.logo',
                        'type' => AttributeTypeEnum::FILE->value,
                        'validation' => json_encode(['required', 'image', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.upload_logo',
                        'placeholder' => null,
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'favicon',
                        'name' => 'messages.dynamic_settings.favicon',
                        'type' => AttributeTypeEnum::FILE->value,
                        'validation' => json_encode(['required', 'image', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.upload_favicon',
                        'placeholder' => null,
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'tenant-name',
                        'name' => 'messages.dynamic_settings.name',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['required', 'string', 'min:10', 'max:191']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_name',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_name',
                        'options' => null,
                        'value' => null,
                    ],
                ]
            ],
            [
                'slug' => 'contacts',
                'name' => 'messages.dynamic_settings.contact',
                'description' => 'messages.dynamic_settings.contact',
                'icon' => 'from ui template icons',
                'attributes' => [
                    [
                        'slug' => 'tenant-email',
                        'name' => 'messages.dynamic_settings.email',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_email',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_email',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'tenant-phone',
                        'name' => 'messages.dynamic_settings.phone',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_phone',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_phone',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'another-tenant-phone',
                        'name' => 'messages.dynamic_settings.another_phone',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_another_phone',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_another_phone',
                        'options' => null,
                        'value' => null,
                    ]
                ]
            ],
            [
                'slug' => 'social-accounts',
                'name' => 'messages.dynamic_settings.social_accounts',
                'description' => 'messages.dynamic_settings.social_accounts_settings',
                'icon' => 'from ui template icons',
                'attributes' => [
                    [
                        'slug' => 'facebook-link',
                        'name' => 'messages.dynamic_settings.facebook_link',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_facebook_link',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_facebook_link',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'x-link',
                        'name' => 'messages.dynamic_settings.x_link',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_x_link',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_x_link',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'youtube-link',
                        'name' => 'messages.dynamic_settings.youtube_link',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_youtube_link',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_youtube_link',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'snapchat-link',
                        'name' => 'messages.dynamic_settings.snapchat_link',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_snapchat_link',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_snapchat_link',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'instagram-link',
                        'name' => 'messages.dynamic_settings.instagram_link',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_instagram_link',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_instagram_link',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'tiktok-link',
                        'name' => 'messages.dynamic_settings.tiktok_link',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['optional', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_tiktok_link',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_tiktok_link',
                        'options' => null,
                        'value' => null,
                    ]
                ]
            ],
        ],
    ],

    'mail_settings' => [
        'slug' => 'mail-settings',
        'name' => 'messages.dynamic_settings.mail_settings',
        'description' => 'messages.dynamic_settings.mail_settings',
        'icon' => 'from ui template icons',
        'categories' => [
            [
                'slug' => 'mail-settings',
                'name' => 'messages.dynamic_settings.mail_settings',
                'description' => 'messages.dynamic_settings.mail_settings',
                'icon' => 'from ui template icons',
                'attributes' => [
                    [
                        'slug' => 'mail-host',
                        'name' => 'messages.dynamic_settings.mail_host',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_mail_host',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_mail_host',
                        'options' => null,
                        'value' => env('MAIL_HOST'),
                    ],
                    [
                        'slug' => 'mail-username',
                        'name' => 'messages.dynamic_settings.mail_username',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_mail_username',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_mail_username',
                        'options' => null,
                        'value' => env('MAIL_USERNAME'),
                    ],
                    [
                        'slug' => 'mail-password',
                        'name' => 'messages.dynamic_settings.mail_password',
                        'type' => AttributeTypeEnum::PASSWORD->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_mail_password',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_mail_password',
                        'options' => null,
                        'value' => null,
                    ],
                    [
                        'slug' => 'mail-from-address',
                        'name' => 'messages.dynamic_settings.mail_from_address',
                        'type' => AttributeTypeEnum::EMAIL->value,
                        'validation' => json_encode(['required', 'email', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_mail_from_address',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_mail_from_address',
                        'options' => null,
                        'value' => env('MAIL_FROM_ADDRESS'),
                    ], [
                        'slug' => 'mail-port',
                        'name' => 'messages.dynamic_settings.mail_port',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.enter_mail_port',
                        'placeholder' => 'messages.dynamic_settings.tooltip.enter_mail_port',
                        'options' => null,
                        'value' => env('MAIL_PORT'),
                    ]
                ]
            ]
        ],
    ],

    'report_bug_service' => [
        'slug' => 'report-bug-service-settings',
        'name' => 'messages.dynamic_settings.report_bug_settings',
        'description' => 'messages.dynamic_settings.report_bug_settings',
        'icon' => 'from ui template icons',
        'categories' => [
            [
                'slug' => 'jira-integration',
                'name' => 'messages.dynamic_settings.jira_integration',
                'description' => 'messages.dynamic_settings.jira_integration',
                'icon' => 'from ui template icons',
                'attributes' => [
                    [
                        'slug' => 'api-key',
                        'name' => 'messages.dynamic_settings.api_key',
                        'type' => AttributeTypeEnum::TEXT->value,
                        'validation' => json_encode(['required', 'string']),
                        'icon' => 'from ui template icons',
                        'tooltip' => 'messages.dynamic_settings.tooltip.api_key',
                        'placeholder' => 'messages.dynamic_settings.tooltip.api_key',
                        'options' => null,
                        'value' => null,
                    ],
                ]
            ]
        ],
    ],
];
