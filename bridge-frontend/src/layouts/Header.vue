<template>
    <header v-if="showLayouts">
      <span>BRIDGE</span>
      <Avatar image="/images/perfil.jpg" shape="circle" @click="logout" />
    </header>
</template>


<script setup lang="ts">

    import { hiddenLayouts } from '@/utils/globals';
    import { logout } from '@/services/authService';

    import Avatar from 'primevue/avatar';

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
    .header-menu{
      @include mixings.flexbox(row, center, center);
      gap: 20px;
      &--avatar{
        border-radius: 50%;
        width:30px;
        height:30px;
        cursor: pointer;
      }
    }

  }

</style>