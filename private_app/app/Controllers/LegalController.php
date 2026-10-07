<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Controlador Legal y Normativo (app/Controllers/LegalController.php)
 *
 * Responsabilidad:
 * - Gestionar las páginas institucionales de términos, condiciones, aviso legal y privacidad.
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class LegalController extends Controller
{
    /**
     * Muestra la página de Términos y Condiciones de Uso y Aviso Legal.
     */
    public function terminos(): void
    {
        $data = [
            'title'           => 'Términos y Condiciones de Uso y Aviso Legal | Quality Consulting Solutions',
            'metaDescription' => 'Términos y condiciones de uso, contratación de consultoría y capacitación, y política de privacidad de Quality Consulting Solutions S.A.C.',
            'canonical'       => 'https://quality-consulting.org/terminos-y-condiciones',
            'activePage'      => 'legal',
        ];

        $this->render('pages/terminos-y-condiciones', $data, 'main');
    }
}

