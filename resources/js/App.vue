<script setup>
import { onMounted } from 'vue'
import { useInfoStore } from '@js/stores/infoStore'
const info = useInfoStore()

onMounted(() => {
    axios.get('/api/v1/info/')
        .then(res => {
            if(res.data) info.addInfo(res.data.data)
        })

    axios.get('/api/v1/catalog/')
        .then(res => {
            if(res.data) info.addCatalog(res.data.data)
        })
})
</script>

<template>
<router-view />
</template>
