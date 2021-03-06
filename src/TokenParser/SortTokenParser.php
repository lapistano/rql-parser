<?php
namespace Mrix\Rql\Parser\TokenParser;

use Mrix\Rql\Parser\Token;
use Mrix\Rql\Parser\TokenStream;
use Mrix\Rql\Parser\AbstractTokenParser;
use Mrix\Rql\Parser\Node\SortNode;

/**
 */
class SortTokenParser extends AbstractTokenParser
{
    /**
     * @inheritdoc
     */
    public function parse(TokenStream $tokenStream)
    {
        $fields = [];

        $tokenStream->expect(Token::T_OPERATOR, 'sort');
        $tokenStream->expect(Token::T_OPEN_PARENTHESIS);

        do {
            $direction = $tokenStream->expect([Token::T_PLUS, Token::T_MINUS]);
            $fields[$tokenStream->expect(Token::T_STRING)->getValue()] = $direction->test(Token::T_PLUS) ?
                SortNode::SORT_ASC :
                SortNode::SORT_DESC;

            if (!$tokenStream->nextIf(Token::T_COMMA)) {
                break;
            }
        } while (true);

        $tokenStream->expect(Token::T_CLOSE_PARENTHESIS);

        return new SortNode($fields);
    }

    /**
     * @inheritdoc
     */
    public function supports(TokenStream $tokenStream)
    {
        return $tokenStream->test(Token::T_OPERATOR, 'sort');
    }
}
