<?php

/*
 * This file is part of the Distill package.
 *
 * (c) Raul Fraile <raulfraile@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Distill\Format;

use Distill\Method;

class X7z implements FormatInterface
{

    /**
     * {@inheritdoc}
     */
    public function getCompressionRatioLevel()
    {
        return FormatInterface::LEVEL_HIGH;
    }

    /**
     * {@inheritdoc}
     */
    public function getUncompressionSpeedLevel()
    {
        return FormatInterface::LEVEL_HIGH;
    }

    /**
     * {@inheritdoc}
     */
    public function getCompressionSpeedLevel()
    {
        return FormatInterface::LEVEL_MIDDLE;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensions()
    {
        return ['7z'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUncompressionMethods()
    {
        return [
            Method\X7zCommandMethod::getName()
        ];
    }

}
