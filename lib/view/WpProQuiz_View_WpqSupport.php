<?php

class WpProQuiz_View_WpqSupport extends WpProQuiz_View_View
{

    public function show()
    {
        ?>

        <div class="wrap">
            <h2><?php _e('Support Bestwebsite-Pro-Quiz', 'Bestwebsite-Pro-Quiz'); ?></h2>

        
            <p>
                <?php _e('Bestwebsite-Pro-Quiz is small but nice free quiz plugin for WordPress.', 'Bestwebsite-Pro-Quiz'); ?> <br>
                <?php _e('I try to implement all wishes as fast as possible and help with problems.', 'Bestwebsite-Pro-Quiz'); ?>
                <br>
                <?php _e('Your donations can help to ensure that the project continues to remain free.',
                    'Bestwebsite-Pro-Quiz'); ?>
            </p>

            <h3>Bestwebsite-Pro-Quiz on Github</h3>

            <a class="button" target="_blank" href="https://github.com/bestwebsite/Bestwebsite-Pro-Quiz"><?php _e('Bestwebsite-Pro-Quiz on Github', 'Bestwebsite-Pro-Quiz'); ?></a>


            <h3><?php _e('Bestwebsite-Pro-Quiz special modification', 'Bestwebsite-Pro-Quiz'); ?></h3>
            <h3><?php _e('Bestwebsite-Pro-Quiz special modification', 'Bestwebsite-Pro-Quiz'); ?></h3>
            <strong><?php _e('You need special Bestwebsite-Pro-Quiz modification for your website?',
                    'Bestwebsite-Pro-Quiz'); ?></strong><br>
            <a class="button-primary" href="admin.php?page=wpProQuiz&module=info_adaptation"
               style="margin-top: 5px;"><?php _e('Learn more', 'Bestwebsite-Pro-Quiz'); ?></a>

            <h3>Bestwebsite-Pro-Quiz Wiki</h3>

            <a class="button-primary" target="_blank" href="https://github.com/bestwebsite/Bestwebsite-Pro-Quiz/wiki">--> Wiki <--</a>

            <h3 style="margin-top: 40px;"><?php _e('Translate Bestwebsite-Pro-Quiz', 'Bestwebsite-Pro-Quiz'); ?></h3>

            <p>
                <?php _e('To translate Bestwebsite-Pro-Quiz, please follow these steps:', 'Bestwebsite-Pro-Quiz'); ?>
            </p>

            <ul style="list-style: decimal; padding: 0 22px;">
                <li><?php _e('Login to your account on wordpress.org (or create an account if you don’t have one yet).', 'Bestwebsite-Pro-Quiz'); ?></li>
                <li><?php _e('Go to https://translate.wordpress.org.', 'Bestwebsite-Pro-Quiz'); ?></li>
                <li><?php _e('Select your language and click ‘Contribute Translation’.', 'Bestwebsite-Pro-Quiz'); ?></li>
                <li><?php _e('Go to the Plugins tab and search for ‘Bestwebsite-Pro-Quiz’.', 'Bestwebsite-Pro-Quiz'); ?></li>
                <li><?php _e('Select the plugin and start translating!', 'Bestwebsite-Pro-Quiz'); ?></li>
            </ul>

        </div>

        <?php
    }
}
