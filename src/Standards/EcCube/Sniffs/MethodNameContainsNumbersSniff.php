<?php
/**
 * Checks method and function names don't contain numbers
 *
 * @author   Camilo Uran <camilo.pico@scuti.asia>
 */

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class MethodNameContainsNumbersSniff implements Sniff
{
    public function register()
    {
        return [T_FUNCTION];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $methodName = $phpcsFile->getDeclarationName($stackPtr);
        if ($methodName === null) {
            // Ignore closures.
            return;
        }

        if (preg_match('/\d/',$methodName) === 1){
            $warning = "Method name '$methodName' contains numbers but this is discouraged";
            $phpcsFile->addWarning($warning, $stackPtr, 'ContainsNumbers');
        }
    }
}
