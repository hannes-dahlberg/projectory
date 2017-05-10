<template>
    <div class="container-fluid padding-0">
        <div v-for="background in backgrounds">
            <div v-parallax="{ speed: 0.4 }" style="height: 150vh; background-size: cover" :style="{ 'background-image': 'url(/img/' + background + ')' }"></div>
            <div style="height: 30vh; background-color: #fff"></div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                backgrounds: ['space1.jpg', 'space2.jpg', 'space3.jpg', 'space4.jpg', 'space5.jpg']
            }
        }
    }
</script>