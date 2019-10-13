<template>
<div>
    <navbar />
    <router-view></router-view>
</div>

</template>
<script>
import Navbar from '@/js/components/Navbar';
export default {
    components: {
        Navbar
    }
}
</script>