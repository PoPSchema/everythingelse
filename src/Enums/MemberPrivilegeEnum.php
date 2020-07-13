<?php

declare(strict_types=1);

namespace PoP\EverythingElse\Enums;

use PoP\ComponentModel\Enums\AbstractEnum;

class MemberPrivilegeEnum extends AbstractEnum
{
    public const NAME = 'MemberPrivilege';

    protected function getEnumName(): string
    {
        return self::NAME;
    }
    public function getValues(): array
    {
        return array_keys((new \GD_URE_FormInput_FilterMemberPrivileges())->getAllValues());
    }
}
