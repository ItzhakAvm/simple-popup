<!doctype html>
<html>
    <head>
        <title>Simple Popup</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='https://fonts.googleapis.com/css?family=Baloo Paaji 2' rel='stylesheet'>
        <link href="/css/main.css" rel="stylesheet" />

        <script src="/js/app.js" type="module"></script>
    </head>
    <body>
        <section id="header">
            <div id="header-container" class="bg-lightgray width-full p-1 display-flex align-center">
                <div id="header-logo" class="flex-grow-1">
                    <a href="/" class="link">
                        <h1>Simple Popup</h1>
                    </a>
                </div>
                <div id="header-button" class="display-flex justify-center align-center">
                    <button id="popup-button" class="button button-large button-info">Toggle Popup</button>
                </div>
            </div>
        </section>
        <section id="footer">
            <div id="footer-container" class="width-full p-1 absolute-bottom">
                <span>Created by <a href="mailto:ItzhakAvm@gmail.com" class="link link-underline">Itzhak Avraham</a>, #1 developer</span>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADQAAAAZCAYAAAB+Sg0DAAAEwUlEQVRYCe2XXWjbVRTAb9Ngyh6mAzG1sI3OB5c9GVBkxaf4ZCqWpg9iHnTrPw5Mi65GpzSbIA1luE7G2jKdkaGsQ8V0qIsg2JcqHXR1kzmIH3QdMjo3V6fOj7HNHvmdPzf9N7o0zfyEBi73/u/HOed3z7nn3hiz9FvagaUdqGYHHMeRsbEx0bV8JJNJ96Maaf/ymqGhoTkYawt0AwMD/wuoTCYj+XxeAKFd9IyFsTUDTGAiC/r6+v6TgBYgleqQkZGR8jYy2XEe0kl2oQWutD57/oIcnfhYXtuzTZ7ddI9siN6ihTZ9jDGnUnml8wCJRqMLw9iFeOe+6P2ytSe1aKWTJyfl1d3PyBNtATn4gl8Kwz75ZdzIz4eNnDjgk7ef9+sYc5hrdVZac9YbG4OSyXQvbm02m5X6+nqJx2MVLzz+6bhsfvgO2bfNL5eO3SBXCsvl6hcrtNC+fDygcDMfGNm72a9zWVMpTCQSkXXr1kg4HJLs3lcqXqfy2QEWUlpjkQUXFwqfyWNtq+TIfp8L8tXNMjvVILNfr3IL7akGHbs0YeTHESOjfT5dw9qFoAgxPAMQIbfQ/D8d7+3pVgF4qqmp6ZpCzpybkV0ZR97ZWasGWxA53VgEKraB+vxG9dT37xt5Y4tfdvdukm++/e6a8jEOkKpCrZSM3UBQOaBPjnwkqQcDGmb33nmTlBaZXvOHPub8NGrk3JtGHn8gIMjw6k6n0xoZnBlCLZ/P/XVZlzSey+VUMAoIQa/bOeC7ugJFo19cvUz4UXvh+LZj3v7tj9TJvsG5Q45sdAK4fn1YwuGw6vcCX3ebS5fzRCwjzHsJP+3cLVOHauTKlysUoBTG6yHv2K8TRgi7YztrNL0jF88M9rsXPJuHPgqZ97ohvAK4kxCM+3kqMWZ3kXvm4pgpAnl3HxhbvP20LdDUHiOJlpUqMx6PS3fPkxKLxQTvEOq06a/2XvRyaBtBra0tKhgFVgmvCsKjCFRYLrOnGooAFqS0JvPhTe6nC+8a8QK5m7ZWdYRCISAFr9EGqn8gU334HXpvWAXwcgiFbpet3WkNEYSze5HIWt3VVPtdcnK4Ru8Zm+Eweg7kNpFpiustoC+fWKZJ4fxbRo721siWR90sSgSQVamBsbtLNNgIqfpJ9lQ6pYIRhEDiHW+gBIW3BuvVaySFg5la3XFSMgbPB5oLO+sdQu6HD42cfd3IULJWkwIyOaecnQ3NQVdfc3AeVCIRL35b2EXXwABCnFPb1wOK3cs3LF1tAb0suTQVynOpyunVxcvVJg4uVlL29Mtu2iaM8byTbJdEh6NA7U4rxtuyaLvLLgAED1FQpICdGyXRuVENwYu552oVirPBM8c+e36bDM5L38DMDBs5k3W9Yz1DeqZt9WhEeDxU1sBqBgkDQBSmZaUqdo0JKxTt0R0+7b84ajQE8RiAFPoIM84NMBjMc4mnD2cUILykOtD1d8KUbgBK7U5aQ+rq6vTB+VKHX8MJL9g5ZDNAODOn+o0Mtvt1zG4QIBamVFcl39xvlcwrO0c91hxUQ6wx9u8Dz5kDXX6Z2OFTb3BWxjM+2d/hl87mgP7FsAffhhZwZRX+U4MWzOrz/sEjHdsLlXbpH7zStVZGtfXv3p6IiHxvkkAAAAAASUVORK5CYII=" />
            </div>
        </section>
        <div id="simple-popup" class="popup">
            <div class="overlay width-full height-full fixed-top fixed-left">
                <div class="content width-full height-full display-flex justify-center align-center">
                    <div class="content-container width-half height-half p-1 bg-white"></div>
                </div>
            </div>
        </div>
    </body>
</html>