<?php
/**
 * Checks the use of negative array indexes
 *
 * @author    Camilo Uran <camilo.pico@scuti.asia>
 */

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ArrayNegativeIndexSniff implements Sniff
{
    public function register()
    {
        return [T_VARIABLE];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // will detect $a[-1]
        if ($tokens[$stackPtr+1]['type'] === 'T_OPEN_SQUARE_BRACKET'
            && $tokens[$stackPtr+2]['type'] === 'T_MINUS'
        ) {
            $error = 'Do not use negative array indexes';
            $phpcsFile->addError($error, $stackPtr, 'NegativeArrayIndex');
        }

        // will detect $a [-1]
        if ($tokens[$stackPtr+1]['type'] === 'T_WHITESPACE'
            && $tokens[$stackPtr+2]['type'] === 'T_OPEN_SQUARE_BRACKET'
            && $tokens[$stackPtr+3]['type'] === 'T_MINUS'
        ) {
            $error = 'Do not use negative array indexes';
            $phpcsFile->addError($error, $stackPtr, 'NegativeArrayIndex');
        }

        // will detect $a [ -1]
        if ($tokens[$stackPtr+1]['type'] === 'T_WHITESPACE'
            && $tokens[$stackPtr+2]['type'] === 'T_OPEN_SQUARE_BRACKET'
            && $tokens[$stackPtr+3]['type'] === 'T_WHITESPACE'
            && $tokens[$stackPtr+4]['type'] === 'T_MINUS'
        ) {
            $error = 'Do not use negative array indexes';
            $phpcsFile->addError($error, $stackPtr, 'NegativeArrayIndex');
        }

        // will detect $a[ -1]
        if ($tokens[$stackPtr+1]['type'] === 'T_OPEN_SQUARE_BRACKET'
            && $tokens[$stackPtr+2]['type'] === 'T_OPEN_SQUARE_BRACKET'
            && $tokens[$stackPtr+3]['type'] === 'T_MINUS'
        ) {
            $error = 'Do not use negative array indexes';
            $phpcsFile->addError($error, $stackPtr, 'NegativeArrayIndex');
        }
    }
}
