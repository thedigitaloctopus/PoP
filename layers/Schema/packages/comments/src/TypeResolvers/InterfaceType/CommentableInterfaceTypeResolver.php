<?php

declare(strict_types=1);

namespace PoPSchema\Comments\TypeResolvers\InterfaceType;

use PoP\ComponentModel\TypeResolvers\InterfaceType\AbstractInterfaceTypeResolver;

class CommentableInterfaceTypeResolver extends AbstractInterfaceTypeResolver
{
    public function getTypeName(): string
    {
        return 'Commentable';
    }

    public function getSchemaTypeDescription(): ?string
    {
        return $this->translationAPI->__('The entity can receive comments', 'comments');
    }
}