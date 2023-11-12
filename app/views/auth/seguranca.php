<?php

class Seguranca
{
    private static function isSessaoIniciada()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }    
    }

    public static function isLogado()
    {
        self::isSessaoIniciada();
        return isset($_SESSION['usuario']);
    }

    public static function isUsuario()
    {
        if (self::isLogado()) {
            return strtoupper($_SESSION['usuario']['perfil']) == 'USU' ? true : false;
        }
        return false;
    }

    public static function isEditor()
    {
        if (self::isLogado()) {
            return strtoupper($_SESSION['usuario']['perfil']) == 'EDI' ? true : false;
        }
        return false;
    }
    
    public static function isGerente()
    {
        if (self::isLogado()) {
            return strtoupper($_SESSION['usuario']['perfil']) == 'GER' ? true : false;
        }
        return false;
    }

    public static function isAdminstrador()
    {
        if (self::isLogado()) {
            return strtoupper($_SESSION['usuario']['perfil']) == 'ADM' ? true : false;
        }
        return false;
    }

    public static function getUsuarioLogado()
    {
        if (self::isLogado()) {
            return trim($_SESSION['usuario']['nome']);
        }
        return "";
    }
}

