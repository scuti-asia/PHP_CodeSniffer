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

class MemberVarBeforeFunctionSniff implements Sniff
{
    public function register()
    {
        return [T_VARIABLE];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        try {
            // if the variable is not a class member, this will throw an exception:
            $phpcsFile->getMemberProperties($stackPtr);
            $prevFunction = $phpcsFile->findPrevious([T_FUNCTION], $stackPtr-1);

            if ($prevFunction !== false) {
                $error = 'Declare all class member variables before any functions';
                $phpcsFile->addError($error, $stackPtr, 'ClassFunctionBeforeClassVariable');
            }

        } catch (\Exception $e) {
            // Nothing to do
        }
    }
}
