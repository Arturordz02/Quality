<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Controlador de Páginas Institucionales (app/Controllers/PageController.php)
 *
 * Responsabilidad:
 * - Gestionar la presentación de páginas institucionales estáticas y páginas de error.
 * - Preparar metadatos SEO específicos de cada pantalla y despachar las vistas modulares.
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller
{
    /**
     * Muestra la página de inicio principal (Home) de Quality Consulting Solutions.
     */
    public function home(): void
    {
        $data = [
            'title'           => 'Quality Consulting Solutions | Formación Especializada, PMO y Calidad',
            'metaDescription' => 'Formación especializada en gestión de proyectos, PMO y calidad para profesionales del sector construcción, infraestructura y minería. Capacitaciones y asesoría técnica.',
            'canonical'       => 'https://quality-consulting.org/',
            'activePage'      => 'home',
        ];

        $this->render('pages/home', $data, 'main');
    }

    /**
     * Muestra la página institucional "Nosotros" (Quiénes Somos, Misión, Visión, Plana Docente).
     */
    public function nosotros(): void
    {
        $data = [
            'title'           => 'Nosotros | Quiénes Somos - Quality Consulting Solutions',
            'metaDescription' => 'Conoce a Quality Consulting Solutions: excelencia formativa, desarrollo de competencias, cursos de especialización y asesoría técnica para el sector construcción.',
            'canonical'       => 'https://quality-consulting.org/nosotros',
            'activePage'      => 'nosotros',
        ];

        $this->render('pages/nosotros', $data, 'main');
    }

    /**
     * Muestra la página institucional "Nuestros Clientes" (Empresas, Casuística, Alianzas).
     */
    public function clientes(): void
    {
        $data = [
            'title'           => 'Nuestros Clientes | Quality Consulting Solutions',
            'metaDescription' => 'Conoce a las empresas y profesionales del sector construcción, ingeniería y minería que han participado en capacitaciones y asesorías de Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/clientes',
            'activePage'      => 'clientes',
        ];

        $this->render('pages/clientes', $data, 'main');
    }

    /**
     * Muestra la página de Error 404 (Página no encontrada).
     */
    public function notFound(): void
    {
        http_response_code(404);

        $data = [
            'title'           => 'Página no encontrada (404) | Quality Consulting Solutions',
            'metaDescription' => 'La página que busca en Quality Consulting Solutions no está disponible o ha cambiado de dirección.',
            'robots'          => 'noindex, follow',
            'activePage'      => '404',
        ];

        $this->render('pages/404', $data, 'main');
    }

    /**
     * Muestra la página de Contacto y Atención Corporativa con formulario asíncrono.
     */
    public function contacto(): void
    {
        $data = [
            'title'           => 'Contacto y Atención Corporativa | Quality Consulting Solutions',
            'metaDescription' => 'Ponte en contacto con Quality Consulting Solutions para consultas sobre cursos de especialización, capacitaciones in-house y asesoría técnica en gestión de proyectos.',
            'canonical'       => 'https://quality-consulting.org/contacto',
            'activePage'      => 'contacto',
        ];

        $this->render('pages/contacto', $data, 'main');
    }

    /**
     * Muestra la página del Libro de Reclamaciones Virtual conforme a Ley N° 29571.
     */
    public function libroDeReclamaciones(): void
    {
        $data = [
            'title'           => 'Libro de Reclamaciones Virtual | Quality Consulting Solutions',
            'metaDescription' => 'Libro de Reclamaciones Virtual de Quality Consulting Solutions. Conforme a lo establecido en el Código de Protección y Defensa del Consumidor (Ley N° 29571 y D.S. 011-2011-PCM).',
            'canonical'       => 'https://quality-consulting.org/libro-de-reclamaciones',
            'activePage'      => 'libro-de-reclamaciones',
        ];

        $this->render('pages/libro-de-reclamaciones', $data, 'main');
    }

    /**
     * Muestra la plataforma de Diagnóstico Integral y Test de Habilidades Blandas.
     */
    public function evaluacionHabilidades(): void
    {
        $data = [
            'title'           => 'Evaluación de Habilidades Blandas | Quality Consulting Solutions',
            'metaDescription' => 'Test situacional dinámico de competencias blandas para ingenieros, líderes de proyecto y equipos de obra. Diagnóstico de Comunicación, Trabajo en Equipo, Resolución de Problemas y Adaptabilidad.',
            'canonical'       => 'https://quality-consulting.org/evaluacion-habilidades',
            'activePage'      => 'evaluacion-habilidades',
        ];

        $this->render('pages/evaluacion-habilidades', $data, 'main');
    }

    /**
     * Muestra la página de Investigación y Colaboración con Stanford University.
     */
    public function investigacion(): void
    {
        $data = [
            'title'           => 'Investigación y Colaboración con Stanford University | Quality Consulting Solutions',
            'metaDescription' => 'Colaboración en investigación de vanguardia entre Quality Consulting Solutions y el CIFE de Stanford University en BIM LOD 400, Last Planner e indicadores predictivos.',
            'canonical'       => 'https://quality-consulting.org/investigacion',
            'activePage'      => 'investigacion',
        ];

        $this->render('pages/investigacion', $data, 'main');
    }

    /**
     * Muestra la biblioteca multimedia de Medios, Podcasts y Conferencias.
     */
    public function medios(): void
    {
        $data = [
            'title'           => 'Medios, Publicaciones y Podcasts | Quality Consulting Solutions',
            'metaDescription' => 'Explora nuestra biblioteca multimedia: podcast oficial en Spotify, artículos especializados en LinkedIn, entrevistas en YouTube y conferencias sobre gestión de proyectos y calidad.',
            'canonical'       => 'https://quality-consulting.org/medios',
            'activePage'      => 'medios',
        ];

        $this->render('pages/medios', $data, 'main');
    }

    /**
     * Muestra el portal de Noticias y Novedades Técnicas del Sector.
     */
    public function noticias(): void
    {
        $data = [
            'title'           => 'Noticias y Actualidad Técnica del Sector | Quality Consulting Solutions',
            'metaDescription' => 'Centro de noticias y novedades técnicas sobre Plan BIM Perú, PMO en infraestructura pública, gestión de riesgos, ISO 9001 y modelos contractuales.',
            'canonical'       => 'https://quality-consulting.org/noticias',
            'activePage'      => 'noticias',
        ];

        $this->render('pages/noticias', $data, 'main');
    }

    /**
     * Muestra la sala de Prensa, Libros Oficiales y Comunicados Editoriales.
     */
    public function press(): void
    {
        $data = [
            'title'           => 'Prensa, Lanzamientos y Libros Oficiales | Quality Consulting Solutions',
            'metaDescription' => 'Descubre la serie de libros y publicaciones oficiales de Quality Consulting Solutions sobre Gestión de Riesgos Técnicos e ISO 9001 en la Construcción.',
            'canonical'       => 'https://quality-consulting.org/press',
            'activePage'      => 'press',
        ];

        $this->render('pages/press', $data, 'main');
    }

    /**
     * Muestra la página de Encuestas y Estudios en Gestión de Proyectos.
     */
    public function encuestasProyectos(): void
    {
        $data = [
            'title'           => 'Encuestas y Estudios en Gestión de Proyectos | Quality Consulting Solutions',
            'metaDescription' => 'Participa en las encuestas e investigaciones aplicadas de Quality Consulting Solutions sobre el Síndrome del 90% en la compleción de proyectos y diagnósticos de calidad.',
            'canonical'       => 'https://quality-consulting.org/encuestas-proyectos',
            'activePage'      => 'investigacion',
        ];

        $this->render('pages/encuestas-proyectos', $data, 'main');
    }
}


