<?php

/*
 * This file is part of the Distill package.
 *
 * (c) Raul Fraile <raulfraile@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Distill\Extractor\Adapter;

use Distill\File;
use Distill\Format\Bz2;

/**
 * Extracts files from bzip2 archives.
 *
 * @author Raul Fraile <raulfraile@gmail.com>
 */
class Bz2Adapter extends AbstractAdapter
{

    /**
     * Constructor.
     */
    public function __construct($methods = null)
    {
        if (null === $methods) {
            $methods = array(
                array('self', 'extractBzip2Command'),
                array('self', 'extract7zCommand')
            );
        }

        $this->methods = $methods;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(File $file)
    {
        return $file->getFormat() instanceof Bz2 &&
            ($this->existsCommand('bzip2') || $this->existsCommand('7z'));
    }

    /**
     * Extracts the bz2 file using the tar command.
     * @param File   $file Compressed file
     * @param string $path Destination path
     *
     * @return bool Returns TRUE when successful, FALSE otherwise
     */
    protected function extractBzip2Command(File $file, $path)
    {
        if ($this->isWindows()) {
            return false;
        }

        $command = sprintf("bzip2 -k -d -c %s >> %s", escapeshellarg($file->getPath()), escapeshellarg($path));

        return $this->executeCommand($command);
    }

    /**
     * Extracts the bz2 file using the unzip command.
     * @param File   $file Compressed file
     * @param string $path Destination path
     *
     * @return bool Returns TRUE when successful, FALSE otherwise
     */
    protected function extract7zCommand(File $file, $path)
    {
        if ($this->isWindows()) {
            return false;
        }

        @mkdir($path);
        $command = '7z e -y '.escapeshellarg($file->getPath()).' -o'.escapeshellarg($path);

        return $this->executeCommand($command);
    }

}
