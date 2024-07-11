<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="app-container">
    <header>
      <nav>
        <img src="https://teneo.ba/wp-content/uploads/2023/05/Asset-1-1.png" />
        <RouterLink to="/">Kalendar</RouterLink>
        <RouterLink to="/archive">Arhiva</RouterLink>
      </nav>
    </header>

    <main>
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
.app-container {
  display: flex;
  flex-direction: column;
  height: 100vh;
  width: 100vw;
}

nav {
  height: 80px;
  font-size: 1.2rem;
  background-color: blue;
  padding: 20px;
  display: flex;
  gap: 10px;
}

nav a.router-link-exact-active {
  font-weight: bold;
  color: blue;
  background-color: white;
}

nav a {
  display: flex;
  justify-content: center;
  text-decoration: none;
  background-color: transparent;
  color: white;
  padding: 4px 10px;
  border-radius: 6px;
  width: 100px;
}

main {
  flex-grow: 1;
  padding: 2rem;
  overflow-y: auto;
}

img {
  margin-right: 40px;
  padding: 5px;
  border-radius: 6px;
  background-color: white;
}
</style>
