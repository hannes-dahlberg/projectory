<template>
    <ul class="nav navbar-nav" :class="{ 'navbar-right': right }">
        <li v-for="menuItem in menu" :role=" menuItem.divider ? 'separator' : false" :class="{ 'dropdown': menuItem.menu, 'divider': menuItem.divider, 'active': $route.name == menuItem.route || (activeSubMenu(menuItem)) }">
            <router-link v-if="!menuItem.menu && !menuItem.divider" :to="{ name: menuItem.route }">
                {{ $t('menu.' + menuItem.name) }}
            </router-link>
            <a v-if="menuItem.menu" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                {{ $t('menu.' + menuItem.name + '.' + menuItem.name) }}
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>
            <ul v-if="menuItem.menu" class="dropdown-menu">
                <li class="text-center text-xs-left" v-for="subMenuItem in menuItem.menu" :role=" subMenuItem.divider ? 'separator' : false" :class="{ 'divider': subMenuItem.divider, 'active': $route.name == subMenuItem.route }">
                    <router-link v-if="!subMenuItem.divider" :to="{ name: subMenuItem.route }">{{ $t('menu.' + menuItem.name + '.' + subMenuItem.name) }}</router-link>
                </li>
            </ul>
        </li>
    </ul>
</template>
<script>
    export default {
        props: ['menu', 'right'],
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