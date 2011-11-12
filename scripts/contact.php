<?php

/* ====== "Contact me" form for use with the "Custom Code" plugin ====== */

// Usage: <!--#include contact to="you@yourdomain.com" -->

if (!$incfile) die('');

function check_single_line($name) {
	if (strstr($_POST[$name], "\n") !== false) return false;
	if (strstr($_POST[$name], "\r") !== false) return false;
	return $_POST[$name];
}

function check_required_field($name, $singleLine) {
	if (isset($_POST[$name]) && ('' != $_POST[$name]))
	{
		/*
		 * Closes a security hole. Disallow inappropriate multi-line responses
		 * Spammers try to use these to compromise insecure contact forms.
		 * http://www.jamesmckay.net/2005/12/secure-your-contact-form/
		 */

		if ($singleLine && !check_single_line($name))
		{
			return false;
		}
		return get_magic_quotes_gpc() ? stripslashes($_POST[$name]) : $_POST[$name];
	}
	else
	{
		return false;
	}
}

function check_subject()
{
	return (strstr($_POST['jmcfSubject'], "\n"));
}

function output_field($name)
{
	if (isset($_POST[$name])) {
		$data = get_magic_quotes_gpc() ? stripslashes($_POST[$name]) : $_POST[$name];
		print htmlentities($data);
	}
}

$showValidators = false;
$sent = false;

if ('POST' == $_ENV['REQUEST_METHOD']) {
	$jmcfName = check_required_field('jmcfName', true);
	$jmcfEmail = check_required_field('jmcfEmail', true);
	if (!is_email($jmcfEmail)) $jmcfEmail = false;
	$jmcfSubject = check_single_line('jmcfSubject', true);
	$jmcfMessage = check_required_field('jmcfMessage', false);
	$jmcfWebsite = check_single_line('jmcfWebsite');

	if (false !== $jmcfName && false !== $jmcfEmail && false !== $jmcfSubject
		&& false !== $jmcfMessage && false !== $jmcfWebsite)
	{

		if (false !== $jmcfName) {
		/*
			$jmcfName = str_replace('<', '', $jmcfName);
			$jmcfName = str_replace('>', '', $jmcfName);
			$jmcfName = str_replace('[', '', $jmcfName);
			$jmcfName = str_replace(']', '', $jmcfName);
		*/
			$jmcfName = str_replace('"', '', $jmcfName);
		}

		$from = '"' . $jmcfName . '" <' . $jmcfEmail . '>';
		$to = $args['to'];

		$jmcfMessage .= "\r\n\r\n=========================\r\n\r\n";
		$jmcfMessage .= "Website: $jmcfWebsite\r\n\r\n";
		$jmcfMessage .= 'Sent at ' . gmdate('H:i:s d/m/y') . ' from ' . $_ENV['REMOTE_ADDR'];
		$jmcfMessage .= "\r\nBrowser: " . $_ENV['HTTP_USER_AGENT'];



		if (@mail($to, $jmcfSubject, $jmcfMessage, 'From: ' . $from)) {
			$sent = true;
		}
		else {
			$sent = 'error';
		}
	}
	else
	{
		$showValidators = true;
	}
}

?>

<?php if(!$sent): ?>

		<form method="POST">
			<table border="0" cellpadding="6" cellspacing="0" align="center">
				<tr>
					<td align="right"><strong><label for="jmcfName">Your name:</label></strong></td>
					<td><input type="text" name="jmcfName" style="width:300px" value="<?php output_field('jmcfName'); ?>" />
					(Required)</td>
				</tr>
<?php if ($showValidators && (false === $jmcfName)): ?>
				<tr>
					<td colspan="2" align="right"><strong>Name is required.</strong></td>
				</tr>
<?php endif; ?>
				<tr>
					<td align="right"><strong><label for="jmcfEmail">E-mail:</label></strong></td>
					<td><input type="text" name="jmcfEmail" style="width:300px" value="<?php output_field('jmcfEmail'); ?>" />
					(Required)</td>
				</tr>
<?php if ($showValidators && (false === $jmcfEmail)): ?>
				<tr>
					<td colspan="2" align="right"><strong>A valid e-mail address is required.</strong></td>
				</tr>
<?php endif; ?>
				<tr>
					<td align="right">Your website:</td>
					<td><input type="text" name="jmcfWebsite" style="width:300px" value="<?php output_field('jmcfWebsite'); ?>" /></td>
				</tr>
<?php if ($showValidators && (false === $jmcfWebsite)): ?>
				<tr>
					<td colspan="2" align="right"><strong>Invalid website address!</strong></td>
				</tr>
<?php endif; ?>
				<tr>
					<td align="right"><strong><label for="jmcfSubject">Subject:</label></strong></td>
					<td><input type="text" name="jmcfSubject" style="width:300px" value="<?php output_field('jmcfSubject'); ?>" /></td>
				</tr>
<?php if ($showValidators && (FALSE === $jmcfSubject)): ?>
				<tr>
					<td colspan="3" align="right"><strong>Message subject is required.</strong></td>
				</tr>
<?php endif; ?>
				<tr>
					<td colspan="3"><strong><label for="jmcfMessage">What do you want to say?</label></strong></td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="jmcfMessage" rows="15" style="width:480px"><?php if (isset($_POST['jmcfMessage'])) echo $_POST['jmcfMessage']; ?></textarea>
					</td>
				</tr>
<?php if ($showValidators && (false === $jmcfMessage)): ?>
				<tr>
					<td colspan="3" align="right"><strong>Message body is required.</strong></td>
				</tr>
<?php endif; ?>
				<tr>
					<td colspan="3" align="right">
						<input type="submit" value="Send" />
						<input type="reset"  value="Clear" />
					</td>
				</tr>
			</table>
		</form>

<?php elseif ('error' === $sent): ?>

		<h3>Your message could not be sent.</h3>

		<p>Sorry, your message could not be sent at this present time. Please try again later.</p>

<?php else: ?>

		<h3>Your message has been sent.</h3>

		<p>Thank you for getting in touch!</p>

<?php endif; ?>