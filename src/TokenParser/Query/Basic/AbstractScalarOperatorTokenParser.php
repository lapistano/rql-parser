<?php
namespace Mrix\Rql\Parser\TokenParser\Query\Basic;

use Mrix\Rql\Parser\Token;
use Mrix\Rql\Parser\TokenStream;
use Mrix\Rql\Parser\TokenParser\Query\AbstractBasicTokenParser;
use Mrix\Rql\Parser\Node\Query\AbstractScalarOperatorNode;

/**
 */
abstract class AbstractScalarOperatorTokenParser extends AbstractBasicTokenParser
{
    /**
     * @param string $field
     * @param mixed $value
     * @return AbstractScalarOperatorNode
     */
    abstract protected function createNode($field, $value);

    /**
     * @inheritdoc
     */
    public function parse(TokenStream $tokenStream)
    {
        $tokenStream->expect(Token::T_OPERATOR, $this->getOperatorName());
        $tokenStream->expect(Token::T_OPEN_PARENTHESIS);

        $field = $tokenStream->expect(Token::T_STRING)->getValue();
        $tokenStream->expect(Token::T_COMMA);
        $value = $this->getParser()->getExpressionParser()->parseScalar($tokenStream);

        $tokenStream->expect(Token::T_CLOSE_PARENTHESIS);

        return $this->createNode($field, $value);
    }
}
