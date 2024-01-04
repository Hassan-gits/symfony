<?php

namespace CS\MainBundle\Entity;

use CS\MainBundle\Helper\UtilHelper;
use Doctrine\Common\Collections\ArrayCollection;

class Content
{
    private $id;
    private $contentKey;
    private $contentIdRef;
    private $externalSourceId; //External contentId 2
    private $productionYear;
    private $productionCompany;
    private $website;
    private $data;
    private $linkItData;
    private $mediaId;
    private $mediaVersion;
    private $dvbGenre1;
    private $dvbGenre2;
    private $tag; // Discovery Finland required this field to add Elokuva, 5D etc.
    private $countryOfOrigins;
    private $parentalRating;
    private $clientUniqueId;
    private $masterContentKey;
    private $firstAirDate;
    private $duration;
    private $netDuration;
    private $autoUnpublishedDate;

    private $houseNumber;
    private $extraInformation;
    private $wideScreen = false;
    private $isArchived = false;

    private $titles;
    private $genericTitles;
    private $descriptions;
    private $parentSeries;
    private $series;
    private $season;
    private $episode;
    private $credits;
    private $relatedFiles;
    private $genres;
    private $countryOfParentalRatings;

    public function __construct()
    {
        $this->contentKey = UtilHelper::generateEntityKey();
        $this->credits = new ArrayCollection();
        $this->relatedFiles = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->countryOfParentalRatings = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContentKey()
    {
        return $this->contentKey;
    }

    /**
     * @param mixed $contentKey
     */
    public function setContentKey($contentKey)
    {
        $this->contentKey = $contentKey;
    }

    /**
     * @return mixed
     */
    public function getExternalSourceId()
    {
        return $this->externalSourceId;
    }

    /**
     * @param mixed $externalSourceId
     */
    public function setExternalSourceId($externalSourceId)
    {
        $this->externalSourceId = $externalSourceId;
    }


    /**
     * @return mixed
     */
    public function getContentIdRef()
    {
        return $this->contentIdRef;
    }

    /**
     * @param mixed $contentIdRef
     */
    public function setContentIdRef($contentIdRef)
    {
        $this->contentIdRef = $contentIdRef;
    }

    /**
     * @return mixed
     */
    public function getProductionYear()
    {
        return $this->productionYear;
    }

    /**
     * @param mixed $productionYear
     */
    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;
    }

    /**
     * @return mixed
     */
    public function getProductionCompany()
    {
        return $this->productionCompany;
    }

    /**
     * @param mixed $productionCompany
     */
    public function setProductionCompany($productionCompany)
    {
        $this->productionCompany = $productionCompany;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getLinkItData()
    {
        return json_decode($this->linkItData, true);
    }

    /**
     * @param mixed $linkItData
     */
    public function setLinkItData($linkItData)
    {
        $this->linkItData = json_encode($linkItData);
    }

    /**
     * @return bool
     */
    public function isWideScreen()
    {
        return $this->wideScreen;
    }

    /**
     * @param bool $wideScreen
     */
    public function setWideScreen($wideScreen)
    {
        $this->wideScreen = $wideScreen;
    }

    /**
     * @return mixed
     */
    public function getIsArchived()
    {
        return $this->isArchived;
    }

    /**
     * @param mixed $isArchived
     */
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;
    }

    /**
     * @return mixed
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * @param mixed $titles
     */
    public function setTitles($titles)
    {
        $this->titles = $titles;
    }

    /**
     * @return mixed
     */
    public function getGenericTitles()
    {
        return $this->genericTitles;
    }

    /**
     * @param mixed $genericTitles
     */
    public function setGenericTitles($genericTitles)
    {
        $this->genericTitles = $genericTitles;
    }

    /**
     * @return mixed
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param mixed $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @return ParentSeries
     */
    public function getParentSeries()
    {
        return $this->parentSeries;
    }

    /**
     * @param mixed $parentSeries
     */
    public function setParentSeries($parentSeries)
    {
        $this->parentSeries = $parentSeries;
    }

    /**
     * @return mixed
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param mixed $series
     */
    public function setSeries($series)
    {
        $this->series = $series;
    }

    /**
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * @return Episode
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * @param mixed $episode
     */
    public function setEpisode($episode)
    {
        $this->episode = $episode;
    }

    /**
     * @return mixed
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param mixed $credits
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;
    }

    /**
     * @return ArrayCollection
     */
    public function getRelatedFiles()
    {
        return $this->relatedFiles;
    }

    /**
     * @param ArrayCollection $relatedFiles
     */
    public function setRelatedFiles($relatedFiles)
    {
        $this->relatedFiles = $relatedFiles;
    }

    /**
     * @return mixed
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * @param mixed $mediaId
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
    }

    /**
     * @return mixed
     */
    public function getMediaVersion()
    {
        return $this->mediaVersion;
    }

    /**
     * @param mixed $mediaVersion
     */
    public function setMediaVersion($mediaVersion)
    {
        $this->mediaVersion = $mediaVersion;
    }

    /**
     * @return mixed
     */
    public function getDvbGenre1()
    {
        return $this->dvbGenre1;
    }

    /**
     * @param mixed $dvbGenre1
     */
    public function setDvbGenre1($dvbGenre1)
    {
        $this->dvbGenre1 = $dvbGenre1;
    }

    /**
     * @return mixed
     */
    public function getDvbGenre2()
    {
        return $this->dvbGenre2;
    }

    /**
     * @param mixed $dvbGenre2
     */
    public function setDvbGenre2($dvbGenre2)
    {
        $this->dvbGenre2 = $dvbGenre2;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return array
     */
    public function getCountryOfOrigins()
    {
        $countryOfOrigins = json_decode($this->countryOfOrigins, true);

        return is_null($countryOfOrigins) ? array() : $countryOfOrigins;
    }

    /**
     * @param array $countryOfOrigins
     */
    public function setCountryOfOrigins($countryOfOrigins)
    {
        $this->countryOfOrigins = json_encode($countryOfOrigins);
    }

    /**
     * @return mixed
     */
    public function getParentalRating()
    {
        return $this->parentalRating;
    }

    /**
     * @param mixed $parentalRating
     */
    public function setParentalRating($parentalRating)
    {
        $this->parentalRating = $parentalRating;
    }

    /**
     * @return mixed
     */
    public function getClientUniqueId()
    {
        return $this->clientUniqueId;
    }

    /**
     * @param mixed $clientUniqueId
     */
    public function setClientUniqueId($clientUniqueId)
    {
        $this->clientUniqueId = $clientUniqueId;
    }

    /**
     * @return ArrayCollection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param ArrayCollection $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    /**
     * @return ArrayCollection
     */
    public function getCountryOfParentalRatings()
    {
        return $this->countryOfParentalRatings;
    }

    /**
     * @param ArrayCollection $countryOfParentalRatings
     */
    public function setCountryOfParentalRatings(ArrayCollection $countryOfParentalRatings)
    {
        $this->countryOfParentalRatings = $countryOfParentalRatings;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return mixed
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @param mixed $houseNumber
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @return mixed
     */
    public function getExtraInformation()
    {
        return $this->extraInformation;
    }

    /**
     * @param mixed $extraInformation
     */
    public function setExtraInformation($extraInformation)
    {
        $this->extraInformation = $extraInformation;
    }

    /**
     * @return mixed
     */
    public function getMasterContentKey()
    {
        return $this->masterContentKey;
    }

    /**
     * @param mixed $masterContentKey
     */
    public function setMasterContentKey($masterContentKey)
    {
        $this->masterContentKey = $masterContentKey;
    }

    /**
     * @return \DateTime
     */
    public function getFirstAirDate()
    {
        return $this->firstAirDate;
    }

    /**
     * @param \DateTime $firstAirDate
     */
    public function setFirstAirDate($firstAirDate)
    {
        $this->firstAirDate = $firstAirDate;
    }

    /**
     * @return mixed
     */
    public function getNetDuration()
    {
        return $this->netDuration;
    }

    /**
     * @param mixed $netDuration
     */
    public function setNetDuration($netDuration)
    {
        $this->netDuration = $netDuration;
    }

    /**
     * @return mixed
     */
    public function getAutoUnpublishedDate()
    {
        return $this->autoUnpublishedDate;
    }

    /**
     * @param mixed $autoUnpublishedDate
     */
    public function setAutoUnpublishedDate($autoUnpublishedDate)
    {
        $this->autoUnpublishedDate = $autoUnpublishedDate;
    }
}