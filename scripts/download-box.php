<?php

/* ====== Download box ====== */

// Usage: <!--#include download-box title="Title" version="Version" url="Url" -->
// Define a class download-box in your css file.

if (!isset($args)) {
	die('Please do not load this file directly.');
}

?>
<div class="download-box">
<strong><?php echo $args['title']; ?></strong><br />
version <?php echo $args['version']; ?><br />
<a href="<?php echo $args['url']; ?>" title="<?php echo $args['title']; ?>">Download now</a>
<a href="<?php echo $args['url']; ?>" title="<?php echo $args['title']; ?>"><img src="/wp-content/plugins/include/scripts/download.png" alt="Download now" align="absmiddle" /></a>
</div>