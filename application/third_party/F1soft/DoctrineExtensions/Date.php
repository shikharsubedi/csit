<?php
namespace F1soft\DoctrineExtensions;

use \Doctrine\ORM\Query\AST\Functions\FunctionNode,
	Doctrine\ORM\Query\Lexer;

class Date extends FunctionNode
{
	public $dateTime;
	
	public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'DATE(' .$this->dateTime->dispatch($sqlWalker) . ')'; // (7)
    }
	
	
	public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER); // (2)
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (3)
        $this->dateTime = $parser->ArithmeticPrimary(); // (4)
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // (3)
    }
}
?>