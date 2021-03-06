<?php
namespace Mrix\Rql\Parser\TokenParser;

use Mrix\Rql\Parser\Token;
use Mrix\Rql\Parser\TokenStream;
use Mrix\Rql\Parser\AbstractTokenParser;
use Mrix\Rql\Parser\Node\LimitNode;

/**
 */
class LimitTokenParser extends AbstractTokenParser
{
    /**
     * @inheritdoc
     */
    public function parse(TokenStream $tokenStream)
    {
        $limit = null;
        $offset = null;

        $tokenStream->expect(Token::T_OPERATOR, 'limit');
        $tokenStream->expect(Token::T_OPEN_PARENTHESIS);

        $limit = (int)$tokenStream->expect(Token::T_INTEGER)->getValue();
        if ($tokenStream->nextIf(Token::T_COMMA)) {
            $offset = (int)$tokenStream->expect(Token::T_INTEGER)->getValue();
        }

        $tokenStream->expect(Token::T_CLOSE_PARENTHESIS);

        return new LimitNode($limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function supports(TokenStream $tokenStream)
    {
        return $tokenStream->test(Token::T_OPERATOR, 'limit');
    }
}
