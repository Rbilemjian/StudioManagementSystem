<template>
    <div id="main">
        <Header/>
        <div class="content" style="margin-top:40px;">
            <router-view/>
        </div>
    </div>
</template>

<script>
    import Header from './Header.vue';
    export default {
        name: 'main-app',
        components: {Header}
    }
</script>
