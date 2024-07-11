<template>
  <div class="skeleton-loader">
    <div class="skeleton-header"></div>
    <div class="skeleton-row" v-for="n in 20" :key="n">
      <div class="xs skeleton-cell"></div>
      <div class="md skeleton-cell"></div>
      <div class="sm skeleton-cell"></div>
      <div class="lg skeleton-cell"></div>
      <div class="lg skeleton-cell"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ArchiveSkeletonLoader'
}
</script>

<style scoped>
.skeleton-loader {
  width: 100%;
}

.skeleton-header {
  height: 40px;
  background-color: #e0e0e0;
  margin-bottom: 10px;
  border-radius: 8px;
}

.skeleton-row {
  display: flex;
  width: 100%;
  gap: 10px;
  margin-bottom: 10px;
}

.skeleton-cell {
  /* flex: 1; */
  height: 20px;
  /* width: 15%; */
  background-color: #e0e0e0;
  border-radius: 8px;
}

.xs {
  width: 7.5%;
}

.sm {
  width: 12.5%;
}

.md {
  width: 20%;
}
.lg {
  width: 30%;
}

@keyframes shimmer {
  0% {
    background-position: -1000px 0;
  }
  100% {
    background-position: 1000px 0;
  }
}

.skeleton-header,
.skeleton-cell {
  animation: shimmer 2s infinite linear;
  background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
  background-size: 200% 100%;
}
</style>
