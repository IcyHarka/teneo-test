<template>
  <div class="select-input-wrapper">
    <label for="select-input" class="select-label">{{ label }}</label>
    <select :name="name" :id="name" class="select-input" v-model="selectedOption">
      <option value="">{{ placeholder }}</option>
      <option v-for="option in options" :key="option.value" :value="option.value">
        {{ option.text }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  name: 'SelectInput',
  props: {
    label: {
      type: String,
      default: 'Vrsta odsustva'
    },
    options: {
      type: Array,
      default: () => []
    },
    placeholder: {
      type: String,
      default: ''
    },
    name: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      selectedOption: ''
    }
  },
  watch: {
    selectedOption(newValue) {
      this.$emit('update:option', newValue)
    }
  }
}
</script>

<style scoped>
.select-input-wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.select-label {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 8px;
  color: #333;
}

.select-input {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  transition:
    border-color 0.3s ease,
    box-shadow 0.3s ease;
}

.select-input:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  outline: none;
}
</style>
