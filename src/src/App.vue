<script setup lang="ts">
import {store} from './store/store.ts'
import {onMounted} from 'vue'

const emptyTarget = "/src/empty.jpg";


onMounted(async () => {
    const response = await fetch('/api/image');
    const jsonData = await response.json();
    store.image = jsonData.value;
});
const setAltImage = (event) => {
    event.target.src = emptyTarget
}
const onImgLoad = (event) => {

    if ('/' + event.target.src.split('/').slice(-2).join('/') === emptyTarget) {
        return;
    }
    fetch('/api/imageCounter', {method: "POST", body: JSON.stringify({imageId: store.image})});
    update();
}
const update = async () => {
    getImagesCount();

}
const getImagesCount = async () => {
    const response = await fetch('/api/imageCounter?imageId='+store.image);
    const jsonData = await response.json();
    store.count = jsonData.value;
    setTimeout(() => {getImagesCount()} , 5000);
}

</script>

<template>
    <div>
        <p>Count of load: {{store.count}}</p>
        <img v-if="store.image" :src="store.getImageUrl()" @load="onImgLoad" alt="text" @error="setAltImage">
    </div>
</template>

<style scoped>
</style>
