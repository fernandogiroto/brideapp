<template>
  <div class="home-page">
    <!-- Active Services -->
     <div class="intro">
      <div class="intro__label">
        <span class="intro__label--title">Olá Ana Beatriz!</span>
        <span class="intro__label--subtitle">Confira os serviços disponiveis para voce</span>
      </div>
     </div>
    <Card 
      :background="'var(--tertiary-color)'" 
      :headerType="'progress'"
      :headerIcon="'student'"
      :footerLabel="'Última Atulização - 22/07'"
      :footer="true">
      <template #progressIcon>
        <IconFileDescription color="var(--tertiary-color)" :size="30" stroke-width="2" />
      </template>
      <template #content>
        <ProgressBar :value="50" :showValue="false" :style="progressbarCustom"></ProgressBar>
      </template>
    </Card>
    <!-- List Services -->
    <div class="services-list">
      <Card 
        :background="'#F9F5FF'" 
        :title="'Visto de Residencia'" 
        :description="'Solicite seu visto de estudante no Brasil'"
        :headerType="'icon'"
        :headerIcon="'residence'"
        :headerIconBackground="'#C6D4F1'">
      </Card>
      <Card 
        :background="'#EDFCF2'" 
        :title="'Visto de Viagem'" 
        :description="'Solicite seu visto de estudante no Brasil'"
        :headerType="'icon'"
        :headerIcon="'travel'"
        :headerIconBackground="'#D3F8DF'">
      </Card>
    </div>
    <div class="services-list">
      <Card 
        :background="'#FEF6EE'" 
        :title="'Visto de Estudante'" 
        :description="'Solicite seu visto de estudante no Brasil'"
        :headerType="'icon'"
        :headerIcon="'student'"
        :headerIconBackground="'#f7e7d6'">
      </Card>
      <Card 
        :background="'#FEF3F2'" 
        :title="'Documentos'" 
        :description="'Solicite seu visto de estudante no Brasil'"
        :headerType="'icon'"
        :headerIcon="'documents'"
        :headerIconBackground="'#FEE4E2'">
      </Card>
    </div>

  </div>
</template>

<script lang="ts" setup>

  import Card from '@/components/ui/Card.vue';
  import ProgressBar from 'primevue/progressbar';

  import { IconFileDescription, IconBell } from '@tabler/icons-vue';

  const progressbarCustom = {
    '--p-progressbar-value-background': 'var(--secondary-color)',
    height: '10px',
    backgroundColor: 'var(--theme-color)'
  };




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

  .services-list {
    @include mixings.flexbox(row, center, center);
    gap: 20px;
    width: 100%;
  }

  .intro {
    @include mixings.flexbox(row, space-between, initial);
    gap: 5px;
    width: 100%;
    &__label {
      @include mixings.flexbox(column, initial, initial);
      &--title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-color);
      }
      &--subtitle {
        font-size: 14px;
        font-weight: 500;
        color: var(--neutral-10);
      }
    }
  }

</style>
