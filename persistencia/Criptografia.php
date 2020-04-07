<?php

class Criptografia {
    /**
     * Definição padrão do salto utilizado
     *

     */
    private static $prefixoSalto = '2a';
    /**
     * Definição do custo
     *
     * @var integer
     *
     */
    private static $custoPadrao = 8;

    private static $tamanhoSalto = 22;

    public static function hash($texto, $custo = null) {
        if (empty($custo)){
            $custo = self::$custoPadrao;
        }
        // Salt
        $salto = self::gerarSalto();
        // Hash string
        $hashString = self::gerarHashString((int)$custo, $salto);
        return crypt($texto, $hashString);
    }

    public static function check($texto, $hash) {
        return (crypt($texto, $hash) === $hash);
    }

    public static function gerarSalto() {
        // Salt seed
        $seed = uniqid(mt_rand(), true);
        // Generate salt
        $salt = base64_encode($seed);
        $salt = str_replace('+', '.', $salt);
        return substr($salt, 0, self::$tamanhoSalto);
    }

    private static function gerarHashString($custo, $salto) {
        return sprintf('$%s$%02d$%s$', self::$prefixoSalto, $custo, $salto);
    }
}