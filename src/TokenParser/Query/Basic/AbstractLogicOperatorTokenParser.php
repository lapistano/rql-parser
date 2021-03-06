<?php
namespace Mrix\Rql\Parser\TokenParser\Query\Basic;

use Mrix\Rql\Parser\Token;
use Mrix\Rql\Parser\TokenStream;
use Mrix\Rql\Parser\TokenParserInterface;
use Mrix\Rql\Parser\TokenParser\Query\AbstractBasicTokenParser;
use Mrix\Rql\Parser\Node\Query\AbstractLogicOperatorNode;

/**
 */
abstract class AbstractLogicOperatorTokenParser extends AbstractBasicTokenParser
{
    /**
     * @var TokenParserInterface
     */
    protected $conditionTokenParser;

    /**
     * @param TokenParserInterface $conditionTokenParser
     */
    public function __construct(TokenParserInterface $conditionTokenParser)
    {
        $this->conditionTokenParser = $conditionTokenParser;
    }

    /**
     * @param array $queries
     * @return AbstractLogicOperatorNode
     */
    abstract protected function createNode(array $queries);


    /**
     * @inheritdoc
     */
    public function parse(TokenStream $tokenStream)
    {
        $tokenStream->expect(Token::T_OPERATOR, $this->getOperatorName());
        $tokenStream->expect(Token::T_OPEN_PARENTHESIS);

        $queries = [];
        do {
            $queries[] = $this->conditionTokenParser->parse($tokenStream);
            if (!$tokenStream->nextIf(Token::T_COMMA)) {
                break;
            }
        } while (true);

        $tokenStream->expect(Token::T_CLOSE_PARENTHESIS);

        return $this->createNode($queries);
    }
}
