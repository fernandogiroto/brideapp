<template>
  <div class="placeholder">&nbsp;</div>
</template>

<script setup lang="ts">
  const props = defineProps({
    height: { type: String },
    heightMobile: { type: String, default: '100%' },
    width: { type: String },
    widthMobile: { type: String, default: '100%' },
    margin: { type: String },
    borderTopLeft: { type: String },
    borderTopRight: { type: String },
    borderBottomLeft: { type: String },
    borderBottomRight: { type: String }
  });
</script>

<style lang="scss" scoped>
  @use '@/scss/variables';

  .placeholder {
    height: v-bind(heightMobile);
    width: v-bind(widthMobile);
    margin: v-bind(margin);
    border-top-left-radius: v-bind(borderTopLeft);
    border-top-right-radius: v-bind(borderTopRight);
    border-bottom-left-radius: v-bind(borderBottomLeft);
    border-bottom-right-radius: v-bind(borderBottomRight);
    background-image: linear-gradient(to right, #d6d7d8 0%, #e2e3e4 10%, #d6d7d8 20%, #d6d7d8 100%);
    background-size: 200% 100%;
    box-shadow:
      0 4px 6px -1px rgb(0 0 0 / 0.1),
      0 2px 4px -2px rgb(0 0 0 / 0.1);
    animation: bgAnimate 1.2s linear infinite;
    @media (min-width: variables.$md-breakpoint) {
      height: v-bind(height);
      width: v-bind(width);
    }
  }
</style>
