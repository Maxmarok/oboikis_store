<script setup>
import { defineEmits } from 'vue';
const emit = defineEmits(['toggleMenu'])

const onToggleMenu = () => {
    emit('toggleMenu');
}
</script>

<template>
  <header id="page-topbar">
    <div class="navbar-header">
      <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
          <a href="/" class="logo logo-dark">
            <span class="logo-sm">
              <img src="@js/assets/images/logo-admin-white.svg" height="22" />
            </span>
            <span class="logo-lg">
              <img src="@js/assets/images/icon-admin.svg" height="20" />
            </span>
          </a>

          <a href="/" class="logo logo-light">
            <span class="logo-sm">
              <img src="@js/assets/images/icon-admin.svg" height="22" />
            </span>
            <span class="logo-lg">
              <img src="@js/assets/images/logo-admin-white.svg" height="20" />
            </span>
          </a>
        </div>

        <button
          @click="onToggleMenu"
          type="button"
          class="btn btn-sm px-3 font-size-24 header-item waves-effect"
          id="vertical-menu-btn"
        >
          <i class="ri-menu-2-line align-middle"></i>
        </button>

      </div>

      
    </div>
  </header>
</template>