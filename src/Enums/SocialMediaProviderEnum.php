<?php

declare(strict_types=1);

namespace PoP\EverythingElse\Enums;

use PoP\ComponentModel\Enums\AbstractEnum;

class SocialMediaProviderEnum extends AbstractEnum
{
    public const NAME = 'SocialMediaProvider';

    protected function getEnumName(): string
    {
        return self::NAME;
    }
    public function getValues(): array
    {
        return [
            'facebook' => \GD_SOCIALMEDIA_PROVIDER_FACEBOOK,
            'linkedin' => \GD_SOCIALMEDIA_PROVIDER_LINKEDIN,
            'twitter' => \GD_SOCIALMEDIA_PROVIDER_TWITTER,
        ];
    }
}
