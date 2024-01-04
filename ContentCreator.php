<?php

namespace MediaBox\Content;

use Common\Model\AppConstant;
use CS\MainBundle\Entity\Company;
use CS\MainBundle\Entity\Content;
use CS\MainBundle\Entity\ContentCountryOfParentalRating;
use CS\MainBundle\Entity\ContentDescription;
use CS\MainBundle\Entity\ContentGenericTitle;
use CS\MainBundle\Entity\ContentGenre;
use CS\MainBundle\Entity\ContentSubGenre;
use CS\MainBundle\Entity\ContentTitle;
use CS\MainBundle\Entity\Episode;
use CS\MainBundle\Entity\ParentSeries;
use CS\MainBundle\Entity\Season;
use Doctrine\ORM\EntityManager;
use MediaBox\Client\Mtg\MTGHelper;
use MediaBox\Helper\ContentManager;

class ContentCreator
{
    private $entityManager;
    private $contentRepositoryManager;

    public function __construct(
        EntityManager  $entityManager,
        ContentManager $contentRepositoryManager
    )
    {
        $this->entityManager = $entityManager;
        $this->contentRepositoryManager = $contentRepositoryManager;
    }

    public function createEpisodeContent(ContentModel $contentModel, Episode $episode, Season $season, ParentSeries $parentSeries)
    {
        $series = $season->getSeries();

        $contentRepository = $this->contentRepositoryManager->getContentRepository();
        $content = $contentRepository->getByEpisode($episode);
        if (!$content instanceof Content) {
            $content = new Content();
            $content->setSeason($season);
            $content->setParentSeries($parentSeries);
            $content->setSeries($series);
            $content->setEpisode($episode);

            $this->entityManager->persist($content);
            $this->entityManager->flush();
        }

        $contentModel->setExternalKey($this->getContentIdRef($parentSeries, $content, $contentModel));

        $content->setParentSeries($parentSeries);
        $content->setContentIdRef($contentModel->getExternalKey());
        $content->setProductionYear($contentModel->getProductionYear());
        $content->setDvbGenre1($contentModel->getDvbGenre1());
        $content->setDvbGenre2($contentModel->getDvbGenre2());
        $content->setParentalRating($contentModel->getParentalRating());
        $content->setNetDuration($contentModel->getNetDuration());
        $this->createContentTitle($content, $contentModel);
        $this->createContentOriginalTitle($content, $contentModel->getOriginalTitle());
        $this->createContentGenericTitle($content, $contentModel);
        $this->createContentDescription($content, $contentModel);
        $this->createContentCountryOfOrigin($content, $contentModel);
        $this->createContentCountryOfParentalRating($content, $contentModel);
        $this->createContentGenres($content, $contentModel);
        $this->createMediaId($parentSeries, $content, $contentModel);

        $this->entityManager->persist($content);

        return $content;
    }

    public function createProgramContent(ContentModel $contentModel, ParentSeries $parentSeries)
    {

        $contentRepository = $this->contentRepositoryManager->getContentRepository();
        $content = $contentRepository->getByParentSeries($parentSeries);
        if (!$content instanceof Content) {
            $content = new Content();
            $content->setParentSeries($parentSeries);

            $this->entityManager->persist($content);
            $this->entityManager->flush();
        }

        $contentIdRef = $contentModel->getExternalKey();
        if ("" != $contentIdRef) {
            $content->setContentIdRef($contentModel->getExternalKey());
        }

        $content->setProductionYear($contentModel->getProductionYear());
        $content->setNetDuration($contentModel->getNetDuration());
        $content->setDvbGenre1($contentModel->getDvbGenre1());
        $content->setDvbGenre2($contentModel->getDvbGenre2());
        $content->setParentalRating($contentModel->getParentalRating());
        $content->setTag($contentModel->getTag());
        $content->setProductionCompany($contentModel->getProductionCompany());
        $content->setWebsite($contentModel->getWebsite());
        $this->createContentCountryOfOrigin($content, $contentModel);
        $this->createContentCountryOfParentalRating($content, $contentModel);
        $this->createContentGenres($content, $contentModel);

        $this->createContentTitle($content, $contentModel);
        $this->createContentOriginalTitle($content, $contentModel->getOriginalTitle());
        $this->createContentGenericTitle($content, $contentModel);
        $this->createContentDescription($content, $contentModel);
        $this->createMediaId($parentSeries, $content, $contentModel);

        $this->entityManager->persist($content);

        return $content;
    }

    public function syncLocalProgramContentToMaster(ContentModel $contentModel, ParentSeries $parentSeries)
    {
        $contentRepository = $this->contentRepositoryManager->getContentRepository();
        $content = $contentRepository->getByParentSeries($parentSeries);
        if (!$content instanceof Content) {
            $content = new Content();
            $content->setParentSeries($parentSeries);

            $this->entityManager->persist($content);
            $this->entityManager->flush();
        }

        $content->setContentIdRef($contentModel->getExternalKey());
        $content->setProductionYear($contentModel->getProductionYear());
        $content->setDvbGenre1($contentModel->getDvbGenre1());
        $content->setDvbGenre2($contentModel->getDvbGenre2());
        $content->setParentalRating($contentModel->getParentalRating());
        $content->setTag($contentModel->getTag());
        $content->setProductionCompany($contentModel->getProductionCompany());
        $content->setWebsite($contentModel->getWebsite());
        $this->createContentCountryOfOrigin($content, $contentModel);
        $this->createContentCountryOfParentalRating($content, $contentModel);
        $this->createContentGenres($content, $contentModel);

        $this->createContentTitle($content, $contentModel);
        $this->createContentOriginalTitle($content, $contentModel->getOriginalTitle());
        $this->createContentGenericTitle($content, $contentModel);
        $this->createContentDescription($content, $contentModel);

        $this->entityManager->persist($content);

        return $content;
    }

    public function syncMasterProgramContentToLocal(ContentModel $contentModel, ParentSeries $parentSeries)
    {
        $contentRepository = $this->contentRepositoryManager->getContentRepository();
        $content = $contentRepository->getByParentSeries($parentSeries);
        if (!$content instanceof Content) {
            $content = new Content();
            $content->setParentSeries($parentSeries);

            $this->entityManager->persist($content);
            $this->entityManager->flush();
        }

        $content->setContentIdRef($contentModel->getExternalKey());
        $content->setProductionYear($contentModel->getProductionYear());
        $content->setDvbGenre1($contentModel->getDvbGenre1());
        $content->setDvbGenre2($contentModel->getDvbGenre2());
        $content->setParentalRating($contentModel->getParentalRating());
        $content->setTag($contentModel->getTag());
        $content->setProductionCompany($contentModel->getProductionCompany());
        $content->setWebsite($contentModel->getWebsite());
        $this->createContentCountryOfOrigin($content, $contentModel);
        $this->createContentCountryOfParentalRating($content, $contentModel);
        $this->createContentGenres($content, $contentModel);

        $this->createContentTitle($content, $contentModel);
        $this->createContentOriginalTitle($content, $contentModel->getOriginalTitle());
        $this->createContentGenericTitle($content, $contentModel);
        $this->createContentDescription($content, $contentModel);

        $this->entityManager->persist($content);

        return $content;
    }

    public function createDNFSpecialEpisodeContent(ContentModel $contentModel, Season $season, ParentSeries $parentSeries)
    {
        $series = $season->getSeries();

        $contentRepository = $this->contentRepositoryManager->getContentRepository();
        $content = $contentRepository->getByContentId($contentModel->getExternalKey());
        if (!$content instanceof Content) {
            $content = new Content();
            $content->setSeason($season);
            $content->setParentSeries($parentSeries);
            $content->setSeries($series);
            $content->setContentIdRef($contentModel->getExternalKey());
        }

        $content->setProductionYear($contentModel->getProductionYear());
        $content->setDvbGenre1($contentModel->getDvbGenre1());
        $content->setDvbGenre2($contentModel->getDvbGenre2());
        $this->createContentTitle($content, $contentModel);
        $this->createContentOriginalTitle($content, $contentModel->getOriginalTitle());
        $this->createContentDescription($content, $contentModel);

        $this->entityManager->persist($content);
        $this->entityManager->flush();

        return $content;
    }

    public function createTBAProgramContent(ContentModel $contentModel, ParentSeries $parentSeries)
    {
        $contentRepository = $this->contentRepositoryManager->getContentRepository();
        $content = $contentRepository->getByParentSeries($parentSeries);
        if ($content instanceof Content) {
            return $content;
        }

        $content = new Content();
        $content->setParentSeries($parentSeries);
        $this->createContentTitle($content, $contentModel);
        $this->createContentOriginalTitle($content, $contentModel->getOriginalTitle());

        $this->entityManager->persist($content);

        return $content;
    }

    private function createContentDescription(Content $content, ContentModel $contentModel)
    {
        $contentDescriptionRepository = $this->contentRepositoryManager->getContentDescriptionRepository();
        $contentDescription = $contentDescriptionRepository->getByLanguageAndContent($contentModel->getLanguage(), $content);
        if (!$contentDescription instanceof ContentDescription) {
            $contentDescription = new ContentDescription();
            $contentDescription->setLanguage($contentModel->getLanguage());
        }

        $contentDescription->setTiny($contentModel->getTiny());
        $contentDescription->setShort($contentModel->getShort());
        $contentDescription->setDescription($contentModel->getMedium());
        $contentDescription->setLongDescription($contentModel->getLong());
        $contentDescription->setExtended($contentModel->getExtended());

        $contentDescription->setContent($content);

        $this->entityManager->persist($contentDescription);

        return $contentDescription;
    }

    private function createContentTitle(Content $content, ContentModel $contentModel)
    {
        $contentTitleRepository = $this->contentRepositoryManager->getContentTitleRepository();
        $contentTitle = $contentTitleRepository->getByLanguageAndContent($contentModel->getLanguage(), $content);

        if (!$contentTitle instanceof ContentTitle) {

            // Prevent to create empty titles
            if ($contentModel->getTitle() == "") {
                return false;
            }

            $contentTitle = new ContentTitle();
            $contentTitle->setLanguage($contentModel->getLanguage());
        }
        $contentTitle->setTitle($contentModel->getTitle());
        $contentTitle->setContent($content);

        $this->entityManager->persist($contentTitle);

        return $contentTitle;
    }

    private function createContentGenericTitle(Content $content, ContentModel $contentModel)
    {
        $contentGenericTitleRepository = $this->contentRepositoryManager->getContentGenericTitleRepository();
        $contentGenericTitle = $contentGenericTitleRepository->getGenericTitleByEpisodeAndLanguage($content, $contentModel->getLanguage());
        if (!$contentGenericTitle instanceof ContentGenericTitle) {

            // Prevent to create empty titles
            if ($contentModel->getGenericTitle() == "") {
                return false;
            }

            $contentGenericTitle = new ContentGenericTitle();
            $contentGenericTitle->setLanguage($contentModel->getLanguage());
        }

        $contentGenericTitle->setTitle($contentModel->getGenericTitle());
        $contentGenericTitle->setContent($content);

        $this->entityManager->persist($contentGenericTitle);

        return $contentGenericTitle;
    }

    private function createContentOriginalTitle(Content $content, $title)
    {
        $contentTitleRepository = $this->contentRepositoryManager->getContentTitleRepository();
        $contentTitle = $contentTitleRepository->getOriginalTitleByContent($content);
        if (!$contentTitle instanceof ContentTitle) {

            // Prevent to create empty titles
            if ($title == "") {
                return false;
            }

            $contentTitle = new ContentTitle();
            $contentTitle->setLanguage("eng");
            $contentTitle->setOriginal(true);
        }

        $contentTitle->setTitle($title);
        $contentTitle->setContent($content);

        $this->entityManager->persist($contentTitle);

        return $contentTitle;
    }

    private function createContentCountryOfOrigin(Content $content, ContentModel $contentModel)
    {
        if (empty($contentModel->getCountryOfOrigin())) {
            return $content;
        }

        $countryOfOrigins = $contentModel->getCountryOfOrigin();
        if (is_array($countryOfOrigins)) {
            $content->setCountryOfOrigins($countryOfOrigins);
            return $countryOfOrigins;
        }

        return array($contentModel->getCountryOfOrigin());
    }

    private function createContentGenres(Content $content, ContentModel $contentModel)
    {
        $contentGenreRepository = $this->contentRepositoryManager->getContentGenreRepository();

        foreach ($contentModel->getGenres() as $contentGenreModel) {

            if (!$contentGenreModel instanceof ContentGenreModel) {
                continue;
            }

            $name = $contentGenreModel->getName();
            $language = $contentGenreModel->getLanguage();

            $contentGenre = $contentGenreRepository->getByNameAndLanguage($content, $name, $language);
            if (!$contentGenre instanceof ContentGenre) {
                $contentGenre = new ContentGenre();
                $contentGenre->setContent($content);
                $contentGenre->setName($name);
                $contentGenre->setLanguage($language);
                $this->entityManager->persist($contentGenre);
                $this->entityManager->flush();
            }

            $this->createContentSubGenres($contentGenre, $contentGenreModel->getSubGenres());
        }
    }

    private function createContentSubGenres(ContentGenre $contentGenre, array $subGenres)
    {
        $contentSubGenreRepository = $this->contentRepositoryManager->getContentSubGenreRepository();

        foreach ($subGenres as $contentSubGenreModel) {

            if (!$contentSubGenreModel instanceof ContentSubGenreModel) {
                continue;
            }

            $name = $contentSubGenreModel->getName();
            $language = $contentSubGenreModel->getLanguage();

            $contentSubGenre = $contentSubGenreRepository->getByNameAndLanguage($contentGenre, $name, $language);
            if (!$contentSubGenre instanceof ContentSubGenre) {
                $contentSubGenre = new ContentSubGenre();
                $contentSubGenre->setContentGenre($contentGenre);
                $contentSubGenre->setName($name);
                $contentSubGenre->setLanguage($language);
                $this->entityManager->persist($contentSubGenre);
            }
        }
    }

    private function createContentCountryOfParentalRating($content, ContentModel $contentModel)
    {
        $countryOfParentRatingModel = $contentModel->getCountryOfParentalRating();
        if (!$countryOfParentRatingModel instanceof CountryOfParentalRatingModel) {
            return;
        }

        $contentCountryOfParentalRatingRepository = $this->contentRepositoryManager->getContentCountryOfParentalRatingRepository();

        $country = $countryOfParentRatingModel->getCountry();
        if ("" == $country) {
            return;
        }

        $parentalRating = $countryOfParentRatingModel->getParentalRating();
        if ("" == $parentalRating) {
            return;
        }

        $contentCountryOfParentalRating = $contentCountryOfParentalRatingRepository->getByCountry($content, $country);
        if (!$contentCountryOfParentalRating instanceof ContentCountryOfParentalRating) {
            $contentCountryOfParentalRating = new ContentCountryOfParentalRating();
            $contentCountryOfParentalRating->setContent($content);
            $contentCountryOfParentalRating->setCountry($country);

            $this->entityManager->persist($contentCountryOfParentalRating);
        }

        $contentCountryOfParentalRating->setParentalRating($parentalRating);
    }

    private function getContentIdRef(ParentSeries $parentSeries, Content $content, ContentModel $contentModel)
    {
        $contentIdRef = $contentModel->getExternalKey();

        $company = $parentSeries->getCompany();
        if (!$company instanceof Company) {
            return $contentIdRef;
        }

        if (!MTGHelper::isCompanyBelongsToMTG($company)) {
            return $contentIdRef;
        }

        if ("" != $contentIdRef) {
            return $contentIdRef;
        }

        $parentCompany = $company->getParentCompany();
        if ($parentCompany instanceof Company) { // Creating local season ID in LMB
            return "com.mtg." . strtolower($company->getCountry()) . ".content." . $content->getContentKey();
        }

        // creating shared series ID in CMB.
        return "com.mtg.shared.content." . $content->getContentKey();
    }

    private function createMediaId(ParentSeries $parentSeries, Content $content, ContentModel $contentModel)
    {
        if ($parentSeries->getCompany()->getCompanyKey() == AppConstant::VIAPLAY_UK_COMPANY_KEY and "" != $contentModel->getMediaId()) {
            $content->setMediaId($contentModel->getMediaId());
            return;
        }

        if (!MTGHelper::isCompanyBelongsToMTG($parentSeries->getCompany())) {
            return;
        }

        $mediaId = MTGHelper::extractMediaIdFromEIDR($content->getContentIdRef());
        if ("" == $mediaId) {
            return;
        }

        $content->setMediaId($mediaId);
    }

    public function createSVTEpisodeContent(ContentModel $contentModel, Episode $episode, Season $season, ParentSeries $parentSeries)
    {
        $series = $season->getSeries();

        $contentRepository = $this->contentRepositoryManager->getContentRepository();
        $content = $contentRepository->getByContentIdAndEpisode($contentModel->getExternalKey(), $episode);
        if (!$content instanceof Content) {
            $content = new Content();
            $content->setSeason($season);
            $content->setParentSeries($parentSeries);
            $content->setSeries($series);
            $content->setEpisode($episode);

            $this->entityManager->persist($content);
            $this->entityManager->flush();
        }

        $contentModel->setExternalKey($this->getContentIdRef($parentSeries, $content, $contentModel));

        $content->setParentSeries($parentSeries);
        $content->setContentIdRef($contentModel->getExternalKey());
        $content->setProductionYear($contentModel->getProductionYear());
        $content->setDvbGenre1($contentModel->getDvbGenre1());
        $content->setDvbGenre2($contentModel->getDvbGenre2());
        $content->setParentalRating($contentModel->getParentalRating());
        $content->setNetDuration($contentModel->getNetDuration());
        $this->createContentTitle($content, $contentModel);
        $this->createContentOriginalTitle($content, $contentModel->getOriginalTitle());
        $this->createContentGenericTitle($content, $contentModel);
        $this->createContentDescription($content, $contentModel);
        $this->createContentCountryOfOrigin($content, $contentModel);
        $this->createContentCountryOfParentalRating($content, $contentModel);
        $this->createContentGenres($content, $contentModel);
        $this->createMediaId($parentSeries, $content, $contentModel);

        $this->entityManager->persist($content);

        return $content;
    }
}