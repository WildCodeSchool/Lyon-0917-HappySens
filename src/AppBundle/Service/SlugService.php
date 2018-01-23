<?php
/**
 * Created by PhpStorm.
 * User: banban
 * Date: 27/11/17
 * Time: 10:33
 */

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class SlugService
{
    public $text;

    /**
     * @var
     */
    private $db;

    /**
     * SlugService constructor.
     * @param RegistryInterface $db
     */
    public function __construct(RegistryInterface $db)
    {
        $this->db = $db;
    }

    public function slugify($text, $type, $i = 0)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);
        $text = trim($text, '-');
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
        $text = strtolower($text);
        $text = preg_replace('#[^-\w]+#', '', $text);
        //TODO personalisation du lien
        switch ($type) {
            case ('user'):
                $slugIsUnique = $this->db->getRepository('AppBundle:User')->getSlugIsUnique($text);
                break;
            case ('company'):
                $slugIsUnique = $this->db->getRepository('AppBundle:Company')->getSlugIsUnique($text);
                break;
            case('project'):
                $slugIsUnique = $this->db->getRepository('AppBundle:Project')->getSlugIsUnique($text);
                break;
        }
        if ($slugIsUnique > 0) {
            $text = $text . '-' . $slugIsUnique;
            /*$i = $i + 1;
            $this->slugify($text, $type, $i);*/
        }
        return $text;
    }
}