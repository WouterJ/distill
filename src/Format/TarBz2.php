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

class TarBz2 extends AbstractFormat
{
    /**
     * {@inheritdoc}
     */
    public static function getCompressionRatioLevel()
    {
        return FormatInterface::RATIO_LEVEL_HIGH;
    }

    /**
     * {@inheritdoc}
     */
    public static function getExtensions()
    {
        return ['tar.bz2', 'tar.bz', 'tbz2', 'tbz', 'tb2'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getClass()
    {
        return get_class();
    }

    /**
     * {@inheritdoc}
     */
    public function isComposed()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getComposedFormats()
    {
        return [
            Bz2::getClass(),
            Tar::getClass(),
        ];
    }

}
