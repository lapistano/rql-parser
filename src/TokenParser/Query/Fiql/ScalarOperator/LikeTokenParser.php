<?php
namespace Mrix\Rql\Parser\TokenParser\Query\Fiql\ScalarOperator;

use Mrix\Rql\Parser\TokenParser\Query\Fiql\AbstractScalarOperatorTokenParser;
use Mrix\Rql\Parser\Node\Query\ScalarOperator\LikeNode;

/**
 */
class LikeTokenParser extends AbstractScalarOperatorTokenParser
{
    /**
     * @inheritdoc
     */
    protected function getOperatorNames()
    {
        return ['like'];
    }

    /**
     * @inheritdoc
     */
    protected function createNode($field, $value)
    {
        return new LikeNode($field, $value);
    }
}
