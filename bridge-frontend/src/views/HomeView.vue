<template>
  <div class="home-page">
    <Intro title="Olá Ana Beatriz!" subtitle="Confira os serviços disponiveis para voce" />
    <!-- Actives Services -->
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
        :headerIconBackground="'#C6D4F1'"
        @click="$router.push('/visa-student')">
      </Card>
      <Card 
        :background="'#EDFCF2'" 
        :title="'Visto de Viagem'" 
        :description="'Solicite seu visto de estudante no Brasil'"
        :headerType="'icon'"
        :headerIcon="'travel'"
        :headerIconBackground="'#D3F8DF'">
      </Card>
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
  import Intro from '@/components/ui/Intro.vue';
  import ProgressBar from 'primevue/progressbar';

  import { IconFileDescription } from '@tabler/icons-vue';

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
  }

  .services-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    width: 100%;
  }

</style>
