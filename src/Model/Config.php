<?php
/**
 * This file is part of Jclecas EventLog
 *
 * @author JC Lecas <jeanchristophe.lecas@gmail.com> <@jclecas>
 * @category Jclecas
 * @package Jclecas\EventLog\Model
 * @license MIT
 * @copyright Copyright (c) 2018 JC Lecas (http://jclecas.com)
 */

namespace Jclecas\EventLog\Model;

use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;

class Config
{
    const XML_PATH_JCLECAS_EVENTLOG_GENERAL_ACTIVE = 'jclecas_eventlog/general/active';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Is Active
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->scopeConfig->getValue(
            self::XML_PATH_JCLECAS_EVENTLOG_GENERAL_ACTIVE,
            ScopeInterface::SCOPE_STORE
        );
    }
}
