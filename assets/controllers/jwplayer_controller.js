import { Controller } from '@hotwired/stimulus';
import './../js/jwplayer-8.1.2/jwplayer'


export default class extends Controller {
    static values = {
        url: String,
        hash: String,
        poster: String,
        titel: String
    }

    initialize() {
        jwplayer.key = "v7n+Do8rQ1K2Sv8HNHmeObuckHMD4+UQ4TTav4BP5TI=";
        var playerInstance = jwplayer("player");

        playerInstance.setup({
            title: this.titelValue,
            image: this.posterValue,
            playlist: [{file: `/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_1080.m3u8`}],
            autostart: true,
            width: "100%",
            responsive: true,
            aspectratio: "16:9",
            preload: "auto"
        });
    }

    connect() {

    }

    disconnect() {
        jwplayer().remove();
    }
}