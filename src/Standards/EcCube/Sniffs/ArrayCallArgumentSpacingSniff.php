<?php
/**
 * Verify spaces after commas in call to array method
 *
 * @author    Camilo Uran <camilo.pico@scuti.asia>
 */

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Functions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class FunctionCallArgumentSpacing2Sniff implements Sniff
{
    public function register()
    {
        return [T_ARRAY];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $next = $phpcsFile->findNext(T_OPEN_PARENTHESIS, ($stackPtr + 1), null);
        $nextItem = $phpcsFile->findNext([T_COMMA, T_CLOSE_PARENTHESIS], $next+1);

        while ($tokens[$nextItem]['code'] !== T_CLOSE_PARENTHESIS) {
            if ($tokens[$nextItem+1]['code'] !== T_WHITESPACE && $tokens[$nextItem+1]['code'] !== T_CLOSE_PARENTHESIS) {
                $error = 'No space found after comma in argument list of array';

                $phpcsFile->addError($error, $stackPtr, 'MissingSpaceAfterComma');
                break;
            }

            $nextItem = $phpcsFile->findNext([T_CLOSE_PARENTHESIS, T_COMMA], ($nextItem + 1), null);
        }
    }
}
