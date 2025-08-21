<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Migrations extends BaseConfig
{
    // Enable migrations
    public bool $enabled = true;

    // Sequential or Timestamp-based migrations
    // Options: 'sequential' or 'timestamp'
    public string $type = 'sequential';

    // Migration history table
    public string $table = 'migrations';

    // Filename format (used if type = 'timestamp')
    public string $timestampFormat = 'Y-m-d-His_';
}
