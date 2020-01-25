<style>
    video::-webkit-media-controls {
        /* display: none; */
        visibility: hidden;
    }

    /* Could Use thise as well for Individual Controls */
    video::-webkit-media-controls-play-button {}

    video::-webkit-media-controls-volume-slider {}

    video::-webkit-media-controls-mute-button {}

    video::-webkit-media-controls-timeline {}

    video::-webkit-media-controls-current-time-display {}
</style>

<header style="background-color: #000" >
    <video id="video_banner" controls src="video/video.mp4" autoplay="true" loop  ></video>
</header>