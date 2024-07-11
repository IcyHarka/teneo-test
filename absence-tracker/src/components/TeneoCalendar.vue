<template>
  <div class="calendar">
    <div
      v-for="(day, index) in daysInMonth"
      :key="index"
      class="day-container"
      :class="{ highlight: isWeekend(day) }"
    >
      <div class="day">
        {{ day.getDate() }}
        <span v-if="isToday(day)" class="today">Danas</span>
      </div>
      <div v-if="absences && absences.length > 0" class="events-container">
        <div class="events-list">
          <div
            v-for="(event, idx) in getEventsForDay(day)"
            :key="idx"
            :class="['event', event.type]"
          >
            {{
              event.type === 'sick'
                ? 'Bolovanje'
                : event.type === 'vacation'
                  ? 'Godišnji odmor'
                  : 'Personalno odsustvo'
            }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    absences: Array
  },
  data() {
    return {
      daysInMonth: [],
      today: new Date()
    }
  },
  mounted() {
    this.generateDaysInMonth()
  },
  methods: {
    generateDaysInMonth() {
      const now = new Date()
      const year = now.getFullYear()
      const month = now.getMonth()

      const firstDay = new Date(year, month, 1)
      const lastDay = new Date(year, month + 1, 0)
      const daysArray = []

      for (let i = firstDay.getDate(); i <= lastDay.getDate(); i++) {
        daysArray.push(new Date(year, month, i))
      }

      this.daysInMonth = daysArray
    },
    isToday(day) {
      const today = new Date()
      return (
        day.getDate() === today.getDate() &&
        day.getMonth() === today.getMonth() &&
        day.getFullYear() === today.getFullYear()
      )
    },
    isWeekend(day) {
      const dayOfWeek = day.getDay()
      return dayOfWeek === 0 || dayOfWeek === 6
    },
    getEventsForDay(day) {
      return this.absences.filter((absence) => {
        const date = new Date(absence.date)
        return day.getDate() === date.getDate()
      })
    }
  }
}
</script>

<style scoped>
.calendar {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  grid-gap: 16px;
  margin-top: 20px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

@media (max-width: 1024px) {
  .calendar {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 768px) {
  .calendar {
    grid-template-columns: repeat(3, 1fr);
  }
}
@media (max-width: 425px) {
  .calendar {
    grid-template-columns: repeat(2, 1fr);
  }
}

.day-container {
  aspect-ratio: 1/1;
  border-radius: 10px;
  border: 2px solid blue;
  background-color: white;
  color: blue;
  position: relative;
  transition:
    transform 0.2s ease,
    background-color 0.3s ease;
  display: flex;
  flex-direction: column;
}

.day-container:hover {
  transform: scale(1.05);
}

.day {
  margin: 12px 20px;
  font-size: 32px;
  font-weight: bold;
}

@media (max-width: 768px) {
  .day {
    margin: 10px 14px;
    font-size: 26px;
  }
}
@media (max-width: 480px) {
  .day {
    margin: 8px 10px;
    font-size: 24px;
  }
}

.highlight {
  background-color: rgba(128, 128, 128, 0.5);
  color: white;
  border-color: transparent;
}

.today {
  position: absolute;
  top: 26px;
  right: 0px;
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
  padding: 5px 10px;
  font-size: 12px;
  letter-spacing: 1px;
  color: white;
  font-weight: 500;
  text-transform: uppercase;
  background-color: darkgreen;
}

.events-container {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.register-btn {
  background: none;
  border: none;
  color: #007bff;
  font-size: 14px;
  cursor: pointer;
  margin: 10px 0;
}

.events-list {
  flex-grow: 1;
  overflow-y: auto;
}

.event {
  padding: 4px 10px;
  margin: 6px 20px;
  border-radius: 4px;
  font-size: 14px;
  color: white;
}

.event.sick {
  background-color: #ff4d509c;
}

.event.vacation {
  background-color: #52c41a9c;
}

.event.personal {
  background-color: #1890ff9c;
}
</style>

