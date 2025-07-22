<template>
    <footer v-if="showLayouts">
      <div class="footer-item">
        <IconEPassport color="#1B4965" :size="20" stroke-width="2" />
        <span class="footer-item__label">Vistos</span>
      </div>
      <div class="footer-item">
        <IconPerspective color="#1B4965" :size="20" stroke-width="2" />
        <span class="footer-item__label">Processos</span>
      </div>
      <div class="footer-item footer-item--active">
        <IconHome color="var(--theme-color)" :size="20" stroke-width="2" />
        <span class="footer-item__label--active">Início</span>
      </div>
      <div class="footer-item">
        <IconFileDescription color="#1B4965" :size="20" stroke-width="2" />
        <span class="footer-item__label">Documentos</span>
      </div>
      <div class="footer-item">
        <IconUser color="#1B4965" :size="20" stroke-width="2" />
        <span class="footer-item__label">Perfil</span>
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
    gap: 20px;
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