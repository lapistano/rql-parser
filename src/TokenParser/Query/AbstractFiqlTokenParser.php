<?php
namespace Mrix\Rql\Parser\TokenParser\Query;

use Mrix\Rql\Parser\Token;
use Mrix\Rql\Parser\TokenStream;
use Mrix\Rql\Parser\AbstractTokenParser;

/**
 */
abstract class AbstractFiqlTokenParser extends AbstractTokenParser
{
    /**
     * @return array
     */
    abstract protected function getOperatorNames();

    /**
     * @inheritdoc
     */
    public function supports(TokenStream $tokenStream)
    {
        return $tokenStream->test(Token::T_STRING) &&
            $tokenStream->lookAhead()->test(Token::T_OPERATOR, $this->getOperatorNames());
    }
}
