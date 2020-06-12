<?php

declare(strict_types=1);

namespace PoP\EverythingElse\FieldResolvers;

use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\EverythingElse\TypeResolvers\TagTypeResolver;
use PoP\EverythingElse\Misc\TagHelpers;

class TagFunctionalFieldResolver extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(TagTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'symbol',
            'symbolnamedescription',
            'namedescription',
            'symbolname',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
            'symbol' => SchemaDefinition::TYPE_STRING,
            'symbolnamedescription' => SchemaDefinition::TYPE_STRING,
            'namedescription' => SchemaDefinition::TYPE_STRING,
            'symbolname' => SchemaDefinition::TYPE_STRING,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
            'symbol' => $translationAPI->__('Tag symbol', 'pop-everythingelse'),
            'symbolnamedescription' => $translationAPI->__('Tag symbol and description', 'pop-everythingelse'),
            'namedescription' => $translationAPI->__('Tag and description', 'pop-everythingelse'),
            'symbolname' => $translationAPI->__('Symbol and tag', 'pop-everythingelse'),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $applicationtaxonomyapi = \PoP\ApplicationTaxonomies\FunctionAPIFactory::getInstance();
        $tag = $resultItem;
        switch ($fieldName) {
            case 'symbol':
                return TagHelpers::getTagSymbol();

            case 'symbolnamedescription':
                return TagHelpers::getTagSymbolNameDescription($tag);

            case 'namedescription':
                return TagHelpers::getTagNameDescription($tag);

            case 'symbolname':
                return $applicationtaxonomyapi->getTagSymbolName($tag);
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
