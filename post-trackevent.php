<?php
/*
Plugin Name: Add Post TrackEvent
Plugin URI: http://xfeng.me/add-post-trackevent-wordpress-plugin/
Description: This plugin automatically add the onclick="_gaq.push(['_trackEvent', 'category', 'action', 'URL']);" to link in a post.为你的博客文章内链接加上Google Analytics事件跟踪，你可以自己修改category和action名字. 你可以选择注释插件中的正则,切换事件跟踪标签为完整的外链地址或仅为外链域名.
Author: JoysBoy 
Author URI: http://xfeng.me
Version: 0.2
Put in /wp-content/plugins/ of your Wordpress installation
*/
add_filter('the_content', 'add_post_trackevent_replace');
function add_post_trackevent_replace ($content)
{   global $post;
	//事件跟踪标签为完整Url
	$pattern = "/<a(.*?)href=(\'|\")(http:\/\/|https:\/\/)((?!xfeng)[^(\'|\")]*(?<!(\.bmp|\.gif|\.jpg|\.png))(?<!\.jpeg))(\'|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3$4$6 onclick="_gaq.push([\'_trackEvent\', \'OutgoLink\', \'Goto inPost Link\', \'$4\']);" $7>$8</a>';
	//事件跟踪标签仅为域名，如果不想标签为完整地址请注释上面两行代码，取消下面两行代码的注释
	//$pattern = "/<a(.*?)href=(\'|\")(http:\/\/|https:\/\/)((?!xfeng)[^\/]*)\/([^(\'|\")]*(?<!(\.bmp|\.gif|\.jpg|\.png))(?<!\.jpeg))(\'|\")(.*?)>(.*?)<\/a>/i";
	//$replacement = '<a$1href=$2$3$4/$5$7 onclick="_gaq.push([\'_trackEvent\', \'OutgoLink\', \'Goto inPost Link\', \'$4\']);" $8>$9</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
?>
