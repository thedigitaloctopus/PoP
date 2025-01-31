<?php
namespace PoP\ComponentModel;

class StratumManager
{
    private $selected_stratum;
    private $stratum_strata = [];
    private $last_registered_stratum;

    public function __construct()
    {
        StratumManagerFactory::setInstance($this);
        \PoP\Root\App::addAction(
            'plugins_loaded',
            $this->init(...),
            888395
        );
    }

    public function add($stratum, $strata)
    {
        $this->stratum_strata[$stratum] = $strata;
        $this->last_registered_stratum = $stratum;
    }

    public function init()
    {
        // Selected comes in URL param 'stratum'
        $this->selected_stratum = \PoP\Root\App::query(\PoP\ConfigurationComponentModel\Constants\Params::STRATUM);

        // Check if the selected theme is inside $stratum_strata
        if (!$this->selected_stratum || !in_array($this->selected_stratum, array_keys($this->stratum_strata))) {
            $this->selected_stratum = $this->getDefaultStratum();
        }
    }

    public function getDefaultStratum()
    {
        // By default, use the last defined stratum (the highest-level one) as the default
        return \PoP\Root\App::applyFilters(
            'Stratum:default',
            $this->last_registered_stratum
        );
    }

    public function getStratum()
    {
        return $this->selected_stratum;
    }
    public function getStrata($stratum = null)
    {
        $stratum = $stratum ?? $this->selected_stratum;
        return $this->stratum_strata[$stratum] ?? [];
    }

    public function isDefaultStratum()
    {
        return $this->selected_stratum == $this->getDefaultStratum();
    }
}

/**
 * Initialization
 */
new StratumManager();
