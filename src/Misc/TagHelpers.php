<?php

declare(strict_types=1);

namespace PoP\EverythingElse\Misc;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;

class TagHelpers
{
    public static function showTagSymbol()
    {
        return HooksAPIFacade::getInstance()->applyFilters('PoP_TagUtils:showTagSymbol', true);
    }

    public static function getTagSymbol()
    {
        return self::showTagSymbol() ? HooksAPIFacade::getInstance()->applyFilters('PoP_TagUtils:tag_symbol', '#') : '';
    }

    public static function getTagSymbolNameDescription($tag)
    {
        $cmseverythingelseresolver = \PoP\EverythingElse\ObjectPropertyResolverFactory::getInstance();
        $value = $cmseverythingelseresolver->getTagSymbolName($tag);

        // If there's a description, then use it
        if ($description = $cmseverythingelseresolver->getTagDescription($tag)) {
            $value = sprintf(
                TranslationAPIFacade::getInstance()->__('%1$s (%2$s)', 'pop-everythingelse'),
                $value,
                $description
            );
        }

        return $value;
    }

    public static function getTagNameDescription($tag)
    {
        $cmseverythingelseresolver = \PoP\EverythingElse\ObjectPropertyResolverFactory::getInstance();
        $value = $cmseverythingelseresolver->getTagName($tag);

        // If there's a description, then use it
        if ($description = $cmseverythingelseresolver->getTagDescription($tag)) {
            $value = sprintf(
                TranslationAPIFacade::getInstance()->__('%1$s (%2$s)', 'pop-application'),
                $value,
                $description
            );
        }

        return $value;
    }
}
