<?php

namespace Ambiene\Agent;

use Detection\MobileDetect;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class Agent
{
    /**
     * @var MobileDetect $mobileDetect
     */
    protected MobileDetect $mobileDetect;

    /**
     * @var CrawlerDetect CrawlerDetect
     */
    protected CrawlerDetect $crawlerDetect;

    public function __construct()
    {
        $this->mobileDetect = new MobileDetect();
        $this->crawlerDetect = new CrawlerDetect();
    }

    /**
     * Check if the user agent is a desktop.
     *
     * @param $userAgent
     * @return bool
     */
    public function isDesktop($userAgent = null): bool
    {
        return !$this->isMobile($userAgent) && !$this->isTablet($userAgent) && !$this->isRobot($userAgent);
    }

    /**
     * Check if the user agent is a mobile device.
     *
     * @param $userAgent
     * @return bool
     */
    public function isMobile($userAgent = null): bool
    {
        return $this->mobileDetect->isMobile($userAgent) && !$this->mobileDetect->isTablet($userAgent);
    }

    /**
     * Check if the user agent is a tablet.
     *
     * @param $userAgent
     * @return bool
     */
    public function isTablet($userAgent = null): bool
    {
        return $this->mobileDetect->isTablet($userAgent);
    }

    /**
     * Check if the user agent is a robot.
     *
     * @param $userAgent
     * @return bool
     */
    public function isRobot($userAgent = null): bool
    {
        $this->crawlerDetect = new CrawlerDetect();
        return $this->crawlerDetect->isCrawler($userAgent);
    }

    public function robot($userAgent = null): bool
    {
        $this->crawlerDetect = new CrawlerDetect();

        if ($this->crawlerDetect->isCrawler($userAgent)) {
            return ucfirst($this->crawlerDetect->getMatches());
        }

        return false;
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
     * Get the operating system.
     *
     * @param $userAgent
     * @return string
     */
    public function operatingSystem($userAgent = null): string
    {
        $userAgent = $userAgent ?: $this->userAgent();

        $patterns = [
            'android' => '/Android/i',
            'ios' => '/(iPhone|iPad|iPod)/i',
            'windows' => '/Windows NT/i',
            'macOS' => '/Macintosh.*Mac OS X/i',
            'linux' => '/Linux/i',
        ];

        foreach ($patterns as $os => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $os;
            }
        }

        return 'unknown';
    }

    /**
     * Get the device type.
     *
     * @param $userAgent
     * @return string
     */
    public function deviceType($userAgent = null): string
    {
        return match (true) {
            $this->isMobile($userAgent) => 'mobile',
            $this->isTablet($userAgent) => 'tablet',
            $this->isDesktop($userAgent) => 'desktop',
            $this->isRobot($userAgent) => 'robot',
            default => 'unknown',
        };
    }
}
