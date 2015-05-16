<?php
/**
 * @project: wp-bootstrap-share-buttons
 * @author: Gummibeer
 * @author-email: dev.gummibeer@gmail.com
 * @author-url: https://github.com/Gummibeer
 * @copyright: 2015 by Tom Witkowski
 * @licence: GNU GPL v2
 */
?>

<?php
/**
 * List of Colors for CSS: http://brandcolors.net/
 * List of Links: https://github.com/bradvin/social-share-urls
 *
 * buffer		http://bufferapp.com/add?text={title}&url={url}
 * delicious	https://delicious.com/save?v=5&provider={provider}&noui&jump=close&url={url}&title={title}
 * digg			http://digg.com/submit?url={url}&title={title}
 * facebook		http://www.facebook.com/sharer.php?u={url}
 * google		https://plus.google.com/share?url={url}
 * linkedin		http://www.linkedin.com/shareArticle?url={url}&title={title}
 * pinterest	https://pinterest.com/pin/create/bookmarklet/?media={img}&url={url}&is_video={is_video}&description={title}
 * reddit		http://reddit.com/submit?url={url}&title={title}
 * stumbleupon	http://www.stumbleupon.com/submit?url={url}&title={title}
 * tumblr		http://www.tumblr.com/share/link?url={url}&name={title}&description={desc}
 * twitter		https://twitter.com/share?url={url}&text={title}&via={via}&hashtags={hashtags}
 * xing			https://www.xing.com/spi/shares/new?url={url}
 *
 * default Parameters:
 * {url}    	The url you want to share (encoded)
 * {title}		The page title of the url you want to share
 * {desc}		A longer description of the content you are sharing
 *
 * custom Parameters:
 * {img}		The image/thumbnail to use when sharing
 * {via}    	optional Twitter username of content author (don't include "@")
 * {hashtags}	optional Hashtags appended onto the tweet (comma separated. don't include "#")
 * {provider}	Company who is sharing the url
 * {is_video}	If the content is a video or not
 */

// enter your social-media services
$services = [
	'facebook'		=> 'https://facebook.com/sharer.php?u={url}',
	'twitter'		=> 'https://twitter.com/intent/tweet?text={title}&url={url}',
	'google'		=> 'https://plus.google.com/share?url={url}',
	'pinterest'		=> 'http://pinterest.com/pin/create/button/?description={title}&url={url}',
	'linkedin'		=> 'https://linkedin.com/shareArticle?mini=true&title={title}&url={url}',
	'xing'			=> 'https://xing.com/spi/shares/new?url={url}',
];

$parameters = [
	// enter your custom parameters
	// or overwrite the default parameters
];

/*
 |--------------------------------------------------------------------------
 | That's all, stop editing! Happy blogging.
 |--------------------------------------------------------------------------
 */
?>
<ul id="share" class="list-unstyled row">
    <?php
	if(!isset($parameters['url'])) {
		$parameters['url']	= urlencode( get_permalink() );
	}
	if(!isset($parameters['title'])) {
		$parameters['title']	= urlencode( get_the_title() );
	}
	if(!isset($parameters['desc'])) {
		$parameters['desc']	= urlencode( get_the_excerpt() );
	}
	$i = 0;
	$return = '';
    foreach($services as $sm => $url) {
		$link = '<a href="'.preg_replace("|{(\w*)}|e", '$parameters["$1"]', $url).'" class="btn btn-default btn-block btn-'.$sm.'" target="_blank">auf '.$sm.' teilen</a>';
		if($i < 3) {
			if($i == 0 || count($services) == 3) {
				$return .= '<li class="col-md-4">';
			} else {
				$return .= '<li class="col-md-3">';
			}
		} elseif($i == 3) {
			$return .= '<li class="col-md-2">';
			$return .= '<div class="dropdown"><span class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown" aria-expanded="false">mehr <span class="caret"></span></span><ul class="dropdown-menu" role="menu">';
			$return .= '<li>';
		} elseif($i < count($services)) {
			$return .= '<li>';
		}
		$return .= $link;
		$return .= '</li>';
		if($i == count($services)-1) {
			$return .= '</ul></div>';
		}
		$i++;
    }
	echo $return;
    ?>
</ul>
