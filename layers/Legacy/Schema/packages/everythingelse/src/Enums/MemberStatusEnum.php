<?php

declare(strict_types=1);

namespace PoPSchema\EverythingElse\Enums;

use PoP\ComponentModel\Enums\AbstractEnumTypeResolver;

class MemberStatusEnum extends AbstractEnumTypeResolver
{
    public function getTypeName(): string
    {
        return 'MemberStatus';
    }
    /**
     * @return array<int|float|bool|string>
     */
    public function getValues(): array
    {
        return array_keys((new \GD_URE_FormInput_MultiMemberStatus())->getAllValues());
    }
}
