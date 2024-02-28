<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@symfony/ux-live-component' => [
        'path' => './vendor/symfony/ux-live-component/assets/dist/live_controller.js',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    'flowbite/plugin' => [
        'version' => '2.3.0',
    ],
    'mini-svg-data-uri' => [
        'version' => '1.4.4',
    ],
    'tailwindcss/plugin' => [
        'version' => '3.4.1',
    ],
    'tailwindcss/defaultTheme' => [
        'version' => '3.4.1',
    ],
    'tailwindcss/colors' => [
        'version' => '3.4.1',
    ],
    'picocolors' => [
        'version' => '1.0.0',
    ],
    'flowbite' => [
        'version' => '2.3.0',
    ],
    'flowbite/dist/flowbite.min.css' => [
        'version' => '2.3.0',
        'type' => 'css',
    ],
    'hls.js' => [
        'version' => '1.5.5',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    'filepond' => [
        'version' => '4.30.6',
    ],
    'filepond/dist/filepond.min.css' => [
        'version' => '4.30.6',
        'type' => 'css',
    ],
    'tom-select' => [
        'version' => '2.3.1',
    ],
    'prettier-plugin-tailwindcss' => [
        'version' => '0.5.11',
    ],
    'tailwind-scrollbar' => [
        'version' => '3.1.0',
    ],
    'tailwindcss/lib/util/flattenColorPalette' => [
        'version' => '3.4.1',
    ],
    'tailwindcss/lib/util/toColorValue' => [
        'version' => '3.4.1',
    ],
    'tailwindcss/lib/featureFlags' => [
        'version' => '3.4.1',
    ],
    'mediaplayer' => [
        'version' => '2.0.1',
    ],
    'mediaplayer/index.min.css' => [
        'version' => '2.0.1',
        'type' => 'css',
    ],
    'debounce' => [
        'version' => '2.0.0',
    ],
    'turbo-view-transitions' => [
        'version' => '0.3.0',
    ],
    'stimulus-use' => [
        'version' => '0.52.2',
    ],
    'stimulus-popover' => [
        'version' => '6.2.0',
    ],
    'tom-select/dist/css/tom-select.default.css' => [
        'version' => '2.3.1',
        'type' => 'css',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    '@tailwindcss/container-queries' => [
        'version' => '0.1.1',
    ],
    '@tailwindcss/forms' => [
        'version' => '0.5.7',
    ],
    '@tailwindcss/aspect-ratio' => [
        'version' => '0.4.2',
    ],
    'pdf.js' => [
        'version' => '0.1.0',
    ],
    'jsdelivr' => [
        'version' => '0.1.2',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'stimulus-checkbox-select-all' => [
        'version' => '5.3.0',
    ],
    'chart.js/auto' => [
        'version' => '4.4.1',
    ],
    'dropzone' => [
        'version' => '6.0.0-beta.2',
    ],
    'just-extend' => [
        'version' => '6.2.0',
    ],
    'video.js' => [
        'version' => '8.10.0',
    ],
    'global/window' => [
        'version' => '4.4.0',
    ],
    'global/document' => [
        'version' => '4.4.0',
    ],
    'keycode' => [
        'version' => '2.2.1',
    ],
    'safe-json-parse/tuple' => [
        'version' => '4.0.0',
    ],
    '@videojs/xhr' => [
        'version' => '2.6.0',
    ],
    'videojs-vtt.js' => [
        'version' => '0.15.5',
    ],
    '@babel/runtime/helpers/extends' => [
        'version' => '7.23.9',
    ],
    '@videojs/vhs-utils/es/resolve-url.js' => [
        'version' => '4.0.0',
    ],
    'm3u8-parser' => [
        'version' => '7.1.0',
    ],
    '@videojs/vhs-utils/es/codecs.js' => [
        'version' => '4.0.0',
    ],
    '@videojs/vhs-utils/es/media-types.js' => [
        'version' => '4.0.0',
    ],
    '@videojs/vhs-utils/es/byte-helpers' => [
        'version' => '4.0.0',
    ],
    'mpd-parser' => [
        'version' => '1.3.0',
    ],
    'mux.js/lib/tools/parse-sidx' => [
        'version' => '6.3.0',
    ],
    '@videojs/vhs-utils/es/id3-helpers' => [
        'version' => '4.0.0',
    ],
    '@videojs/vhs-utils/es/containers' => [
        'version' => '4.0.0',
    ],
    'mux.js/lib/utils/clock' => [
        'version' => '6.3.0',
    ],
    'video.js/dist/video-js.min.css' => [
        'version' => '8.10.0',
        'type' => 'css',
    ],
    'is-function' => [
        'version' => '1.0.2',
    ],
    'url-toolkit' => [
        'version' => '2.2.5',
    ],
    '@videojs/vhs-utils/es/stream.js' => [
        'version' => '4.0.0',
    ],
    '@videojs/vhs-utils/es/decode-b64-to-uint8-array.js' => [
        'version' => '4.0.0',
    ],
    '@videojs/vhs-utils/es/resolve-url' => [
        'version' => '4.0.0',
    ],
    '@videojs/vhs-utils/es/media-groups' => [
        'version' => '4.0.0',
    ],
    '@videojs/vhs-utils/es/decode-b64-to-uint8-array' => [
        'version' => '4.0.0',
    ],
    '@xmldom/xmldom' => [
        'version' => '0.8.10',
    ],
    'plyr' => [
        'version' => '3.7.8',
    ],
    'plyr/dist/plyr.min.css' => [
        'version' => '3.7.8',
        'type' => 'css',
    ],
    '@pdftron/pdfjs-express-viewer' => [
        'version' => '8.7.4',
    ],
    'alpinejs' => [
        'version' => '3.13.5',
    ],
    '@alpinejs/collapse' => [
        'version' => '3.13.5',
    ],
    'postcss' => [
        'version' => '8.4.35',
    ],
    'nanoid/non-secure' => [
        'version' => '5.0.5',
    ],
    'postcss-loader' => [
        'version' => '8.1.0',
    ],
    '@kurkle/color' => [
        'version' => '0.3.2',
    ],
    'flowbite-datepicker' => [
        'version' => '1.2.6',
    ],
    'highlight.js/lib/core' => [
        'version' => '11.9.0',
    ],
    'highlight.js/lib/languages/javascript' => [
        'version' => '11.9.0',
    ],
];
