<?php
use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;

class PoP_Module_Processor_FormsFilterInput extends AbstractValueToQueryFilterInput
{
    public final const FILTERCOMPONENT_SELECTABLETYPEAHEAD_PROFILES = 'filtercomponent-selectabletypeahead-profiles';
    public final const FILTERINPUT_HASHTAGS = 'filterinput-hashtags';

    public function getFilterInputsToProcess(): array
    {
        return array(
            [self::class, self::FILTERCOMPONENT_SELECTABLETYPEAHEAD_PROFILES],
            [self::class, self::FILTERINPUT_HASHTAGS],
        );
    }

    /**
     * @todo Split this class into multiple ones, returning a single string per each ($filterInput is not valid anymore)
     */
    protected function getQueryArgKey(): string
    {
        switch ($filterInput[1]) {
            case self::FILTERCOMPONENT_SELECTABLETYPEAHEAD_PROFILES:
                $query['authors'] = $value;
                break;

            case self::FILTERINPUT_HASHTAGS:
                // tags provided separated by space, color or comma
                $tags = [];
                foreach (multiexplode(array(',', ';', ' '), $value) as $hashtag) {
                    if ($hashtag) {
                        $tags[] = (substr($hashtag, 0, 1) == '#') ? substr($hashtag, 1) : $hashtag;
                    }
                }
                $query['tags'] = $tags;
                break;
        }
    }
}
