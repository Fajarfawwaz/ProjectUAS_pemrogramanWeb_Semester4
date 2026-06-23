<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use App\Filters\Cors; 
use App\Filters\AuthFilter; // Pastikan file AuthFilter.php sudah ada di folder App/Filters/
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'authFilter'    => AuthFilter::class, // Alias untuk Filter JWT
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
    ];

    /**
     * List of special required filters.
     */
    public array $required = [
        'before' => [
            'forcehttps',
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    /**
     * List of filter aliases that are always applied before and after every request.
     */
    public array $globals = [
        'before' => [
            'cors', // Tetap aktif secara global
        ],
        'after' => [],
    ];

    public array $methods = [];

    /**
     * Proteksi endpoint spesifik yang memerlukan akses login/token.
     */
    public array $filters = [
        'authFilter' => [
            'before' => [
                'book/create', 
                'book/update/*', 
                'book/delete/*',
                'peminjaman/create', 
                'peminjaman/return/*',
                'kategori/*'
            ]
        ]
    ];
}