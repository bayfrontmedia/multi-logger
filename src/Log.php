<?php

namespace Bayfront\MultiLogger;

use Bayfront\MultiLogger\Exceptions\ChannelNotFoundException;
use Monolog\Logger;

class Log
{

    private string $default_channel;
    private string $current_channel;

    /**
     * LoggerFactory constructor.
     *
     * @param Logger $logger (Automatically set as the default and current channel)
     */
    public function __construct(Logger $logger)
    {
        $this->addChannel($logger);
        $this->default_channel = $logger->getName();
        $this->current_channel = $logger->getName();
    }

    private array $channels = []; // Logger instances

    /*
     * ############################################################
     * Channels
     * ############################################################
     */

    /**
     * Return array of channel names.
     *
     * @return array
     */

    public function getChannels(): array
    {
        return array_keys($this->channels);
    }

    /**
     * Return name of default channel.
     *
     * @return string
     */

    public function getDefaultChannel(): string
    {
        return $this->default_channel;
    }

    private function setCurrentChannel(string $channel): void
    {
        $this->current_channel = $channel;
    }

    /**
     * Return name of current channel.
     *
     * @return string
     */

    public function getCurrentChannel(): string
    {
        return $this->current_channel;
    }

    /**
     * Add a logger instance as a new channel with the same name.
     *
     * If an existing instance exists with the same name, it will be overwritten.
     *
     * @param Logger $logger
     *
     * @return self
     */

    public function addChannel(Logger $logger): self
    {
        $this->channels[$logger->getName()] = $logger;
        return $this;
    }

    /**
     * Does channel name exist?
     *
     * @param string $channel
     *
     * @return bool
     */

    public function isChannel(string $channel): bool
    {
        return in_array($channel, $this->getChannels());
    }

    /**
     * Returns Logger instance for a given channel.
     *
     * @param string $channel (Name of channel to return. If empty string, the current channel will be returned.)
     *
     * @return Logger
     *
     * @throws ChannelNotFoundException
     */

    public function getChannel(string $channel = ''): Logger
    {

        if ($channel == '') {
            $channel = $this->getCurrentChannel();
        }

        if (!$this->isChannel($channel)) {
            throw new ChannelNotFoundException('Unable to get channel (' . $channel . '): channel not found');
        }

        return $this->channels[$channel];

    }

    /**
     * Set the current channel name to be used for the next logged event.
     *
     * By default, all logged events will be logged to the default channel used in the constructor.
     *
     * @param string $channel
     *
     * @return self
     *
     * @throws ChannelNotFoundException
     */

    public function channel(string $channel): self
    {

        if (!$this->isChannel($channel)) {
            throw new ChannelNotFoundException('Unable to use channel (' . $channel . '): channel not found');
        }

        $this->current_channel = $channel;

        return $this;

    }

    /*
     * ############################################################
     * Logging events
     * ############################################################
     */

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function emergency(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->emergency($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function alert(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->alert($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function critical(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->critical($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function error(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->error($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function warning(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->warning($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function notice(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->notice($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function info(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->info($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function debug(string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->debug($message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */

    public function log(mixed $level, string $message, array $context = array()): void
    {

        try {
            $logger = $this->getChannel($this->getCurrentChannel());
        } catch (ChannelNotFoundException) {
            return;
        }

        $logger->log($level, $message, $context);

        $this->setCurrentChannel($this->getDefaultChannel());

    }

}