<template>
     <HeaderComponent msg="Welcome to Your Vue.js App" />
     <router-view />
</template>
<script>
import HeaderComponent from './HeaderComponent.vue';
export default{
    components:{
        HeaderComponent
    }
}
</script>