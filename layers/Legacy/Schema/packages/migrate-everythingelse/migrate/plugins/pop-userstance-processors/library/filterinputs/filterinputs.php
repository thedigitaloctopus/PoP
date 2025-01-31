<?php
use PoP\ComponentModel\FilterInputs\AbstractValueToQueryFilterInput;

class PoP_Module_Processor_UserStanceFilterInput extends AbstractValueToQueryFilterInput
{
    public final const FILTERINPUT_STANCE_MULTISELECT = 'filterinput-multiselect-stance';

    public function getFilterInputsToProcess(): array
    {
        return array(
            [self::class, self::FILTERINPUT_STANCE_MULTISELECT],
        );
    }

    /**
     * @todo Split this class into multiple ones, returning a single string per each ($filterInput is not valid anymore)
     */
    protected function getQueryArgKey(): string
    {
        switch ($filterInput[1]) {

            case self::FILTERINPUT_STANCE_MULTISELECT:
                $query['tax-query'] = $query['tax-query'] ?? ['relation' => 'AND'];
                $taxonomy_terms = [];
                foreach ($value as $pair) {
                    $elements = explode('|', $pair);
                    $taxonomy = $elements[0];
                    $term = $elements[1];
                    $taxonomy_terms[$taxonomy][] = $term;
                }
                foreach ($taxonomy_terms as $taxonomy => $terms) {
                    $query['tax-query'][] = [
                        'taxonomy' => $taxonomy,
                        'terms' => $terms,
                    ];
                }
                break;
        }
    }
}
