<template>
    <div>
      <canvas ref="chartCanvas"></canvas>
    </div>
  </template>
  
  <script>
  import { Chart, registerables } from 'chart.js';
  import { ref, watch, onMounted } from 'vue';
  
  Chart.register(...registerables);
  
  export default {
    props: {
      employeeCount: {
        type: Number,
        required: true
      },
      managerCount: {
        type: Number,
        required: true
      }
    },
    mounted() {
      this.renderChart();
    },
    methods: {
      renderChart() {
        const ctx = this.$refs.chartCanvas.getContext('2d');
  
        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Quản lý', 'Nhân viên'],
            datasets: [{
              label: 'Biểu đồ nhân viên',
              data: [this.managerCount, this.employeeCount],
              backgroundColor: [
                'rgba(39, 174, 96, 0.6)',    // Màu xanh lá tươi 2
                'rgba(52, 211, 153, 0.6)',  // Màu xanh lá tươi 1
              ],
              borderColor: [
                'rgba(39, 174, 96, 1)',
                'rgba(52, 211, 153, 1)',
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false
          }
        });
      }
    },
    watch: {
      employeeCount() {
        this.renderChart(); // Re-render chart on prop change
      },
      managerCount() {
        this.renderChart(); // Re-render chart on prop change
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add scoped styles here if needed */
  </style>
  