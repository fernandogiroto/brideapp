<template>
    <header v-if="showLayouts">
      <span>BRIDGE</span>
      <div class="header-menu--avatar" @click="logout">
        <IconBell color="var(--neutral-10)" :size="25" stroke-width="2" />

        <IconMenu2 color="var(--neutral-10)" :size="25" stroke-width="2" />

      </div>
    </header>
</template>


<script setup lang="ts">

    import { hiddenLayouts } from '@/utils/globals';
    import { logout } from '@/services/authService';
    import { IconMenu2,IconBell } from '@tabler/icons-vue';

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
        @include mixings.flexbox(row, center, center);
        gap: 5px;


        cursor: pointer;
      }
    }

  }

</style>