<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\LaravelUEditor\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Uploading.
 *
 * @author overtrue <i@overtrue.me>
 */
class Uploading
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public $file;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var array
     */
    public $config;

    /**
     * Uploading constructor.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param                                                     $filename
     * @param array                                               $config
     */
    public function __construct(UploadedFile $file, $filename, array $config)
    {
        $this->file = $file;
        $this->filename = $filename;
        $this->config = $config;
    }
}
