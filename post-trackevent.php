<?php
/*
Plugin Name: Add Post TrackEvent
Plugin URI: http://xfeng.me/add-post-trackevent-wordpress-plugin/
Description: This plugin automatically add the onclick="_gaq.push(['_trackEvent', 'category', 'action', 'URL']);" to link in a post. \n You can modify category and action that you like. You can choose opt_label as domain or url.
Author: JoysBoy 
Author URI: http://xfeng.me
Version: 0.1
Put in /wp-content/plugins/ of your Wordpress installation
*/
add_filter('the_content', 'add_post_trackevent_replace');
function add_post_trackevent_replace ($content)
{   global $post;
	//事件跟踪标签为完整Url
	$pattern = "/<a(.*?)href=(\'|\")(http:\/\/|https:\/\/)((?!xfeng)[^(\'|\")]*(?<!(\.bmp|\.gif|\.jpg|\.png))(?<!\.jpeg))(\'|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3$4$6 onclick="_gaq.push([\'_trackEvent\', \'OutgoLink\', \'Goto inPost Link\' \'$4\']);" $7>$8</a>';
	//事件跟踪标签仅为域名，如果不想标签为完整地址请注释上面两行代码，取消下面两行代码的注释
	//$pattern = "/<a(.*?)href=(\'|\")(http:\/\/|https:\/\/)((?!xfeng)[^\/]*)\/([^(\'|\")]*(?<!(\.bmp|\.gif|\.jpg|\.png))(?<!\.jpeg))(\'|\")(.*?)>(.*?)<\/a>/i";
	//$replacement = '<a$1href=$2$3$4/$5$7 onclick="_gaq.push([\'_trackEvent\', \'OutgoLink\', \'Goto inPost Link\' \'$4\']);" $8>$9</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
?>
