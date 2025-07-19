<template>
    <footer v-if="showLayouts">
        footer
    </footer>
</template>
    
<script setup lang="ts">

    import { hiddenLayouts } from '@/utils/globals';
    const { showLayouts } = hiddenLayouts();

</script>

<style lang="scss">

  @use '@/scss/mixings';
  @use '@/scss/variables';

  footer {
    @include mixings.flexbox(column, center, center);
    width: 100%;
    height: 50px;
    padding: 20px;
    border-top:  1px solid var(--text-color);
  }

</style>