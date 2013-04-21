<?php
namespace CarlosIO\Geckoboard\Widgets;

use CarlosIO\Geckoboard\Widgets\Widget;

/**
 * Class NumberAndSecondaryStat
 * @package CarlosIO\Geckoboard\Widgets
 */
class NumberAndSecondaryStat extends Widget
{
    private $mainValue = null;
    private $secondaryValue = null;
    private $mainPrefix = null;

    /**
     * Set data main prefix (€, $, etc.)
     *
     * @param string $mainPrefix
     * @return $this
     */
    public function setMainPrefix($mainPrefix)
    {
        $this->mainPrefix = $mainPrefix;

        return $this;
    }

    /**
     * Get data main prefix (€, $, etc.)
     *
     * @return string
     */
    public function getMainPrefix()
    {
        return $this->mainPrefix;
    }

    /**
     * Set main value
     *
     * @param int $mainValue
     * @return $this
     */
    public function setMainValue($mainValue)
    {
        $this->mainValue = $mainValue;

        return $this;
    }

    /**
     * Get main value
     *
     * @return int
     */
    public function getMainValue()
    {
        return $this->mainValue;
    }

    /**
     * Set secondary value
     *
     * @param int $secondaryValue
     * @return $this
     */
    public function setSecondaryValue($secondaryValue)
    {
        $this->secondaryValue = $secondaryValue;

        return $this;
    }

    /**
     * Get secondary value
     *
     * @return string
     */
    public function getSecondaryValue()
    {
        return $this->secondaryValue;
    }

    /**
     * Get data in array format
     *
     * @return array
     */
    public function getData()
    {
        $result = array(
            'item' => array(
                array(
                    'text' => '',
                    'value' => (int) $this->getMainValue(),
                    'prefix' => (string) $this->getMainPrefix()
                )
            )
        );

        $secondaryValue = $this->getSecondaryValue();
        if (null !== $secondaryValue) {
            $result['item'][] = array(
                'text' => '',
                'value' => (int) $secondaryValue
            );
        }

        return $result;
    }
}