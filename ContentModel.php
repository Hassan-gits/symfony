<?php

namespace MediaBox\Content;

use CS\MainBundle\Entity\Content;

class ContentModel
{
    private $contentKey;
    private $title;
    private $originalTitle;
    private $genericTitle;
    private $parentSeriesTitle;
    private $parentSeriesOriginalTitle;

    private $tiny;
    private $short;
    private $medium;
    private $long;
    private $extended;

    private $pressWebText;
    private $productionYear;
    private $dvbGenre1;
    private $dvbGenre2;
    private $genres = array();
    private $language = "swe";
    private $productionCompany;
    private $website;
    private $audioDescribed;
    private $countryOfOrigin;
    private $parentalRating;
    private $countryOfParentalRating;
    private $poster;
    private $content;
    private $externalKey;
    private $tag;
    private $mediaId;
    private $netDuration;
    private $autoUnpublishedDate;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * @param mixed $originalTitle
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;
    }

    /**
     * @return mixed
     */
    public function getGenericTitle()
    {
        return $this->genericTitle;
    }

    /**
     * @param mixed $genericTitle
     */
    public function setGenericTitle($genericTitle)
    {
        $this->genericTitle = $genericTitle;
    }

    /**
     * @return mixed
     */
    public function getParentSeriesTitle()
    {
        return $this->parentSeriesTitle;
    }

    /**
     * @param mixed $parentSeriesTitle
     */
    public function setParentSeriesTitle($parentSeriesTitle)
    {
        $this->parentSeriesTitle = $parentSeriesTitle;
    }

    /**
     * @return mixed
     */
    public function getPressWebText()
    {
        return $this->pressWebText;
    }

    /**
     * @param mixed $pressWebText
     */
    public function setPressWebText($pressWebText)
    {
        $this->pressWebText = $pressWebText;
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
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @param mixed $poster
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    /**
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param array $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    /**
     * @return mixed
     */
    public function getAudioDescribed()
    {
        return $this->audioDescribed;
    }

    /**
     * @param mixed $audioDescribed
     */
    public function setAudioDescribed($audioDescribed)
    {
        $this->audioDescribed = $audioDescribed;
    }

    /**
     * @return mixed
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @param mixed $countryOfOrigin
     */
    public function setCountryOfOrigin($countryOfOrigin)
    {
        $this->countryOfOrigin = $countryOfOrigin;
    }

    /**
     * @return mixed
     */
    public function getExternalKey()
    {
        return $this->externalKey;
    }

    /**
     * @param mixed $externalKey
     */
    public function setExternalKey($externalKey)
    {
        $this->externalKey = $externalKey;
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
     * @return mixed
     */
    public function getTiny()
    {
        return $this->tiny;
    }

    /**
     * @param mixed $tiny
     */
    public function setTiny($tiny)
    {
        $this->tiny = $tiny;
    }

    /**
     * @return mixed
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * @param mixed $short
     */
    public function setShort($short)
    {
        $this->short = $short;
    }

    /**
     * @return mixed
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * @param mixed $medium
     */
    public function setMedium($medium)
    {
        $this->medium = $medium;
    }


    /**
     * @return mixed
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param mixed $long
     */
    public function setLong($long)
    {
        $this->long = $long;
    }

    /**
     * @return mixed
     */
    public function getExtended()
    {
        return $this->extended;
    }

    /**
     * @param mixed $extended
     */
    public function setExtended($extended)
    {
        $this->extended = $extended;
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
    public function getParentSeriesOriginalTitle()
    {
        return $this->parentSeriesOriginalTitle;
    }

    /**
     * @param mixed $parentSeriesOriginalTitle
     */
    public function setParentSeriesOriginalTitle($parentSeriesOriginalTitle)
    {
        $this->parentSeriesOriginalTitle = $parentSeriesOriginalTitle;
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
    public function getCountryOfParentalRating()
    {
        return $this->countryOfParentalRating;
    }

    /**
     * @param mixed $countryOfParentalRating
     */
    public function setCountryOfParentalRating($countryOfParentalRating)
    {
        $this->countryOfParentalRating = $countryOfParentalRating;
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