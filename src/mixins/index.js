export default {
    data() {
        return {
            srcReturn: '',
            classReturn: '',
        };
    },

    methods: {
        selectSrc (index) {
            const element = this.$el.querySelectorAll('.post');
            this.srcReturn = element[index].getAttribute('data-video-src');
            element[index].classList.add('activeCurrent');
            this.songCurrentName = element[index].querySelector('.song-name__span').innerHTML.replace(/\.[^/.]+$/, "");

        },

        selectSrcActiveCurrentPaused (index) {
            const element = this.$el.querySelectorAll('.post');
            element[index].classList.add('activeCurrentPaused');
        },

        removeActiveCurrentClass() {
            const element = this.$el.querySelectorAll('.post');
            for(let i = 0; i < element.length; i++) {
                element[i].classList.remove('activeCurrent');
                element[i].classList.remove('activeCurrentPaused');
            }
        }
    }
};
