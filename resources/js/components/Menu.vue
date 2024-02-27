<script setup>
import Loader from '@js/components/Loader.vue'
import { useInfoStore } from '@js/stores/infoStore'
const info = useInfoStore()
</script>
<template>
<div class="block2_c w-auto align-items-center justify-content-center bg_light_gray" v-if="info.catalog && info.catalog.length > 0">
    <div class="screen2 m-auto d-flex align-items-center justify-content-center s2_b_height">
        <div class="screen2_blocks d-flex flex-row justify-content-between align-items-center h-100 s2_c_border">
            <router-link 
                v-for="item in info.catalog"
                :to="{
                    name: 'catalog',
                    params: {
                        section: item.url
                    }
                }"
                class="screen2_block d-flex flex-column justify-content-between align-items-center s2_b_c_height s2_b_c_border"
                active-class="s2_b_c_active"
            >
                <div class="d-flex flex-column align-items-center justify-content-center h-100"><img :src="item.icon" class="mb-2"><span v-html="item.name" /></div>
            </router-link>
        </div>
    </div>
</div>

<Loader v-if="!info.catalog" />
</template>