<?php
namespace Mrix\Rql\Parser;

/**
 * Type caster interface
 */
interface TypeCasterInterface
{
    /**
     * @param Token $token
     * @return mixed
     */
    public function typeCast(Token $token);
}
