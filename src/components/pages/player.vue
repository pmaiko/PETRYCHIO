<template>
    <transition name="player-page">
        <div class="player-page"
             :class="{'togglePlayList': togglePlayListNewGrid}">
            <transition name="fade">
                <loader v-show="isResult"></loader>
            </transition>
            <div class="player-page__top-panel">
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
            <div class="player-page__toggle" v-show="!bg_fade_in"
                 @click="[runText(),togglePlayList(), newGrid(), bgFadeIn()]"

            >
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            </div>
            <transition name="toggle-playlist">
                <div class="player-page__playlist list" v-show="!isTogglePlayList">
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
            <transition name="player--show">
                <div class="player-page__player" v-show="isShowPlayer">
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
                            <!--<input type="range" class="volume" min="0" max="100" v-model="volumeValue">-->
                            <vue-slider
                                    v-model="volumeValue"
                                    :min="0"
                                    :max="100"
                            >

                            </vue-slider>
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
            <div class="player-page__cover" :class="{'bg-fade-in': bg_fade_in}">
                <div class="cover">
                    <div class="cover__visualizer">
                    </div>
                    <div class="cover__buffer" >
                        <img src="../../assets/logo.png" alt="Y0pta">
                    </div>
                </div>
            </div>
            <div class="player-page__stars">
            <div id="stars1"></div>
            <div id="stars2"></div>
            <div id="stars3"></div>
            </div>
            <b-link class="download-cover" v-b-modal.modal2>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </b-link>

            <!--form-->
            <b-modal id="modal1" title="BootstrapVue">
                <form id="uploadForm" name="uploadForm" enctype="multipart/form-data">

                    <input type="file" id="files" name="file" multiple="multiple"><br>
                    <!--<input type="email" id="email" name="email">-->


                    <input type="button" value="Upload" @click="this.uploadFiles">
                    <!--<input type="submit">-->
                    {{isUploadProgress}}
                </form>
            </b-modal>

            <b-modal id="modal2" title="BootstrapVue">
                <form id="uploadCover" name="uploadForm" enctype="multipart/form-data">
                    <input type="file" id="filesImage" name="files" multiple="multiple"><br>
                    <input type="button" value="Upload" @click="this.uploadFilesCover">
                </form>
            </b-modal>
        </div>
    </transition>
</template>
<script>
    import loader from '../module/loader'
    // import $ from 'jquery'
    import axios from 'axios'
    import playerMixin from '../../mixins'
    import VueSlider from 'vue-slider-component'
    import 'vue-slider-component/theme/antd.css'

    export default {
        data() {
            return {
                cover: '',
                isUploadProgress: '',
                limit: 15,
                paginationVal: 5,
                playListMaxCount: '',
                requestAnimationFrame: window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame,
                img: new Image(),
                isTogglePlayList: false,
                togglePlayListNewGrid: false,
                bg_fade_in: false,
                songCurrentName: 'Song Name',
                isShowPlayer: false,
                backgroundArray: [],
                result: '',
                isResult: true,
                count: 1,
                iconActiveMainPlay: false,
                renderPage: false,

                song: '',
                audioCtx: '',
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
                visualizerMinValue: 2,
                array: [],
                source: '',
                period: '300',

                // mute: false,
                // volume: 100,
                // vol: '',

                widthBuffer: '',
                heightBuffer: '',

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
            VueSlider,
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
                // this.$nextTick(() => {
                //     // cancelAnimationFrame(f);
                //     let name = document.querySelector('.song-name');
                //     let span = document.querySelectorAll('.song-name__span');
                //     span.forEach((item) =>{
                //         let text = item.innerHTML;
                //         if (item.offsetWidth > name.offsetWidth ) {
                //             let f = () =>{
                //                 console.log('log00');
                //
                //                 text = text[text.length - 1] + text.substring(0, text.length - 1);
                //                 item.innerHTML = text;
                //                 setTimeout(() => {
                //                     requestAnimationFrame(f);
                //                 }, 100);
                //             };
                //             f();
                //         }
                //     });
                // });
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
                const data = new FormData(document.getElementById('uploadForm'));
                const trackFiles = document.querySelector('#files');
                data.append('user_id', this.$cookie.get('user_id'));
                for (let i = 0; i < trackFiles.files.length; i++) {
                    data.append('file', trackFiles.files[i]);

                    await axios.post('/api/upload_music.php', data, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        },

                        onUploadProgress: (progressEvent) => {
                            const { loaded, total } = progressEvent;
                            this.isUploadProgress = (loaded * 100) / total;
                            console.log(this.isUploadProgress);
                        }
                    })
                        .then(response => {
                            this.limit = 15;
                            this.$store.dispatch('selectPlaylist', {cookieID: this.$cookie.get('user_id'), limitValue: this.limit});
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
                for (let i = 0; i < imageFiles.files.length; i++) {
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
                if (this.audioCtx === '') {
                    this.visuallizer();
                }
                this.songPlay = true;
                this.draw();
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
                this.draw();
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
                    }
                    else {
                        this.song.pause();
                        this.songPlay = false;
                        this.selectSrcActiveCurrentPaused(this.srcId);
                    }
                }
            },
            async nextTrack() {
                this.removeActiveCurrentClass();
                this.iconActiveMainPlay = true;
                this.lengthAllTracks = parseInt(this.$el.querySelectorAll('.post').length);
                if (this.srcId > this.lengthAllTracks - 2 && this.limit < this.playListMaxCount) {
                    this.$store.dispatch('selectPlaylist', {cookieID: this.$cookie.get('user_id'), limitValue: this.limit+=this.paginationVal}).then(
                        response => {
                            this.selectSrc(this.srcId + 1);
                            this.funSelTrack();
                            this.srcId++;
                        }
                    );
                }
                else {
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
                }

            },

            prevTrack() {
                this.removeActiveCurrentClass();
                this.iconActiveMainPlay = true;
                //this.lengthAllTracks = parseInt(this.$el.querySelectorAll('.post').length);
                if(this.srcId < 1 && this.lengthAllTracks === 0) {
                    this.$store.dispatch('selectPlaylist', {
                        cookieID: this.$cookie.get('user_id'),
                        limitValue: this.playListMaxCount})
                        .then(response => {
                            this.lengthAllTracks = parseInt(this.$el.querySelectorAll('.post').length);
                            this.srcId = this.lengthAllTracks;
                            this.srcId--;
                            this.selectSrc(this.srcId);
                            this.funSelTrack();
                            this.clickSrc = this.srcReturn;
                            this.limit = this.playListMaxCount;
                        });
                }
                else {
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
                this.song = new Audio();
                //this.song.crossOrigin = 'anonymous';
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                this.audioCtx = new AudioContext();
                this.analyser = this.audioCtx.createAnalyser();
                //this.analyser.type = "peaking";
                // this.analyser.frequency.value = 2000;
                this.analyser.fftSize = 1024;
                // this.analyser.minDecibels = -70;
                // this.analyser.maxDecibels = -30;
                this.analyser.minDecibels = -100;
                this.analyser.maxDecibels = -30;
                this.analyser.smoothingTimeConstant = 0.75;
                this.source = this.audioCtx.createMediaElementSource(this.song);
                this.source.connect(this.analyser);
                this.analyser.connect(this.audioCtx.destination);
                this.array = new Uint8Array(this.analyser.frequencyBinCount);

                //Создание блоков
                for (let i=0; i<this.array.length -100; i++){
                    let block = document.querySelector('.visualizer');
                    let newBlock = document.createElement('div');
                    newBlock.classList.add('visualizer__item');
                    block.appendChild(newBlock);
                }

                for (let i=0; i<this.period; i++){
                    let block = document.querySelector('.cover__visualizer');
                    let newBlock = document.createElement('div');
                    newBlock.classList.add('cover__visualizer-item');
                    block.appendChild(newBlock);
                }
            },

            draw() {
                this.analyser.getByteFrequencyData(this.array);

                const cover = document.querySelector('.cover');
                const buffer = document.querySelector('.cover__buffer');
                const visualizer_item = document.querySelectorAll('.visualizer__item');
                const cover_visualizer_item = document.querySelectorAll('.cover__visualizer-item');

                //const width = "100%"; //window.innerWidth
                //const height = "100%"; //window.innerHeight
                const indexArray  = 0;
                const reduce = 1.5;
                cover.style.cssText = `
                background-image: url(${this.cover});
                margin-left: ${-((this.array[indexArray]/reduce)*2)/2}px;
                margin-top: ${-((this.array[indexArray]/reduce)*2)/2}px;
                width: calc(100% + ${((this.array[indexArray]/reduce)*2)}px);
                height: calc(100% + ${(((this.array[indexArray]/reduce)*2))}px);
                `;

                //buffer.style.cssText = `width: ${this.widthBuffer + this.array[1]/4}px;  height: ${this.heightBuffer + this.array[1]/4}px;`;

                // visualizer in fon
                let period = 360 / this.period;
                let t = period;
                for (let i = 0; i < this.period; i++) {
                    cover_visualizer_item[i].style.cssText = `transform: rotate(${t}deg) translateY(100px); height: ${this.array[i]}px`;
                    t=t+period;
                }

                // visualizer in player
                for (let i = 0; i < this.array.length - 100; i++) {
                    if (this.array[i] < this.visualizerMinValue) {
                        visualizer_item[i].style.cssText = 'height:'+this.visualizerMinValue+'px';
                    }

                    else {
                        //let array = this.array[i] - ((this.array[i]*20)/100);
                        let array = this.array[i]/2;
                        visualizer_item[i].style.cssText = 'height:'+array+'px';
                    }

                }


                if(this.songPlay) {
                    requestAnimationFrame(this.draw);
                }
            },

            scrollPlayList() {
                const element = document.querySelector('.list');
                element.onscroll = () => {
                    let tmp = element.scrollHeight - element.scrollTop;
                    if (this.limit < this.playListMaxCount && Math.round(tmp) === element.clientHeight || Math.round(tmp) - 1 === element.clientHeight  || Math.round(tmp) + 1 === element.clientHeight) {
                        this.$store.dispatch('selectPlaylist', {cookieID: this.$cookie.get('user_id'), limitValue: this.limit+=this.paginationVal});
                        this.runText();
                    }

                    if(this.limit >= this.playListMaxCount) {
                        this.lengthAllTracks = this.playListMaxCount;
                    }
                }
            },

            newGrid() {
                setTimeout(() =>{
                    this.togglePlayListNewGrid= !this.togglePlayListNewGrid;
                }, 1000)
            },
            togglePlayList() {
                if(this.isTogglePlayList === false) {
                    this.isTogglePlayList = true;
                }
                else {
                    setTimeout(() =>{
                        this.isTogglePlayList = false;
                    }, 1000)
                }
            },
            bgFadeIn() {
                this.bg_fade_in = true;
                setTimeout(() =>{
                    this.bg_fade_in = false;
                }, 2000)
            },
        },
        beforeCreate() {
            if (this.$cookie.get('login') === null) {
                this.$router.push('/login');
            }
        },

        created() {
            this.$store.dispatch('selectPlaylist', {cookieID: this.$cookie.get('user_id'), limitValue: this.limit});
            this.$store.dispatch('selectPic',this.$cookie.get('user_id'));
        },
        mounted() {
            this.cover = this.$store.state.randomCover ? this.$store.state.randomCover.images: 'default/cover-default.jpg';
            const buffer = document.querySelector(".cover__buffer");
            this.widthBuffer = buffer.clientWidth;
            this.heightBuffer = buffer.clientHeight;

            this.scrollPlayList();

            // window.onload = () => {
            //     this.visuallizer();
            //     this.draw();
            // };
            this.backgroundArray[0] = 0;

        },

        computed: {
            isPlayList() {
                if (this.$store.state.playListUser) {
                    this.result = this.$store.state.playListUser.playList;
                    this.playListMaxCount = this.$store.state.playListUser.maxCount.maxCount;
                    this.isResult = false;

                    // this.$nextTick(() => {
                    //     let name = document.querySelector('.song-name');
                    //     let span = document.querySelectorAll('.song-name__span');
                    //     span.forEach((item) =>{
                    //         let text = item.innerHTML;
                    //         if (item.offsetWidth > name.offsetWidth ) {
                    //             lox = () => {
                    //                 text = text[text.length - 1] + text.substring(0, text.length - 1);
                    //                 item.innerHTML = text;
                    //             }
                    //         }
                    //         //requestAnimationFrame(lox);
                    //     });
                    // });
                }
            },

            isVolume() {
                if(this.song) {
                    this.song.volume = this.volumeValue/100;
                }
            },

            currentTimeOut() {
                if(this.song) {
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
                    }
                }
            },
        },

        watch: {
            //scrollPlayList() {},
            isPlayList () {},
            currentTimeOut() {},
            isVolume() {},
        }
    }
</script>
