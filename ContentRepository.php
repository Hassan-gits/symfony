<?php

namespace MediaBox\Repository;

use Common\Model\AppConstant;
use CS\MainBundle\Entity\Company;
use CS\MainBundle\Entity\Content;
use CS\MainBundle\Entity\ParentSeries;
use CS\MainBundle\Entity\Season;
use Doctrine\ORM\EntityRepository;

class ContentRepository extends EntityRepository
{
    public function getByContentId($contentId)
    {
        return $this->findOneBy(array(
            "contentIdRef" => $contentId,
            "isArchived" => false
        ));
    }

    public function getByContentIdAndEpisode($contentId, $episode)
    {
        return $this->findOneBy(array(
            "contentIdRef" => $contentId,
            "episode" => $episode,
            "isArchived" => false
        ));
    }

    public function getByEpisode($episode)
    {
        return $this->findOneBy(array(
            "episode" => $episode,
        ));
    }

    public function getByParentSeries(ParentSeries $parentSeries)
    {
        return $this->findOneBy(array(
            "parentSeries" => $parentSeries,
            "isArchived" => false
        ));
    }

    public function getByParentSeriesAndContentId(ParentSeries $parentSeries, $contentId)
    {
        return $this->findOneBy(array(
            "parentSeries" => $parentSeries,
            "contentIdRef" => $contentId,
            "isArchived" => false
        ));
    }

    public function getContentByParentSeries(ParentSeries $parentSeries)
    {
        return $this->findOneBy(array(
            "parentSeries" => $parentSeries,
        ));
    }

    public function getByContentIdAndCompany(Company $company, $contentId)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");

        $qb->andWhere("c.contentIdRef = :contentId");
        $qb->setParameter("contentId", $contentId);

        $qb->andWhere("parentSeries.company = :company");
        $qb->setParameter("company", $company);

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->orderBy("c.id", "DESC");

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getProgramContentByTitleAndCompany(Company $company, $title)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");

        $qb->andWhere("parentSeries.company = :company");
        $qb->setParameter("company", $company);

        $qb->andWhere("parentSeries.type = :type");
        $qb->setParameter("type", "program");

        $qb->join("c.titles", "contentTitle");
        $qb->andWhere("contentTitle.title = :title");
        $qb->setParameter("title", $title);

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getTBAProgramContentByCompany(Company $company)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");

        $qb->andWhere("parentSeries.company = :company");
        $qb->setParameter("company", $company);

        $qb->andWhere("parentSeries.tba = :tba");
        $qb->setParameter("tba", true);

        $qb->andWhere("parentSeries.type = :type");
        $qb->setParameter("type", "program");

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getPressWebContentByParentSeries(ParentSeries $parentSeries)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.episode", "e");
        $qb->andWhere("e.visibleAtPressWeb = :visibleAtPressWeb");
        $qb->setParameter("visibleAtPressWeb", true);

        $qb->andWhere("c.parentSeries = :parentSeries");
        $qb->setParameter("parentSeries", $parentSeries);

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getByContentKey(Company $company, $contentKey)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");

        $qb->andWhere("c.contentKey = :contentKey");
        $qb->setParameter("contentKey", $contentKey);

        $qb->andWhere("parentSeries.company = :company");
        $qb->setParameter("company", $company);

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getByKey($contentKey)
    {
        return $this->findOneBy(array(
            "contentKey" => $contentKey,
            "isArchived" => false
        ));
    }

    public function getAnyContentByCompanyAndContentKey(Company $company, $contentKey)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");

        $qb->andWhere("c.contentKey = :contentKey");
        $qb->setParameter("contentKey", $contentKey);

        $qb->andWhere("parentSeries.company = :company");
        $qb->setParameter("company", $company);

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getAnyContentByKey($contentKey)
    {
        return $this->findOneBy(array(
            "contentKey" => $contentKey,
        ));
    }

    public function getByMediaId(Company $company, $mediaId)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");

        $qb->andWhere("parentSeries.company = :company");
        $qb->setParameter("company", $company);

        $qb->andWhere("c.mediaId = :mediaId");
        $qb->setParameter("mediaId", $mediaId);

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->orderBy("c.id", "DESC");

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getCompanyContentsWhereContentIdExists(Company $company)
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");
        $qb->andWhere("parentSeries.company = :company");
        $qb->setParameter("company", $company);

        $qb->andWhere($qb->expr()->isNotNull("c.contentIdRef"));

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getContentsByParentSeries(ParentSeries $parentSeries)
    {
        return $this->findBy(array(
            "parentSeries" => $parentSeries,
            "isArchived" => false
        ));
    }

    public function getContentsBySeason(Season $season)
    {
        return $this->findBy(array(
            "season" => $season,
        ));
    }

    public function getByMediaIdInContentIdRef(Company $company, string $mediaId)
    {
        $qb = $this->createQueryBuilder("content");

        $qb->join("content.parentSeries", "parentSeries");

        $qb->andWhere("parentSeries.company =:company");
        $qb->setParameter("company", $company);

        $qb->andWhere("content.isArchived =:archived");
        $qb->setParameter("archived", false);

        $qb->andWhere($qb->expr()->isNull("content.mediaId"));

        $qb->andWhere($qb->expr()->like("content.contentIdRef", ":param"));
        $qb->setParameter("param", "%" . $mediaId . "%");

        $qb->setFirstResult(0);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function getAutoUnpublishedDateContents($type)
    {
        if (AppConstant::EPISODE == $type) {
            return $this->getAutoUnpublishedDateEpisodes();
        }

        return $this->getAutoUnpublishedDatePrograms();
    }

    public function getAutoUnpublishedDateEpisodes()
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.episode", "episode");

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->andWhere("c.autoUnpublishedDate <= :now");
        $qb->setParameter("now", new \DateTime());

        $qb->andWhere("episode.visibleAtPressWeb = :visibleAtPressWeb");
        $qb->setParameter("visibleAtPressWeb", true);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getAutoUnpublishedDatePrograms()
    {
        $qb = $this->createQueryBuilder("c");

        $qb->join("c.parentSeries", "parentSeries");

        $qb->andWhere("c.isArchived = :archived");
        $qb->setParameter("archived", false);

        $qb->andWhere("c.autoUnpublishedDate <= :now");
        $qb->setParameter("now", new \DateTime());

        $qb->andWhere("parentSeries.type = :type");
        $qb->setParameter("type", AppConstant::PROGRAM);

        $qb->andWhere("parentSeries.visibleAtPressWeb = :visibleAtPressWeb");
        $qb->setParameter("visibleAtPressWeb", true);

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
