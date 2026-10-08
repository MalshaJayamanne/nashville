<?php

use SendGrid\Mail\Mail;

/**
 * SendGrid Driver for Wp Mail.
 *
 * @return void|bool
 */
function sendgrid_wp_mail_driver($atts, $content = null)
{
	if (!function_exists('get_field')) return;

	if (isset($atts['to'], $atts['subject'], $atts['message'])) {
		$apiKey = get_field('email_api_key', 'option');
        $fromEmail = get_field('email_from_email', 'option');
		$fromName = get_field('email_from_name', 'option');

        if (!($apiKey && $fromEmail && $fromName)) return;

        $sendGrid = new \SendGrid($apiKey);
		$mail = new Mail();
		$mail->setFrom($fromEmail, $fromName);
		$mail->setSubject($atts['subject']);
		$mail->addContent('text/html', $atts['message']);

        // If emails in comma separated string it will be converted to array
        if (is_string($atts['to']) && strpos($atts['to'], ',')) {
            $atts['to'] = explode(',', $atts['to']);
        }

		if (is_array($atts['to']) && !empty($atts['to'])) {
			foreach ($atts['to'] as $notificationEmail) {
				$mail->addTo($notificationEmail);
			}
		} else {
			$mail->addTo($atts['to']);
		}

		try {
			$sendGrid->send($mail);

			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

	return false;
}

remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('wp_mail', 'sendgrid_wp_mail_driver', 10, 1);
