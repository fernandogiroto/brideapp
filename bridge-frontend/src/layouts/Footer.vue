<template>
    <footer v-if="showLayouts">
      <div class="footer-item" :class="[{ 'footer-item--active': $route.path === '/page1' }]" @click="$router.push('/page1')">
        <IconEPassport :color="$route.path === '/page1' ? 'var(--theme-color)' : '#1B4965'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page1' }]" class="">Vistos</span>
      </div>
      <div class="footer-item" :class="[{ 'footer-item--active': $route.path === '/page2' }]" @click="$router.push('/page2')">
        <IconPerspective :color="$route.path === '/page2' ? 'var(--theme-color)' : '#1B4965'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page2' }]" class="">Processos</span>
      </div>
      <div class="footer-item" :class="[{ 'footer-item--active': $route.path === '/' }]" @click="$router.push('/')">
        <IconHome :color="$route.path === '/' ? 'var(--theme-color)' : '#1B4965'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/' }]" class="">Inicio</span>
      </div>
      <div class="footer-item" :class="[{ 'footer-item--active': $route.path === '/page3' }]" @click="$router.push('/page3')">
        <IconFileDescription :color="$route.path === '/page3' ? 'var(--theme-color)' : '#1B4965'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page3' }]" class="">Documentos</span>
      </div>
      <div class="footer-item" :class="[{ 'footer-item--active': $route.path === '/page4' }]" @click="$router.push('/page4')">
        <IconUser :color="$route.path === '/page4' ? 'var(--theme-color)' : '#1B4965'" :size="20" stroke-width="2" />
        <span :class="['footer-item__label', { 'footer-item__label--active': $route.path === '/page4' }]" class="">Perfil</span>
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
    border-top:  1px solid var(--neutral-00);
    .footer-item {
      @include mixings.flexbox(column, center, center);
      gap: 5px;
      &__label {
        font-size: 12px;
        color: var(--text-color);
        &--active {
          font-size: 12px;
          color: var(--theme-color);
       }
      }
      &--active {
        background: var(--secondary-color);
        padding: 6px 10px;
        border-radius: 10px;
      }
    }
  }

</style>