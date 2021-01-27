<?php
/**
 * Checks use of double quotes in strings that have no variable expansion
 *
 * @author    Camilo Uran <camilo.pico@scuti.asia>
 */

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class StrDoubleQuoteNoVarSniff implements Sniff
{
    public function register()
    {
        return [
            T_CONSTANT_ENCAPSED_STRING
        ];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $content = $tokens[$stackPtr]['content'];
        $isDoubleQuote = substr($content, 0, 1) === '"';
        $hasVariables = strpos($content, '$') !== false;

        if ($isDoubleQuote && !$hasVariables) {
            $error = 'Use single quotes if you are not using variable expansion inside a string';
            $phpcsFile->addWarning($error, $stackPtr, 'Found');
        }
    }
}
