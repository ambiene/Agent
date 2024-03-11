# Agent

The library provides a solution for detecting various properties of a user's device, including whether the device is mobile, tablet, or desktop, identifying crawlers/bots, and determining the operating system. It leverages MobileDetect and CrawlerDetect libraries to offer a robust detection mechanism suitable for a wide range of web applications.

## Features

- Mobile, tablet, and desktop detection
- Crawler and bot detection
- Operating system identification, including specific versions and distributions
- User agent parsing

## Usage

### Initializing the Agent Class

```php
use Ambiene\Agent\Agent;

$agent = new Agent();
```

### Detecting Device Type

```php
$isMobile = $agent->isMobile();
$isTablet = $agent->isTablet();
$isDesktop = $agent->isDesktop();
```

### Detecting Operating System

```php
$os = $agent->os();
```

## Checking for Crawlers

```php
$crawler = $agent->isCrawler();
```

## Browser Detection

```php
$browser = $agent->browser();
```

## Setting a Custom User Agent

```php
$userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0';
$agent->set($userAgent);
```