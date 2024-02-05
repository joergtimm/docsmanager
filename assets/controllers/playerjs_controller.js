import { Controller } from '@hotwired/stimulus';
import videojs from 'video.js';



export default class extends Controller {
    static targets = ["myplayer"]

    static values = {
        index    : Number,
        prototype: String,
    }

    connect()
    {

        this.player = videojs(this.myplayerTarget, {
            control: true,
            autoplay: true,
            preload: 'auto',
            fluid: true,
            html5: {
                hls: {
                    overrideNative: true
                }
            },
            controlBar: {
                children: [
                    'playToggle',
                    'volumePanel',
                    'currentTimeDisplay',
                    'timeDivider',
                    'durationDisplay',
                    'progressControl',
                    'remainingTimeDisplay',
                    'playbackRateMenuButton',
                    'QualitySelector',
                    'fullscreenToggle'
                ]
            }
        });

        const sources = [

            {
                src: '/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_1080.m3u8',
                type: 'application/x-mpegURL',
                label: '1080',
                res: 1080
        },
            {
                src: '/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_720.m3u8',
                type: 'application/x-mpegURL',
                label: '720',
                res: 720
        },
            {
                src: '/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_480.m3u8',
                type: 'application/x-mpegURL',
                label: '480',
                res: 480
        }
        ];

        this.player.src(sources);

        this.player.ready(() => {
            this.player.play();
        });
    }

    disconnect()
    {
        // Stellen Sie sicher, dass der Player entfernt wird, wenn der Controller getrennt wird
        if (this.player) {
            this.player.dispose();
        }
    }

}