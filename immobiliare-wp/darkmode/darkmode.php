<?php

/*
Plugin Name: Dark Mode
Plugin URI: https://wp.boxydev.com/plugins/darkmode
Description: An amazing plugin.
Author: Matthieu Mota
Author URI: https://matthieumota.fr
Version: 1.0.0
*/

function darkmode() {
    ?>

    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
    <script>
        function addDarkmodeWidget() {
            new Darkmode({
                label: '🌓',
            }).showWidget();
        }
        window.addEventListener('load', addDarkmodeWidget);
    </script>
    <style>
        .darkmode-layer, .darkmode-toggle {
            /* z-index: 500; */
        }

        .darkmode-toggle {
            z-index: 500;
        }

        .darkmode--activated .navbar {
            position: static;
        }
    </style>

<?php }

// On exécute le JS sur le bon hook, celui du footer
add_action('wp_footer', 'darkmode');
