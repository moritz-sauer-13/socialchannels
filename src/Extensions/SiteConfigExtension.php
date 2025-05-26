<?php

namespace SocialChannels\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\Tab;
use SocialChannels\Model\SocialChannel;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class SiteConfigExtension extends Extension
{
    private static array $has_many = [
        'SocialChannels' => SocialChannel::class,
    ];

    public function updateCMSFields(FieldList $fields): void
    {
        $fields->addFieldToTab('Root', Tab::create('SocialChannelsTab', "Socialmediakanäle"));
        $fields->addFieldToTab(
            'Root.SocialChannelsTab',
            GridField::create(
                'SocialChannels',
                "Socialmediakanäle",
                $this->owner->sortedSocialChannels(),
                GridFieldConfig_RecordEditor::create()
                    ->addComponent(GridFieldOrderableRows::create('SortOrder'))
            )
        );
    }

    public function sortedSocialChannels()
    {
        return $this->owner->SocialChannels()->sort('SortOrder');
    }
}
