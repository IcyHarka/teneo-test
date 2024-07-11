<template>
  <button @click="handleClick">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    onClick: {
      type: Function,
      required: true
    }
  },
  methods: {
    handleClick() {
      this.onClick()
    }
  }
}
</script>

<style scoped>
button {
  background-color: blue;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  transition:
    background-color 0.3s ease,
    transform 0.2s ease;
}

button:hover {
  background-color: rgb(2, 2, 196);
}

button:active {
  border: 0;
  background-color: white;
}

button:focus {
  border: 0;
  outline: none;
}
</style>
