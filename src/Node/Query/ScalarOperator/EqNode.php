<?php
namespace Mrix\Rql\Parser\Node\Query\ScalarOperator;

use Mrix\Rql\Parser\Node\Query\AbstractScalarOperatorNode;

/**
 */
class EqNode extends AbstractScalarOperatorNode
{
    /**
     * @inheritdoc
     */
    public function getNodeName()
    {
        return 'eq';
    }
}
