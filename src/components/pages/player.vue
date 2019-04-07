<template>
    <div class="player-styles">
        <transition name="fade">
            <loader v-show="isResult"></loader>
        </transition>
        <div class="top__panel">
            <div class="block__right">
                <div class="user__name">
                    {{$store.state.authUser[4]}} {{$store.state.authUser[5]}}
                </div>
                <div class="user__photo">
                    <img :src="`${$store.state.authUser[6] ? $store.state.authUser[6] : 'default/user-icon-default.png'}`" alt="user-photo">
                </div>
                <div class="ml-4 open__player"
                     @click="isShowPlayer = !isShowPlayer">
                    <span>Открыть плеер</span>
                    <i class="fa fa-music" aria-hidden="true"></i>
                </div>
            </div>
            <div class="block__right">
                <div class="log__out cursor-pointer" @click="logOut">
                    <div class="log__out--icon mr-1"></div>
                    <span>Выйти</span>
                </div>
            </div>
        </div>
        <!--<div class="cover" :style="`backgroundImage: url(${$store.state.randomCover ? $store.state.randomCover.images : 'default/cover-default.jpg'});-->
        <!--transform: scale(${1 + backgroundArray[0]}, ${1 + backgroundArray[0]})`">-->
            <!--<div class="buffer" >-->
                <!--<img src="../../assets/logo.png" alt="Y0pta">-->
            <!--</div>-->
        <!--</div>-->
        <canvas class="cover">
            <div class="buffer" >
                <img src="../../assets/logo.png" alt="Y0pta">
            </div>
        </canvas>
        <b-link class="download-cover" v-b-modal.modal2>
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </b-link>
        <transition name="top">
            <div class="player" v-show="isShowPlayer">
                <div class="block__visualizer">
                    <div class="visualizer">
                    </div>
                </div>
                <div class="nameSong">{{ songCurrentName }}</div>
                <div class="control">
                    <div class="block-lef">
                        <div class="repeat"
                             :class="{'click': songRepeat}"
                             @click="songRepeat = !songRepeat"
                        >
                            <i class="fa fa-repeat" aria-hidden="true"></i>
                        </div>
                        <div class="time">{{songCurrentTime}}</div>
                    </div>
                    <div class="block-cen">
                        <div class="prev"
                             @click="prevTrack($event)">
                            <i class="fa fa-backward" aria-hidden="true"></i>
                        </div>
                        <div class="play-pause"
                             :class="{'d-none': iconActiveMainPlay}"
                             @click="playTrack">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </div>
                        <div class="pause"
                             @click="playTrack"
                             :class="{'d-none': !iconActiveMainPlay}">
                            <i class="fa fa-pause" aria-hidden="true"></i>
                        </div>
                        <div class="next"
                             @click="nextTrack($event)">
                            <i class="fa fa-forward" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="block-rig">
                        <div class="mute">
                            <i class="fa fa-volume-up" aria-hidden="true"
                               :class="{'d-none':volumeValue === '0'}"></i>
                            <i class="fa fa-volume-off d-none" aria-hidden="true"
                               :class="{'d-flex':volumeValue === '0'}"></i>
                        </div>
                        <input type="range" class="volume" min="0" max="100" v-model="volumeValue">
                    </div>
                </div>
                <div class="timetobar">

                    <div class="setTime"
                         :class="{'d-flex': songMouseHoverTime,
                     'd-none': !songMouseHoverTime}">
                        {{ songMouseHoverTimeOut }}
                    </div>
                    <div class="range"
                         @mouseenter="goToTimeMouseOverEnter"
                         @mousemove="goToTime($event)"
                         @click="setTime"
                         @mouseleave="goToTimeMouseLeave">
                        <div class="progress"></div>
                        <!--<div class="loadSongPr"></div>-->
                    </div>

                </div>

            </div>
        </transition>
        <div class="playList__panel"
             :class="{'toggled': togglePlayList}">
            <div class="button-open-play-list"
                 @click="[togglePlayList = !togglePlayList, runText()]">
                <div class="button-open-play-list__right" :class="{'d-none': togglePlayList}">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </div>
                <div class="button-open-play-list__left" :class="{'d-none': !togglePlayList}">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                </div>
            </div>
            <transition name="fade">
                <div class="list" v-show="togglePlayList">
                    <b-button variant="outline-primary" class="playList__panel-button-load" v-b-modal.modal1>
                        <span>Загрузить музыку</span>
                        <i class="fa fa-cloud-download" aria-hidden="true"></i>
                    </b-button>
                    <loader v-show="result === ''"></loader>
                    <template>
                        <div v-for="(item, index) in result" class="content" :id="index+1">
                            <div @click="playSong($event)" class="post" :id="index" :data-video-src="item.Song">
                                <div class="list-play">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                    <i class="fa fa-pause d-none" aria-hidden="true"></i>
                                </div>
                                <div class="song-name"><span class="song-name__span">{{item.Name}} </span></div>
                            </div>
                            <div class="controls-song">
                                <div :id_song="item.id"
                                     :data-video-src="item.Song"
                                     class="delete"
                                     @click="trackDelete($event)"
                                >
                                    <i class="fa fa-times" aria-hidden="true"></i></div>
                                <a :href="item.Song" download><div class="download"><i class="fa fa-download" aria-hidden="true"></i></div></a>
                            </div>
                        </div>
                    </template>

                </div>
            </transition>
        </div>

        <!--form-->
        <b-modal id="modal1" title="BootstrapVue">
            <form id="uploadForm" name="uploadForm" enctype="multipart/form-data">

                <input type="file" id="files" name="files" multiple="multiple"><br>
                <input type="email" id="email" name="email">


                <input type="button" value="Upload" @click="this.uploadFiles">

            </form>
        </b-modal>

        <b-modal id="modal2" title="BootstrapVue">
            <form id="uploadCover" name="uploadForm" enctype="multipart/form-data">
                <input type="file" id="filesImage" name="files" multiple="multiple"><br>
                <input type="button" value="Upload" @click="this.uploadFilesCover">
            </form>
        </b-modal>
    </div>
</template>
<script>
    import loader from '../module/loader'
    // import $ from 'jquery'
    import axios from 'axios'
    import playerMixin from '../../mixins'

    export default {
        data() {
            return {
                img: new Image(),
                togglePlayList: false,
                songCurrentName: 'Song Name',
                clickCurrentPlaySongEvent: '',
                isShowPlayer: false,
                backgroundArray: [],
                result: '',
                isResult: true,
                count: 1,
                iconActiveMainPlay: false,
                renderPage: false,

                song: new Audio(),
                audioCtx: new(window.AudioContext || window.webkitAudioContext)(),
                srcPlay: '',
                clickSrc: '',
                srcId: -1,
                songPlay: false,

                elementsPosts: '',
                lengthAllTracks: 0,

                songCurrentTime: '0:00',
                songMouseHoverTimeOut: '0:00',
                setSec: '',
                songMouseHoverTime: false,
                songRepeat: false,
                volumeValue: 100,

                ctx: '',

                analyser: '',
                arrayClassEv: '',
                visualizerMinValue: '',
                array: [],
                source: '',

                // mute: false,
                // volume: 100,
                // vol: '',

                handle: '',
                id_song: '',
                duration: '',
                nameSong: '',
                time: '',
                linking: '',
                globalsrc: '',
                max_songs: '',
            }
        },
        components: {
            loader,
        },
        mixins: [
            playerMixin,
        ],
        methods: {
            logOut() {
                this.$cookie.delete('login');
                this.$cookie.delete('password');
                this.$cookie.delete('user_id');
                this.$router.push('/login');

                this.$store.state.authUser[0] = '';
                this.$store.state.authUser[1] = '';
                this.$store.state.authUser[2] = '';
                this.$store.state.authUser[3] = '';

            },
            runText() {
                this.$nextTick(() => {
                    let name = document.querySelector('.song-name');
                    let span = document.querySelectorAll('.song-name__span');
                    span.forEach((item) =>{
                        let text = item.innerHTML;
                        if (item.offsetWidth > name.offsetWidth ) {
                            setInterval(() => {
                                text = text[text.length - 1] + text.substring(0, text.length - 1);
                                item.innerHTML = text;
                            }, 200)
                        }
                    });
                });
            },
            trackDelete(e) {
                this.result = '';
                const id_song = e.currentTarget.getAttribute('id_song');
                axios({
                    method: 'post',
                    url: '/api/delete.php',
                    data: {
                        id_song_delete: id_song,
                }
                }).then(response => {
                    this.$store.dispatch('selectPlaylist',this.$cookie.get('user_id'));
                })
            },

            async uploadFiles () {
                const s = this;
                const data = new FormData(document.getElementById('uploadForm'));
                const trackFiles = document.querySelector('#files');
                data.append('user_id', this.$cookie.get('user_id'));
                for (let i=0; i<trackFiles.files.length; i++) {
                    data.append('file', trackFiles.files[i]);

                    await axios.post('/api/upload_music.php', data, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then(response => {
                            this.$store.dispatch('selectPlaylist',this.$cookie.get('user_id'));
                        })
                        .catch(error => {
                            console.log(error.response)
                        });

                    this.removeActiveCurrentClass();
                    if (this.song.src) {
                        this.srcId++;
                        this.selectSrc(this.srcId);
                    }
                }
            },

            async uploadFilesCover () {
                const data = new FormData(document.getElementById('uploadCover'));
                const imageFiles = document.querySelector('#filesImage');
                data.append('user_id', this.$cookie.get('user_id'));
                for (let i=0; i<imageFiles.files.length; i++) {
                    data.append('file', imageFiles.files[i]);

                    await axios.post('/api/upload_pic.php', data, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then(response => {
                            this.$store.dispatch('selectPic',this.$cookie.get('user_id'));
                            //this.$store.state.randomCover;
                        })
                        .catch(error => {
                            console.log(error.response)
                        });
                }
            },


            playSong(e) {
                this.songPlay = true;
                this.drawVisualizerInPlayer();
                this.drawFon();
                this.clickCurrentPlaySongEvent = e.currentTarget;
                this.songCurrentName = e.currentTarget.querySelector('.song-name__span').innerHTML.replace(/\.[^/.]+$/, "");
                this.iconActiveMainPlay = true;
                this.removeActiveCurrentClass();
                e.currentTarget.classList.add('activeCurrent');
                this.clickSrc = e.currentTarget.getAttribute('data-video-src');
                this.srcId = parseInt(e.currentTarget.id);
                if (this.srcPlay !== this.clickSrc) {
                    this.srcPlay = this.clickSrc;
                    this.song.src = this.srcPlay;
                    this.song.play();

                }
                else {
                    if (this.song.paused) {
                        this.song.play();
                        e.currentTarget.classList.remove('activeCurrentPaused');
                    }
                    else {
                        this.song.pause();
                        this.songPlay = false;
                        e.currentTarget.classList.add('activeCurrentPaused');

                    }
                }

            },
            funSelTrack() {
                this.srcPlay = this.srcReturn;
                this.song.src = this.srcReturn;
                this.song.play();
            },

            playTrack() {
                this.songPlay = true;
                this.drawVisualizerInPlayer();
                this.drawFon();
                this.removeActiveCurrentClass();
                this.iconActiveMainPlay = !this.iconActiveMainPlay;
                if(this.srcId < 0) {
                    this.srcId = 0;
                }
                this.selectSrc(this.srcId);
                this.clickSrc = this.srcReturn;
                if (this.srcPlay !== this.clickSrc) {
                    this.srcPlay = this.clickSrc;
                    this.song.src = this.srcPlay;
                    this.song.play();
                }
                else {
                    if (this.song.paused) {
                        this.song.play();
                        this.clickCurrentPlaySongEvent.classList.remove('activeCurrentPaused');
                    }
                    else {
                        this.song.pause();
                        this.songPlay = false;
                        this.selectSrcActiveCurrentPaused(this.srcId);
                        this.clickCurrentPlaySongEvent.classList.add('activeCurrentPaused');
                    }
                }
            },
            nextTrack() {
                this.removeActiveCurrentClass();
                this.iconActiveMainPlay = true;
                this.lengthAllTracks = parseInt(this.$el.querySelectorAll('.post').length);
                if (this.clickSrc !== '') { //если была нажата кнопка play
                    if (this.srcId > this.lengthAllTracks - 2) {
                        this.srcId = -1;
                    }
                    this.selectSrc(this.srcId + 1);
                    this.funSelTrack();
                    this.srcId++;
                }
                else {
                    this.srcId++;
                    if(this.srcId > this.lengthAllTracks - 1) {
                        this.srcId = 0;
                    }
                    this.selectSrc(this.srcId);
                    this.funSelTrack();
                    this.clickSrc = this.srcReturn;
                }
            },

            prevTrack() {
                this.removeActiveCurrentClass();
                this.iconActiveMainPlay = true;
                this.lengthAllTracks = parseInt(this.$el.querySelectorAll('.post').length);
                if (this.clickSrc !== '') { //если была нажата кнопка play
                    if (this.srcId < 1) {
                        this.srcId = this.lengthAllTracks;
                    }

                    this.selectSrc(this.srcId - 1);
                    this.funSelTrack();
                    this.srcId--;
                }
                else {
                    this.srcId--;
                    if(this.srcId < 1) {
                        this.srcId = this.lengthAllTracks - 1;
                    }

                    this.selectSrc(this.srcId);
                    this.funSelTrack();
                    this.clickSrc = this.srcReturn;
                }
            },

            goToTime(e) {
                if (this.song.src) {
                    let rob =  (window.innerWidth - e.currentTarget.offsetWidth)/2;
                    let mouseMoveLeft = e.pageX - (rob -9);
                    mouseMoveLeft = ((mouseMoveLeft*100)/e.currentTarget.offsetWidth);
                    const progress = this.$el.querySelector(".progress");

                    if (mouseMoveLeft<=100) {
                        progress.style.cssText = 'width:'+mouseMoveLeft+'%';
                    }

                    this.setSec = ((mouseMoveLeft)* this.song.duration)/100;
                    let timesec = parseInt(this.setSec%60);
                    let peremena;
                    if (timesec < 10){
                        peremena = "0";
                    }
                    else{
                        peremena = "";
                    }
                    this.songMouseHoverTimeOut = (parseInt(this.setSec/60)+':'+peremena+parseInt(this.setSec%60));

                    const setTime = this.$el.querySelector(".setTime");
                    setTime.style.cssText = 'left:'+(mouseMoveLeft - 2.5)+'%';
                }
            },
            goToTimeMouseOverEnter() {
                if (this.song.src) {
                    this.songMouseHoverTime = true;
                }
            },
            setTime() {
                this.song.currentTime = this.setSec;
            },

            goToTimeMouseLeave() {
                this.songMouseHoverTime = false;
            },

            visuallizer() {
                this.analyser = this.audioCtx.createAnalyser();
                //this.analyser.type = "peaking";
                // this.analyser.frequency.value = 2000;
                this.analyser.fftSize = 1024;
                //this.analyser.minDecibels = -70;
                //this.analyser.maxDecibels = -30;
                //this.analyser.smoothingTimeConstant = 0.85;
                this.source = this.audioCtx.createMediaElementSource(this.song);
                this.source.connect(this.analyser);
                this.analyser.connect(this.audioCtx.destination);


                this.array = new Uint8Array(this.analyser.frequencyBinCount);
                for (let i=0; i<this.array.length -10; i++){
                    let block = document.querySelector('.visualizer');
                    let newBlock = document.createElement('div');
                    newBlock.classList.add('visualizer__item');
                    block.appendChild(newBlock);
                }
                this.arrayClassEv = document.querySelectorAll('.visualizer__item');
                for (let i=0; i < this.array.length; i++) {

                }
                // console.log(this.analyser);
                this.visualizerMinValue = 2;
                //this.analyser.getFloatTimeDomainData()(this.array);
            },

            // isCanvas() {
            //     const c = document.querySelector(".canvas");
            //     // c.width = window.innerWidth;
            //     // c.height = window.innerHeight;
            //     this.ctx = c.getContext("2d");
            //     let s = this;
            //     function col(r, g, b) {
            //         s.ctx.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
            //         s.ctx.fillRect(0, 0, window.innerWidth,window.innerHeight);
            //     }
            //     function R(x, y, t) {
            //         return( Math.floor(192 + 64*Math.cos( (x*x-y*y)/300 + t )) );
            //     }
            //
            //     function G(x, y, t) {
            //         return( Math.floor(192 + 64*Math.sin( (x*x*Math.cos(t/4)+y*y*Math.sin(t/3))/300 ) ) );
            //     }
            //
            //     function B(x, y, t) {
            //         // console.log(Math.floor(192 + 64*Math.sin( 5*Math.sin(t/9) + ((x-100)*(x-100)+(y-100)*(y-100))/1100) ));
            //         return( Math.floor(192 + 64*Math.sin( 5*Math.sin(t/9) + ((x-100)*(x-100)+(y-100)*(y-100))/1100) ));
            //     }
            //     // function getRandom(max,min) {
            //     //     return Math.random() * (max - min) + min;
            //     // }
            //     //
            //     // function R(x,y,t) {
            //     //     return(getRandom(255-t, 0));
            //     // }
            //     //
            //     // function G(x,y,t) {
            //     //     return(getRandom(255-t, 0));
            //     // }
            //     //
            //     // function B(x,y,t) {
            //     //     return(getRandom(255-t, 0));
            //     // }
            //     let t = 0;
            //     function run () {
            //         col(R(1,1,t), G(1,1,t), B(1,1,t));
            //         t = t + .009;
            //         window.requestAnimationFrame(run);
            //     }
            //
            //     run();
            //
            // }

            drawImageCoverEffect(ctx, img, x, y, w, h, offsetX, offsetY) {
                if (arguments.length === 2) {
                    x = y = 0;
                    w = ctx.canvas.width;
                    h = ctx.canvas.height;
                }

                // default offset is center
                offsetX = typeof offsetX === "number" ? offsetX : 0.5;
                offsetY = typeof offsetY === "number" ? offsetY : 0.5;

                // keep bounds [0.0, 1.0]
                if (offsetX < 0) offsetX = 0;
                if (offsetY < 0) offsetY = 0;
                if (offsetX > 1) offsetX = 1;
                if (offsetY > 1) offsetY = 1;

                let iw = img.width,
                    ih = img.height,
                    r = Math.min(w / iw, h / ih),
                    nw = iw * r,   // new prop. width
                    nh = ih * r,   // new prop. height
                    cx, cy, cw, ch, ar = 1;

                // decide which gap to fill
                if (nw < w) ar = w / nw;
                if (Math.abs(ar - 1) < 1e-14 && nh < h) ar = h / nh;  // updated
                nw *= ar;
                nh *= ar;

                // calc source rectangle
                cw = iw / (nw / w);
                ch = ih / (nh / h);

                cx = (iw - cw) * offsetX;
                cy = (ih - ch) * offsetY;

                // make sure source rectangle is valid
                if (cx < 0) cx = 0;
                if (cy < 0) cy = 0;
                if (cw > iw) cw = iw;
                if (ch > ih) ch = ih;

                // fill image in dest. rectangle
                ctx.drawImage(img, cx, cy, cw, ch,  x, y, w, h);
            },

            drawFon() {
                const requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
                let array;
                array = new Uint8Array(this.analyser.frequencyBinCount);
                this.analyser.getByteFrequencyData(array)
                const canvas = document.querySelector('.cover');
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                const width = window.innerWidth;
                const height = window.innerHeight;

                const ctx = canvas.getContext('2d');
                this.drawImageCoverEffect(ctx, this.img, -(array[0]*2)/2, -(array[0]*2)/2, width+((array[0]*2)), height+((array[0]*2)));

                if(this.songPlay) {
                    requestAnimationFrame(this.drawFon);
                }
            },

            drawVisualizerInPlayer() {
                const requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
                this.analyser.getByteFrequencyData(this.array);
                for (let i=0; i < this.array.length - 10; i++) {
                    if (this.array[i] < this.visualizerMinValue) {
                        this.arrayClassEv[i].style.cssText = 'height:'+this.visualizerMinValue+'px';
                    }

                    else {
                        let array = this.array[i] - ((this.array[i]*20)/100);
                        this.arrayClassEv[i].style.cssText = 'height:'+array+'px';
                    }
                }
                if(this.songPlay) {
                    requestAnimationFrame(this.drawVisualizerInPlayer);
                }

            }
        },
        beforeCreate() {
            if (this.$cookie.get('login') === null) {
                this.$router.push('/login');
            }
        },

        created() {
            this.$store.dispatch('selectPlaylist',this.$cookie.get('user_id'));
            this.$store.dispatch('selectPic',this.$cookie.get('user_id'));
        },
        mounted() {
            const s = this;
            this.visuallizer();
            this.img.src = `${this.$store.state.randomCover ? this.$store.state.randomCover.images: 'default/cover-default.jpg'}`;
            this.backgroundArray[0] = 0;
            this.img.onload = function () {
                s.drawFon();
            };

            window.onresize = function() {
                s.drawFon();
            };
            this.drawVisualizerInPlayer();
            // this.isCanvas();

        },

        computed: {
            isPlayList() {
                if (this.$store.state.playListUser) {
                    this.result = this.$store.state.playListUser;
                    this.isResult = false;

                    this.$nextTick(() => {
                        let name = document.querySelector('.song-name');
                        let span = document.querySelectorAll('.song-name__span');
                        span.forEach((item) =>{
                            let text = item.innerHTML;
                            if (item.offsetWidth > name.offsetWidth ) {
                                setInterval(() => {
                                    text = text[text.length - 1] + text.substring(0, text.length - 1);
                                    item.innerHTML = text;
                                }, 200)
                            }
                        });
                    });
                }
            },

            isVolume() {
                this.song.volume = this.volumeValue/100;
            },

            currentTimeOut() {
                const s = this;
                this.song.ontimeupdate = function () {
                    let currentTime = s.song.currentTime;
                    let duration = s.song.duration;
                    let current =((duration+currentTime)*100)/duration;
                    let timesec = parseInt(currentTime%60);
                    let peremena;
                    if (timesec < 10){
                        peremena = "0";
                    }
                    else{
                        peremena = "";
                    }

                    s.songCurrentTime = parseInt(currentTime/60)+':'+peremena+parseInt(currentTime%60);
                    if (s.songRepeat === true) {
                        if(duration === currentTime){
                            s.song.currentTime = 0;
                            s.song.play();
                        }
                    }
                    else {
                        if(duration === currentTime){
                            s.nextTrack();
                        }
                    }
                    if (s.songMouseHoverTime !== true) {
                        const element = s.$el.querySelector(".progress");
                        element.style.cssText = 'width:'+(current - 100)+'%';
                    }
                    // visualizer
                    //canvas
                    //s.analyser.frequencyBinCount
                        //s.ctx.clearRect(0,0,window.innerWidth,window.innerHeight);
                    //s.ctx.fillStyle = 'red';
                    // for (let i=0; i < s.array.length - 10; i++) {
                    //     s.ctx.fillStyle = 'rgb(' + s.array[i] + ',50,50)';
                    //     s.ctx.fillRect(window.innerWidth/2,window.innerHeight/2,s.array[i],s.array[i]);
                    // }
                }
            },
        },

        watch: {
            isPlayList () {},
            currentTimeOut() {},
            isVolume() {},
        }
    }
</script>
