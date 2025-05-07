<?php

namespace SocialChannels\Model;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;

class SocialChannel extends DataObject
{
    private static array $db = [
        'Title' => 'Text',
        'Link' => 'Text',
        'Icon' => 'Text',
        'SortOrder' => 'Int',
    ];

    private static array $has_one = [
        'SiteConfig' => SiteConfig::class,
    ];

    protected function getIcons(): array
    {
        $icons = [
            'bi bi-facebook' => 'Facebook',
            'bi bi-instagram' => 'Instagram',
            'bi bi-twitter-x' => 'Twitter',
            'bi bi-youtube' => 'Youtube',
            'bi bi-linkedin' => 'LinkedIn',
            'bi bi-pinterest' => 'Pinterest',
            'bi bi-tiktok' => 'TikTok',
            'bi bi-whatsapp' => 'WhatsApp',
            'bi bi-telegram' => 'Telegram',
            'bi bi-snapchat' => 'Snapchat',
            'bi bi-discord' => 'Discord',
            'bi bi-reddit' => 'Reddit',
            'bi bi-vimeo' => 'Vimeo',
        ];

        $this->extend('updateIcons', $icons);

        return $icons;
    }

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SiteConfigID',
            'SortOrder',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title', 'Titel'),
            TextField::create('Link', 'Link'),
            DropdownField::create('Icon', 'Icon', $this->getIcons())
                ->setEmptyString('Bitte wählen')
                ->setDescription('Icon für den Social Channel'),
        ]);

        return $fields;
    }
}
