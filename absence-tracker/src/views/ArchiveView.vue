<template>
  <main>
    <h1>Arhivirani Podaci</h1>
    <div v-if="loading">
      <ArchiveSkeletonLoader />
    </div>
    <div v-else-if="archives.length === 0" class="no-data">Nema arhiviranih podataka</div>
    <table v-else>
      <thead>
        <tr>
          <th>ID</th>
          <th>Date</th>
          <th>Type</th>
          <th>Created At</th>
          <th>Updated At</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="archive in archives" :key="archive.id">
          <td>{{ archive.id }}</td>
          <td>{{ archive.date }}</td>
          <td>{{ archive.type }}</td>
          <td>{{ archive.created_at }}</td>
          <td>{{ archive.updated_at }}</td>
        </tr>
      </tbody>
    </table>
  </main>
</template>

<script>
import axiosInstance from '../axios'
import ArchiveSkeletonLoader from '../components/loaders/ArchiveSkeletonLoader.vue'

export default {
  components: {
    ArchiveSkeletonLoader
  },
  data() {
    return {
      archives: [],
      loading: true
    }
  },
  created() {
    this.fetchArchives()
  },
  methods: {
    async fetchArchives() {
      try {
        const response = await axiosInstance.get('/archive')
        this.archives = response.data
      } catch (error) {
        console.error('Error fetching archives:', error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
h1 {
  margin-bottom: 20px;
}

.no-data {
  text-align: center;
  font-size: 18px;
  margin-top: 20px;
  color: #555;
}

table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

thead th {
  background-color: #f2f2f2;
  color: #0044cc;
  padding: 10px;
  border: 1px solid #ddd;
  text-align: left;
}

tbody td {
  padding: 10px;
  border: 1px solid #ddd;
}

tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

tbody tr:hover {
  background-color: #f1f1f1;
}
</style>
