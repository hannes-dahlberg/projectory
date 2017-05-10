
<template>
    <nav v-navbar-fold="{ threshold: 50 }" class="navbar navbar-default navbar-fixed-top margin-0">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <router-link class="navbar-brand" :to="{ name: 'page.home' }">{{ $t('brand') }}</router-link>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <navbar :menu="menu"></navbar>
                <navbar v-if="menuRight.length" :menu="menuRight" :right="true"></navbar>
            </div>
        </div>
    </nav>
</template>
<script>
    import navbar from './navbar/navbar.vue'

    export default {
        components: { navbar },
        computed: {
            menu() {
                return this.$store.getters.getMenu.filter(item => item.position == 'left' || !item.position)
            },
            menuRight() {
                return this.$store.getters.getMenu.filter(item => item.position == 'right')
            }
        },
        methods: {
            //Check if menu has active child
            activeSubMenu(menuItem) {
                //No menu exists, return false
                if(!menuItem.menu) { return false }

                //Active if a submenu child is the current route
                return menuItem.menu.findIndex(subMenu => this.$route.name == subMenu.route) != -1 ? true : false
            }
        }
    }
</script>