<?php
/**
 * Checks that variable name doesn't contain numbers
 *
 * @author    Camilo Uran  <camilo.pico@scuti.asia>
 */

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class VarNameContainsNumbersSniff implements Sniff
{
    public function register ()
    {
        return [T_VARIABLE];
    }

    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens      = $phpcsFile->getTokens();
        $varName     = ltrim($tokens[$stackPtr]['content'], '$');

        if (preg_match('|\d|', $varName) === 1) {
            $warning = "Member variable '\$$varName' contains numbers but this is discouraged";
            $phpcsFile->addWarning($warning, $stackPtr, 'MemberVarContainsNumbers');
        }
    }
}
