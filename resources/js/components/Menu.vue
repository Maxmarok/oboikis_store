<script setup>
</script>
<template>
<div class="block2_c w-auto align-items-center justify-content-center bg_light_gray">
    <div class="screen2 m-auto d-flex align-items-center justify-content-center s2_b_height">
        <div class="screen2_blocks d-flex flex-row justify-content-between align-items-center h-100 s2_c_border">
            <router-link to="/catalog/wallpaper">
                <div class="screen2_block d-flex flex-column justify-content-between align-items-center s2_b_c_height s2_b_c_border s2_b_c_hover">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100"><img src="/svg/wallpaper1.svg" class="mb-2"><span>Обои</span></div>
                </div>
            </router-link>
            <router-link to="/catalog/photo">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center s2_b_c_height s2_b_c_border s2_b_c_hover">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100"><img src="/svg/wallpaper2.svg" class="mb-2"><span>Фотообои</span></div>
                </div>
            </router-link>
            <router-link to="/catalog/fresk">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center s2_b_c_height s2_b_c_border s2_b_c_hover">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100"><img src="/svg/wallpaper3.svg" class="mb-2"><span>Фрески</span></div>
                </div>
            </router-link>
            <router-link to="/catalog/decor">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center s2_b_c_height s2_b_c_border s2_b_c_hover">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100"><img src="/svg/wallpaper4.svg" class="mb-2"><span class="d-flex flex-column justify-content-center">Лепной декор</span></div>
                </div>
            </router-link>
            <router-link to="/catalog/glue">
                <div class="screen2_block d-flex flex-column justify-content-evenly align-items-center s2_b_c_height s2_b_c_border s2_b_c_hover">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100"><img src="/svg/bucket.svg" class="mb-2"><span>Клей</span></div>
                </div>
            </router-link>
        </div>
    </div>
</div>
</template>