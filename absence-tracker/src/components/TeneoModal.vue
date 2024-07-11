<template>
    <transition name="modal-fade">
      <div v-if="isVisible" class="modal-mask" @click.self="close">
        <div class="modal-wrapper">
          <transition name="modal-slide">
            <div v-if="isVisible" class="modal-container">
              <slot></slot>
            </div>
          </transition>
        </div>
      </div>
    </transition>
  </template>
  
  <script>
  export default {
    props: {
      isVisible: {
        type: Boolean,
        required: true
      }
    },
    methods: {
      close() {
        this.$emit('close');
      }
    }
  }
  </script>
  
  <style scoped>
  .modal-mask {
    position: fixed;
    z-index: 99;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal-container {
    width: 450px;
    padding: 40px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .modal-fade-enter-active, .modal-fade-leave-active {
    transition: opacity 0.2s;
  }
  
  .modal-fade-enter-from, .modal-fade-leave-to {
    opacity: 0;
  }
  
  .modal-slide-enter-active, .modal-slide-leave-active {
    transition: all 0.2s ease;
  }
  
  .modal-slide-enter-from, .modal-slide-leave-to {
    transform: translateY(-50px);
    opacity: 0;
  }
  </style>
  