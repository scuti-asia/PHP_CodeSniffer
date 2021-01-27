<?php
/**
 * Verify function header with multiple lines have the closing parenthesis
 * and opening bracket in the same line and with proper spacing
 *
 * @author    Camilo Uran <camilo.pico@scuti.asia>
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class FunctionBracketNewLineSniff implements Sniff
{
    public function register()
    {
        return [T_FUNCTION];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $openingParenthesis = $phpcsFile->findNext([T_OPEN_PARENTHESIS], $stackPtr+1);
        $closingParenthesis = $phpcsFile->findNext([T_CLOSE_PARENTHESIS], $stackPtr+1);
        $openingBracket = $phpcsFile->findNext([T_OPEN_CURLY_BRACKET], $stackPtr+1);

        if ($tokens[$openingParenthesis]['line'] !== $tokens[$closingParenthesis]['line']
        && $tokens[$closingParenthesis]['line'] !== $tokens[$openingBracket]['line']) {
            $error = 'Closing parenthesis and opening brace should be on the same line';
            $phpcsFile->addError($error, $stackPtr, 'ClosingParenthesisSameLine');
        }

        if ($tokens[$openingParenthesis]['line'] !== $tokens[$closingParenthesis]['line']
            && $tokens[$closingParenthesis]['line'] === $tokens[$openingBracket]['line']
            && ($openingBracket - $closingParenthesis) === 1) {
            $error = 'Add a space between the closing parenthesis and the opening brace';
            $phpcsFile->addError($error, $stackPtr, 'SpaceBetweenParenthesisBrace');
        }
    }
}
