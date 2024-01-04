<?php

namespace MediaBox\Repository;

use CS\MainBundle\Entity\Content;
use Doctrine\ORM\EntityRepository;

class ContentTitleRepository extends EntityRepository
{
    public function getByLanguageAndContent($language, Content $content)
    {
        return $this->findOneBy(array(
            "content" => $content,
            "language" => $language,
            "original" => false,
            "isArchived" => false
        ));
    }

    public function getOriginalTitleByContent(Content $content)
    {
        return $this->findOneBy(array(
            "content" => $content,
            "original" => true,
            "isArchived" => false,
        ));
    }
}