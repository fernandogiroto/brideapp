<template>
    <div class="intro">
        <div class="intro__label">
            <span class="intro__label--title">{{ title }}</span>
            <span class="intro__label--subtitle">{{ subtitle }}</span>
        </div>
    </div>
</template>

<script setup lang="ts">

  const props = defineProps({
    title: { type: String, },
    subtitle: { type: String },
  });

</script>

<style lang="scss">

  @use '@/scss/mixings';
  @use '@/scss/variables';

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
