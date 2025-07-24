<template>
    <footer v-if="showLayouts">
      <div class="footer-item" @click="$router.push('/page')">
        <IconEPassport :color="$route.path === '/page' ? '#1B4965' : '#A1A1AA'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page' }]" class="">Vistos</span>
      </div>
      <div class="footer-item"  @click="$router.push('/page')">
        <IconPerspective :color="$route.path === '/page' ? '#1B4965' : '#A1A1AA'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page' }]" class="">Processos</span>
      </div>
      <div class="footer-item" @click="$router.push('/')">
        <IconHome :color="$route.path === '/' ? '#1B4965' : '#A1A1AA'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/' }]" class="">Inicio</span>
      </div>
      <div class="footer-item" @click="$router.push('/page')">
        <IconFileDescription :color="$route.path === '/page' ? '#1B4965' : '#A1A1AA'":size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page' }]" class="">Documentos</span>
      </div>
      <div class="footer-item" @click="$router.push('/page')">
        <IconUser :color="$route.path === '/page' ? '#1B4965' : '#A1A1AA'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page' }]" class="">Perfil</span>
      </div>
    </footer>
</template>
    
<script setup lang="ts">

    import { hiddenLayouts } from '@/utils/globals';
    const { showLayouts } = hiddenLayouts();

    import { IconHome, IconEPassport, IconUser,IconFileDescription,IconPerspective } from '@tabler/icons-vue';

</script>

<style lang="scss">

  @use '@/scss/mixings';
  @use '@/scss/variables';

  footer {
    @include mixings.flexbox(row, space-between, center);
    gap: 15px;
    width: 100%;
    height: 70px;
    padding: 20px;
    border-top: 1px solid var(--neutral-00);
    .footer-item {
      @include mixings.flexbox(column, center, center);
      gap: 5px;
      &__label {
        font-size: 12px;
        color: #A1A1AA;
        &--active {
          font-size: 12px;
          font-weight: 700;
          color: var(--text-color);
       }
      }

    }
  }

</style>