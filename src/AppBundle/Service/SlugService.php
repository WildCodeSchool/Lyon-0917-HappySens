<?php
/**
 * Created by PhpStorm.
 * User: banban
 * Date: 27/11/17
 * Time: 10:33
 */

namespace AppBundle\Service;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class SlugService
{
    public $text;

    /** @var ObjectManager */
    private $em;

    /**
     * autoCheckService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
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
        if ($type == 'user') {
            $slugIsUnique = $this->em->getRepository('AppBundle:User')->getSlugIsUnique($text);
        } else {
            $slugIsUnique = $this->em->getRepository('AppBundle:Company')->getSlugIsUnique($text);
        }
        dump($slugIsUnique);
        if ($slugIsUnique > 0) {
            $text = $text . '-' . $slugIsUnique;
            /*$i = $i + 1;
            $this->slugify($text, $type, $i);*/
        }
        return $text;
    }
}