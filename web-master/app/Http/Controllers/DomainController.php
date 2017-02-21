<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SplFileInfo;

class DomainController extends Controller
{

    public function index()
    {
        $dir = config('app.vhost_path');
        $files = [];
        file_map($dir, function ($filename, $fileInfo) use (&$files) {

            list($name, $listen, $path) = $this->getConfig($filename);
            $files[] = [
                'filename' => basename($filename),
                'name'     => $name,
                'listen'   => $listen,
                'path'     => $path,
            ];

        });
        return $files;
    }

    public function getConfig($filename)
    {
        $content = file_get_contents($filename);

        preg_match('#server_name(.*);#', $content, $match);
        preg_match('#listen(.*);#', $content, $match2);
        preg_match('#root (.*);#', $content, $match3);

        return [
            trim($match[1]),
            trim(array_get($match2, 1)),
            trim(array_get($match3, 1)),
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'path' => 'required',
        ]);
        $template = config('site.template');
        $listen = $request->get('listen', 80);
        $name = $request->get('name');
        $path = $request->get('path');

        $path = rtrim($path, '\\/');

        $path = str_replace("\\", '/', $path);
        $dir = config('app.vhost_path');
        $nginx = config('app.nginx_path');

        $filename = $dir . DIRECTORY_SEPARATOR . $name . '.conf';

        if (file_exists($filename)) {
            return response()->json(['name' => ['Domain already exists.']], 422);
        }

        if (!file_exists($path)) {
            return response()->json(['path' => ['Invalid path.']], 422);
        }

        $con = sprintf($template, $listen, $name, $name, $name, $path, $path, $path);


        file_put_contents($filename, $con);

        $hosts = config('app.etc_path') . DIRECTORY_SEPARATOR . 'hosts';

        file_put_contents($hosts, "\n127.0.0.1 $name", FILE_APPEND);

        `cd $nginx & nginx -s reload`;

        return [
            'name'   => $name,
            'listen' => $listen,
            'path'   => $path
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
