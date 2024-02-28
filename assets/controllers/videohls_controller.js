import { Controller } from '@hotwired/stimulus';
import Hls from "hls.js";
import Plyr from 'plyr';


export default class extends Controller {
    static targets = ["video", "quality"];

    static values = {
        quality: Array,
        hash: String,
    }
    connect()
    {
        // Initialisiere Plyr
        this.player = new Plyr(this.videoTarget, {
            autoplay: true,
            settings: ['captions', 'quality', 'speed', 'loop'],
            controls: [
                'play-large', // Großer Play-Button in der Mitte
                'play', // Play/Pause-Knopf in der linken unteren Ecke
                'progress', // Fortschrittsbalken
                'current-time', // Aktuelle Zeit
                'duration', // Gesamtdauer
                'mute', // Stummschaltung
                'settings',
                'volume', // Lautstärkeregler
                'fullscreen', // Vollbildschaltfläche
                 // Benutzerdefinierte Qualitätskontrolle], // Füge eine Qualitätskontrolle hinzu
            ]});

        this.qualityValue = [
            { label: "1080p", url: "/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_1080.m3u8" },
            { label: "720p", url: "/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_720.m3u8" },
            { label: "480p", url: "/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_480.m3u8" },
            { label: "360p", url: "/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_360.m3u8" },
            { label: "240p", url: "/videos/7ac8b5b9-cb5a-4d6c-98dc-79150d7f9861/videos/h264/film_240.m3u8" },
        ];


        // Lade die erste Qualität als Standard
        this.loadQuality(this.qualityValue[0].url);
        this.addQualityButton();

        this.player.on('ready', (event) => {
            this.player.play();
        });
    }

    fillQualityOptions()
    {
        this.qualityValue.forEach((quality, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.innerText = quality.label;
            this.qualityTarget.appendChild(option);
        });
    }

    loadQuality(url)
    {
        if (Hls.isSupported()) {
            const hls = new Hls();
            hls.loadSource(url);
            hls.attachMedia(this.videoTarget);
            hls.on(Hls.Events.MANIFEST_PARSED, () => {
                this.player.play();
            });
        } else {
            console.error("HLS wird nicht unterstützt");
        }
    }

    // Diese Funktion wird aufgerufen, wenn der Benutzer eine Qualität auswählt
    changeQuality(event)
    {
        const qualityIndex = event.target.value;
        const quality = this.qualityValue[qualityIndex];
        this.loadQuality(quality.url);
    }

    addQualityButton()
    {
        // Erstelle den Qualitätsauswahlknopf
        const qualityButton = document.createElement("div");
        qualityButton.className = "plyr__menu__container";
        qualityButton.innerHTML = `
        < button type = "button" class = "plyr__control" aria - haspopup = "true" aria - controls = "plyr-quality" >
        Quality
        <  / button >
        < div class = "plyr__menu" id = "plyr-quality" >
        < div class = "plyr__menu__content" >
          ${this.qualityValue.map((quality, index) => `
            < label class = "plyr__control plyr__control--radio" >
              < input type = "radio" name = "quality" value = "${index}" ${index === 2 ? 'checked' : ''} >
              < span > ${quality.label} < / span >
            <  / label > `).join('')}
        <  / div >
        <  / div >
        `;
        qualityButton.addEventListener("change", (event) => {
            const qualityIndex = event.target.value;
            const quality = this.qualityValue[qualityIndex];
            this.loadQuality(quality.url);
        });

        // Füge den Qualitätsknopf zur Plyr-Kontrollleiste hinzu
        const controls = this.player.elements.controls;
        controls.insertBefore(qualityButton, controls.firstChild);
    }
}
