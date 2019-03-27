<template>
    <div class="login player-styles">
        <transition name="fade">
            <loader v-show="isResult"></loader>
        </transition>
        <!--<canvas class="canvas"></canvas>-->
        <div class="top__panel">
            <div class="block__right">
                <div class="user__name">
                    Петя Майко
                </div>
                <div class="user__photo">
                    <img src="../../assets/logo.png" alt="" width="30px" height="30px">
                </div>
                <div class="open__player"
                     @click="isShowPlayer = !isShowPlayer">
                    Knopka
                </div>
            </div>
            <div class="block__right">
                <div class="log__out"
                     @click="logOut">
                </div>
            </div>
        </div>
        <transition name="fade">
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
                            <i class="fas fa-redo"></i>
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
                            <i class="fas fa-volume-up"
                               :class="{'d-none':volumeValue === '0'}"></i>
                            <i class="fa fa-volume-off d-none"
                               aria-hidden="true"
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
        <div class="playList__panel">
            <div class="list">
                <b-button variant="outline-primary" class="playList__panel-button-load" v-b-modal.modal1>download file</b-button>
                <loader v-show="result === ''"></loader>
                <template>
                    <div v-for="(item, index) in result" class="content" :id="index+1">
                        <div @click="playSong($event)" class="post" :id="index" :data-video-src="item.Song">
                            <div class="list-play">
                                <i class="fa fa-play" aria-hidden="true"></i>
                                <i class="fa fa-pause d-none" aria-hidden="true"></i>
                            </div>
                            <div class="song-name"><span>{{item.Name}}</span></div>
                        </div>
                        <div class="controls-song">
                            <div :id_song="item.id"
                                 :data-video-src="item.Song"
                                 class="delete"
                                 @click="trackDelete($event)"
                            >
                                <i class="fa fa-times" aria-hidden="true"></i></div>
                            <a :href="item.Song" download><div class="download"><i class="fa fa-cloud-download" aria-hidden="true"></i></div></a>
                        </div>
                    </div>
                </template>

            </div>
        </div>

        <!--form-->
        <b-modal id="modal1" title="BootstrapVue">
            <form id="uploadForm" name="uploadForm" enctype="multipart/form-data">

                <input type="file" id="files" name="files" multiple="multiple"><br>
                <input type="email" id="email" name="email">


                <input type="button" value="Upload" @click="this.uploadFiles">

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
                songCurrentName: 'Song Name',
                clickCurrentPlaySongEvent: '',
                isShowPlayer: false,
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

            playSong(e) {
                this.clickCurrentPlaySongEvent = e.currentTarget;
                this.songCurrentName = e.currentTarget.querySelector('.song-name').innerHTML.replace(/\.[^/.]+$/, "");
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
                    progress.style.cssText = 'width:'+mouseMoveLeft+'%';

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
                this.analyser.fftSize = 1024;
                this.analyser.minDecibels = -70;
                this.analyser.maxDecibels = -30;
                this.analyser.smoothingTimeConstant = 0;
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
                this.analyser.getByteFrequencyData(this.array);
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
        },
        beforeCreate() {
            if (this.$cookie.get('login') === null) {
                this.$router.push('/login');
            }
        },

        created() {
            this.$store.dispatch('selectPlaylist',this.$cookie.get('user_id'));
        },
        mounted() {
          this.visuallizer();
          // this.isCanvas();

        },

        computed: {
            isPlayList() {
                if (this.$store.state.playListUser) {
                    this.result = this.$store.state.playListUser;
                    this.isResult = false;
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
                    s.analyser.getByteFrequencyData(s.array);
                    for (let i=0; i < s.array.length - 10; i++) {
                        if (s.array[i] < s.visualizerMinValue) {
                            s.arrayClassEv[i].style.cssText = 'height:'+s.visualizerMinValue+'px';
                        }

                        else {
                            let array = s.array[i] - ((s.array[i]*20)/100);
                            s.arrayClassEv[i].style.cssText = 'height:'+array+'px';
                        }
                    }

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
