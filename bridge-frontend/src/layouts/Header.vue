<template>
    <header v-if="showLayouts">
      <span>Logo</span>
      <div class="header-menu">
        <AnimatedPlaceholder width="65px" height="15px" v-for="n in 5" :key="n"></AnimatedPlaceholder>
      </div>
      <button @click="logout">LOGOUT</button>
    </header>
</template>


<script setup lang="ts">

    import { hiddenLayouts } from '@/utils/globals';
    import { logout } from '@/services/authService';

    import AnimatedPlaceholder from '@/components/utils/AnimatedPlaceholder.vue'

    const { showLayouts } = hiddenLayouts();

</script>

<style lang="scss">

  @use '@/scss/mixings';
  @use '@/scss/variables';

  header {
    @include mixings.flexbox(row, space-between, center);
    position: sticky;
    width: 100%;
    height: 50px;
    padding: 20px;
    border-bottom: 1px solid var(--text-color);
    .header-menu{
      @include mixings.flexbox(row, center, center);
      gap: 20px;
    }
  }

</style>