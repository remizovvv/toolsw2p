<?php
/**
 * Created by PhpStorm.
 * User: omadonex
 * Date: 12.02.2018
 * Time: 15:42
 */

namespace Omadonex\ToolsW2p\Classes;

class AppConstants
{
    const LENGTH_API_TOKEN = 64;
    const LENGTH_ACTIVATION_TOKEN = 64;

    const LICENSE_PERMISSION_CRM = 1;
    const LICENSE_PERMISSION_PRODUCTS = 2;
    const LICENSE_PERMISSION_EXCHANGE = 3;

    const SUBDOMAIN_RECORD_TYPE_TYPOGRAPHY = 'typography';
    const SUBDOMAIN_RECORD_TYPE_ALIAS = 'alias';
    const SUBDOMAIN_RECORD_TYPE_LICENSE = 'license';
    const SUBDOMAIN_RECORD_TYPE_PERMISSION = 'permission';
}