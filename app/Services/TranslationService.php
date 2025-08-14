<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    private $translator;

    public function __construct()
    {
        $this->translator = new GoogleTranslate('es', 'en');
        $this->translator->setOptions([
            'timeout' => 5, // Reducimos el timeout a 5 segundos
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ]
        ]);
    }

    public function translateAndCache($text)
    {
        if (empty($text)) {
            return $text;
        }

        \Log::info("Iniciando traducción:", ['texto' => $text]);
        
        try {
            // Agregamos un timeout interno
            $startTime = microtime(true);
            $translated = $this->translator->translate($text);
            $endTime = microtime(true);
            
            \Log::info("Traducción completada:", [
                'original' => $text,
                'traducido' => $translated,
                'tiempo' => round($endTime - $startTime, 2) . ' segundos'
            ]);
            
            return $translated ?: $text; // Si la traducción devuelve null o vacío, usar el original
            
        } catch (\Exception $e) {
            \Log::error("Error en traducción: " . $e->getMessage(), [
                'texto' => $text,
                'error_tipo' => get_class($e),
                'error_linea' => $e->getLine()
            ]);
            return $text; // Devolver el texto original si hay un error
        }
    }
}
