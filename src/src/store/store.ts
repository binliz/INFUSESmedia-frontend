import {reactive} from 'vue'

export const store = reactive({
    image: null,
    count: 0,
    increment() {
        this.count++
    },
    getImageUrl: function () {
        if (this.image) {
            let str = "/src/[imageID].jpg";
            return str.replace('[imageID]', this.image);
        }
    }
})
