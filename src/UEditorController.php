<?php
/** .-------------------------------------------------------------------
 * |      Site: www.zhouzy365.com
 * |      Date: 2019/9/10 下午3:13
 * |    Author: zzy <348858954@qq.com>
 * '-------------------------------------------------------------------*/

namespace Zzy\LaravelUEditor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class UEditorController.
 */
class UEditorController extends Controller
{
    public function serve(Request $request)
    {
        $upload = config('ueditor.upload');
        $storage = app('ueditor.storage');

        switch ($request->get('action')) {
            case 'config':
                return config('ueditor.upload');

            // lists
            case $upload['imageManagerActionName']:
                return $storage->listFiles(
                    $upload['imageManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['imageManagerAllowFiles']);
            case $upload['fileManagerActionName']:
                return $storage->listFiles(
                    $upload['fileManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $upload['fileManagerAllowFiles']);
            case $upload['catcherActionName']:
                return $storage->fetch($request);
            default:
                return $storage->upload($request);
        }
    }
}
