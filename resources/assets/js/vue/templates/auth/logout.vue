<template>
    <div></div>
</template>
<script>
    export default {
        created() {
            //Dispatch logout action and redirect to home page
            this.$store.dispatch('logout')
            this.$router.push({ name: 'page.home' })
        }
    }
</script>