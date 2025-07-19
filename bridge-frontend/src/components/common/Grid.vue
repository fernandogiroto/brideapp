<template>
  <div
    class="grid"
    v-if="type === 'default'"
    :style="{
      '--grid-gap': gap,
      '--grid-width': width,
      '--grid-columns-mobile': columnsMobile,
      '--grid-columns-tablet': columnsTablet,
      '--grid-columns-large': columnsLarge,
      '--grid-columns-full': columnsFull,
    }"
  >
    <slot />
  </div>
  <div
    class="grid-areas"
    v-if="type === 'areas'"
    :style="{
      '--grid-gap': gap,
    }"
  >
    <slot />
  </div>
</template>

<script lang="ts" setup>
import { onMounted } from 'vue';

const props = defineProps({
  columnsFull: { type: Number, default: 3 },
  columnsLarge: { type: Number, default: 3 },
  columnsTablet: { type: Number, default: 2 },
  columnsMobile: { type: Number, default: 1 },
  gap: { type: String, default: '25px' },
  width: { type: String, default: '100%' },
  type: { type: String, default: 'default' },

  areas: { type: String, default: '' },
  areasTablet: { type: String, default: '' },
  areasMobile: { type: String, default: '' },

  gridHeight: { type: String, default: 'auto' },
});

const processAreas = (areasString: string): string => {
  return areasString
    .split('\n')
    .map((row: string) => {
      return (
        `'` +
        row
          .trim()
          .split(' ')
          .map((cell: string) => {
            const match = cell.match(/(\w+)\((\d+)\)/);
            if (match) {
              const [_, name, span] = match;
              return `${name} `.repeat(Number(span)).trim();
            } else {
              return cell;
            }
          })
          .join(' ') +
        `'`
      );
    })
    .join(' ');
};

onMounted(() => {
  if (props.type === 'areas') {
    if (props.areas) {
      const processedAreas = processAreas(props.areas);
      const grid = document.querySelector('.grid-areas') as HTMLElement;
      if (grid) {
        grid.style.gridTemplateAreas = processedAreas;
      }

      const areaNames = Array.from(new Set(processedAreas.match(/\b\w+\b/g)));
      const styleElement = document.createElement('style');
      styleElement.type = 'text/css';

      areaNames.forEach((area) => {
        if (area) {
          const element = document.getElementById(area);
          if (element) {
            styleElement.appendChild(
              document.createTextNode(`#${area} { 
                    grid-area: ${area}; 
                    border: 1px solid #000;
                }`),
            );
          }
        }
      });

      document.head.appendChild(styleElement);
    }
    if (props.areasMobile) {
      const processedAreasMobile = processAreas(props.areasMobile);
      const mobileStyleElement = document.createElement('style');
      mobileStyleElement.type = 'text/css';
      mobileStyleElement.textContent = `
            @media (max-width: 580px) {
                .grid-areas {
                grid-template-areas: ${processedAreasMobile};
                }
            }
            `;
      document.head.appendChild(mobileStyleElement);
    }
    if (props.areasTablet) {
      const processedAreasTablet = processAreas(props.areasTablet);
      const tabletStyleElement = document.createElement('style');
      tabletStyleElement.type = 'text/css';
      tabletStyleElement.textContent = `
            @media (min-width: 581px) and (max-width: 790px) {
                .grid-areas {
                grid-template-areas: ${processedAreasTablet};
                }
            }
            `;
      document.head.appendChild(tabletStyleElement);
    }
  }
});
</script>

<style lang="scss">
// GRID
.grid {
  display: grid;
  gap: var(--grid-gap);
  align-items: start;
  height: v-bind(gridHeight);
  @media (max-width: 580px) {
    grid-template-columns: repeat(var(--grid-columns-mobile), 1fr);
  }
  @media (min-width: 580px) and (max-width: 790px) {
    grid-template-columns: repeat(var(--grid-columns-tablet), 1fr);
  }
  @media (min-width: 790px) and (max-width: 1200px) {
    grid-template-columns: repeat(var(--grid-columns-large), 1fr);
  }
  @media (min-width: 1200px) {
    grid-template-columns: repeat(var(--grid-columns-full), 1fr);
  }
}

// GRID COLUMNS
.grid-sm {
  @for $i from 1 through 12 {
    @media (max-width: 580px) {
      &-#{$i} {
        grid-column: span #{$i};
      }
    }
  }
}
.grid-md {
  @for $i from 1 through 12 {
    @media (min-width: 580px) and (max-width: 790px) {
      &-#{$i} {
        grid-column: span #{$i};
      }
    }
  }
}
.grid-lg {
  @for $i from 1 through 12 {
    @media (min-width: 790px) and (max-width: 1200px) {
      &-#{$i} {
        grid-column: span #{$i};
      }
    }
  }
}
.grid-xl {
  @for $i from 1 through 12 {
    @media (min-width: 1200px) {
      &-#{$i} {
        grid-column: span #{$i};
      }
    }
  }
}

// GRID AREAS
.grid-areas {
  display: grid;
  gap: var(--grid-gap);
  grid-template-areas: v-bind(areas);
}
</style>
