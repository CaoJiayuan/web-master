<?php
/**
 * Created by Cao Jiayuan.
 * User: Cao Jiayuan
 * Date: 2016/12/7
 * Time: 21:11
 */

$template = <<<TEM
server {
	listen       %s;
	server_name  %s;
	
	access_log  logs/%s.log;
	error_log logs/%s.error.log;
	location / {
		index index.html index.htm index.php;
		root %s;
		include rewrite_rest.conf;
	}
	
	location ~ \.php$ {
		root %s;
		fastcgi_pass   127.0.0.1:9000;
		fastcgi_index  index.php;
		fastcgi_param  SCRIPT_FILENAME  %s/\$fastcgi_script_name;
		include        fastcgi_params;
    }
}
TEM;

return [
  'template' => $template
];