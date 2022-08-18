<?php

declare(strict_types=1);

namespace PoPCMSSchema\Posts\ConditionalOnContext\AddPostTypeToCustomPostUnionTypes\SchemaServices\ObjectTypeResolverPickers;

use PoPCMSSchema\CustomPosts\TypeResolvers\UnionType\CustomPostUnionTypeResolver;
use PoPCMSSchema\Posts\ObjectTypeResolverPickers\AbstractPostObjectTypeResolverPicker;

class PostCustomPostObjectTypeResolverPicker extends AbstractPostObjectTypeResolverPicker
{
    /**
     * @return array<class-string<\PoP\ComponentModel\TypeResolvers\UnionType\UnionTypeResolverInterface>>
     */
    public function getUnionTypeResolverClassesToAttachTo(): array
    {
        return [
            CustomPostUnionTypeResolver::class,
        ];
    }
}
