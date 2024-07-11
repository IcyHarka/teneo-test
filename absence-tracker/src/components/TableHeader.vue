<template>
  <div class="table-header">
    <h1>Kalendar</h1>
    <div class="buttons">
      <TeneoButton :onClick="archive"
        ><span class="btn-text">Arhiviraj</span></TeneoButton
      >
      <TeneoButton :onClick="openModal"
        ><span class="btn-text">Registruj Odsustvo</span></TeneoButton
      >
    </div>
  </div>
</template>

<script>
import TeneoButton from './TeneoButton.vue'

export default {
  components: {
    TeneoButton
  },
  methods: {
    openModal() {
      this.$emit('open-modal')
    },
    archive() {
      this.$emit('archive')
    }
  }
}
</script>

<style scoped>
.table-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.buttons {
  display: flex;
  gap: 12px;
}
.btn-text {
  font-size: 18px;
}
</style>
