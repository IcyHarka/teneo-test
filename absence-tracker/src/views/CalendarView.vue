<template>
  <main>
    <TableHeader @archive="archiveAbsences" @open-modal="showModal = true" />
    <TeneoCalendar :absences="absences" />
    <TeneoModal :isVisible="showModal" @close="showModal = false">
      <div class="absence-registration">
        <span class="modal-title">Registrovanje odsustva</span>
        <DateInput label="Datum" name="datum" :this-month="true" @update:date="handleDateChange" />
        <SelectInput
          name="vrsta_odsustva"
          label="Vrsta odsustva:"
          placeholder="Izaberi vrstu odsustva"
          :options="absenceOptions"
          @update:option="handleOptionChange"
        />
        <TeneoButton @click="submitForm"><span class="save-btn">Sačuvaj</span></TeneoButton>
      </div>
    </TeneoModal>
  </main>
</template>

<script>
import TableHeader from '../components/TableHeader.vue'
import TeneoCalendar from '../components/TeneoCalendar.vue'
import TeneoButton from '../components/TeneoButton.vue'
import TeneoModal from '../components/TeneoModal.vue'
import DateInput from '../components/form/DateInput.vue'
import SelectInput from '../components/form/SelectInput.vue'
import axiosInstance from '../axios'

export default {
  components: {
    TableHeader,
    TeneoCalendar,
    TeneoButton,
    TeneoModal,
    DateInput,
    SelectInput
  },
  data() {
    return {
      showModal: false,
      selectedDate: [],
      selectedOption: '',
      absenceOptions: [],
      absences: [],
      errors: {
        date: '',
        option: ''
      }
    }
  },
  created() {
    this.fetchAbsences()
    this.fetchAbsenceTypes()
  },
  methods: {
    async fetchAbsences() {
      try {
        const response = await axiosInstance.get('/absences')
        this.absences = response.data
      } catch (error) {
        console.error('Error fetching absences:', error)
      }
    },
    async fetchAbsenceTypes() {
      try {
        const response = await axiosInstance.get('/absence-types')
        this.absenceOptions = response.data.map((type) => ({ value: type.type, text: type.value }))
      } catch (error) {
        console.error('Error fetching absence types:', error)
      }
    },
    async archiveAbsences() {
      try {
        const response = await axiosInstance.post('/absences/archive')
        this.fetchAbsences()
        this.$toast.success(response.data?.message)
      } catch (error) {
        console.error('Error archiving absences:', error)
      }
    },
    handleDateChange(date) {
      this.selectedDate = date
    },
    handleOptionChange(option) {
      this.selectedOption = option
    },
    async submitForm() {
      let hasError = false

      if (!this.selectedDate || !this.selectedOption) {
        hasError = true
      }

      if (hasError) {
        this.$toast.error('Molimo popunite sva polja')
      } else {
        try {
          await axiosInstance.post('/absences', {
            dates: this.selectedDate,
            type: this.selectedOption
          })

          this.absences.push({ type: this.selectedOption, period: this.selectedDate })
          this.$toast.success('Odsustvo uspješno registrovano')
          await this.fetchAbsences()
          this.showModal = false
          this.resetForm()
        } catch (error) {
          console.error('Error submitting form:', error)
          if (error?.response?.data?.message) {
            this.$toast.error(error.response.data.message)
          } else {
            this.$toast.error('Došlo je do greške prilikom registrovanja odsustva')
          }
        }
      }
    },
    resetForm() {
      this.selectedDate = ''
      this.selectedOption = ''
    }
  }
}
</script>

<style scoped>
.modal-title {
  font-size: 22px;
  font-weight: 600;
}

.absence-registration {
  display: flex;
  flex-direction: column;
  gap: 25px;
  align-items: center;
  width: 100%;
}

.save-btn {
  padding: 10px 4px;
  font-size: 18px;
}

.error {
  color: red;
  font-size: 14px;
}
</style>
