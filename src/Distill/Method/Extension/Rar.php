<?php

/*
 * This file is part of the Distill package.
 *
 * (c) Raul Fraile <raulfraile@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Distill\Method\Extension;

use Distill\Exception\FormatNotSupportedInMethodException;
use Distill\File;
use Distill\Format\FormatInterface;
use Distill\Method\AbstractMethod;

/**
 * Extracts files from bzip2 archives.
 *
 * @author Raul Fraile <raulfraile@gmail.com>
 */
class Rar extends AbstractMethod
{

    /**
     * {@inheritdoc}
     */
    public function extract($file, $target, FormatInterface $format)
    {
        if (!$this->isSupported()) {
            return false;
        }

        if (false === $this->isFormatSupported($format)) {
            throw new FormatNotSupportedInMethodException($this, $format);
        }

        $rar = @\RarArchive::open($file);

        if (false === $rar) {
            return false;
        }

        $this->getFilesystem()->mkdir($target);

        foreach ($rar->getEntries() as $entry) {
            $entry->extract($target);
        }

        $rar->close();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isSupported()
    {
        return class_exists('\\RarArchive');
    }

    /**
     * {@inheritdoc}
     */
    public static function getClass()
    {
        return get_class();
    }

}