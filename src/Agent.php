<?php

namespace Ambiene\Agent;

use Detection\MobileDetect;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class Agent
{
    /**
     * @var MobileDetect
     */
    protected MobileDetect $mobileDetect;

    /**
     * @var CrawlerDetect
     */
    protected CrawlerDetect $crawlerDetect;

    /**
     * Operating systems
     *
     * @var string[]
     */
    protected array $operatingSystems = [
        'android' => '/Android/i',
        'ios' => '/(iPhone|iPad|iPod)/i',
        'windows' => '/Windows NT/i',
        'macOS' => '/Macintosh.*Mac OS X/i',
        'linux' => '/Linux/i',
    ];

    /**
     * Browsers
     *
     * @var array|string[]
     */
    protected array $browsers = [
        'chrome' => '/Chrome/i',
        'firefox' => '/Firefox/i',
        'safari' => '/Safari/i',
        'edge' => '/Edg/i',
        'ie' => '/MSIE/i',
    ];

    /**
     * Create a new Agent instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mobileDetect = new MobileDetect();
        $this->crawlerDetect = new CrawlerDetect();
    }

    /**
     * Determine if the user is using a desktop device.
     *
     * @param $userAgent
     * @return bool
     */
    public function isDesktop($userAgent = null): bool
    {
        return !$this->isMobile($userAgent) && !$this->isTablet($userAgent) && !$this->isCrawler($userAgent);
    }

    /**
     * Determine if the user is using a mobile device.
     *
     * @param $userAgent
     * @return bool
     */
    public function isMobile($userAgent = null): bool
    {
        return $this->mobileDetect->isMobile($userAgent);
    }

    /**
     * Determine if the user is using a tablet device.
     *
     * @param $userAgent
     * @return bool
     */
    public function isTablet($userAgent = null): bool
    {
        return $this->mobileDetect->isTablet($userAgent);
    }

    /**
     * Determine if the user is using a crawler/robot.
     *
     * @param $userAgent
     * @return bool
     */
    public function isCrawler($userAgent = null): bool
    {
        return $this->crawlerDetect->isCrawler($userAgent);
    }

    /**
     * Get the user agent.
     *
     * @return string
     */
    public function userAgent(): string
    {
        return $this->mobileDetect->getUserAgent();
    }

    /**
     * Get the user's operating system.
     *
     * @param $userAgent
     * @return string
     */
    public function os($userAgent = null): string
    {
        $userAgent = $userAgent ?: $this->userAgent();

        foreach ($this->operatingSystems as $os => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $os;
            }
        }

        return 'unknown';
    }

    /**
     * Get the user's browser.
     *
     * @param $userAgent
     * @return string
     */
    public function browser($userAgent = null): string
    {
        $userAgent = $userAgent ?: $this->userAgent();

        foreach ($this->browsers as $browser => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $browser;
            }
        }

        return 'unknown';
    }

    /**
     * Get the user's device type.
     *
     * @param $userAgent
     * @return string
     */
    public function type($userAgent = null): string
    {
        return match (true) {
            $this->isMobile($userAgent) => 'mobile',
            $this->isTablet($userAgent) => 'tablet',
            $this->isDesktop($userAgent) => 'desktop',
            default => 'unknown',
        };
    }

    /**
     * Set the user agent.
     *
     * @param $userAgent
     * @return void
     */
    public function set($userAgent): void
    {
        $this->mobileDetect->setUserAgent($userAgent);
        $this->crawlerDetect->setUserAgent($userAgent);
    }
}