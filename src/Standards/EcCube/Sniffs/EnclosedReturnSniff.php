<?php
/**
 * Verify a return value is not enclosed in parenthesis
 *
 * @author    Camilo Uran <camilo.pico@scuti.asia>
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class EnclosedReturnSniff implements Sniff
{
    public function register()
    {
        return [T_RETURN];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $next = $phpcsFile->findNext([T_WHITESPACE], $stackPtr+1, null, true);

        if ($tokens[$next]['type'] === 'T_OPEN_PARENTHESIS') {
            $error = 'Do not enclose the return inside parenthesis';
            $phpcsFile->addError($error, $stackPtr, 'EnclosedReturn');
        }
    }
}
