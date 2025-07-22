<template>
  <div class="home-page">
    VISTOS
  </div>
</template>

<script lang="ts" setup>
</script>

<style lang="scss">
  @use '@/scss/mixings';
  @use '@/scss/variables';
  
  .home-page {
    @include mixings.flexbox(column, initial, center);
    flex: 1;
    gap: 20px;
    width: 100%;
    height: 100%;
    padding: 10px 20px;
  }

</style>
