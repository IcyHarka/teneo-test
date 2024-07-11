<template>
  <div class="date-input-wrapper">
    <label :for="name" class="date-label">{{ label }}</label>
    <VueDatePicker
      :id="name"
      :name="name"
      v-model="selectedDate"
      :hide-navigation="['month', 'year', 'time', 'minutes', 'hours', 'seconds']"
      :ui="uiOptions"
      auto-apply
      :range="true"
      :enable-time-picker="false"
      :disable-time-range-validation="true"
      :min-date="minDate"
      :max-date="maxDate"
      @input="handleDateChange"
    />
  </div>
</template>

<script>
import VueDatePicker from '@vuepic/vue-datepicker'
import { bs } from 'date-fns/locale'

export default {
  name: 'DateInput',
  components: {
    VueDatePicker
  },
  props: {
    label: {
      type: String,
      default: 'Datum'
    },
    name: {
      type: String,
      required: true
    },
    thisMonth: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      selectedDate: null,
      minDate: '',
      maxDate: '',
      format: 'dd.MM.yyyy',
      locale: bs,
      minimumView: 'day',
      uiOptions: {
        input: 'date-input'
      }
    }
  },
  watch: {
    selectedDate(newValue) {
      if (Array.isArray(newValue)) {
        newValue[0].setHours(0, 0, 0, 0)
        newValue[1].setHours(0, 0, 0, 0)
      } else {
        newValue.setHours(0, 0, 0, 0)
      }
      this.$emit('update:date', newValue)
    }
  },
  mounted() {
    if (this.thisMonth) {
      this.setMonthRange()
    }
  },
  methods: {
    setMonthRange() {
      const now = new Date()
      const year = now.getFullYear()
      const month = now.getMonth()

      this.minDate = new Date()
      this.maxDate = new Date(year, month + 1, 0)
    },
    handleDateChange(date) {
      this.selectedDate = date
      this.$emit('update:date', date)
    }
  }
}
</script>

<style scoped>
.date-input-wrapper {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  width: 100%;
}

.date-label {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 8px;
  color: #333;
}

.date-input:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  outline: none;
}
</style>
